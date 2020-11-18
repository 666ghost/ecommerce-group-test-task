<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Route;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;

class RoleService
{
    public function getFromCookie()
    {
        $roleId = Cookie::get('user_role');
        if (!$roleId) {
            $roleId = Role::query()->without('child')->where("parent_id", null)->first()->id;
            Cookie::queue('user_role', strval($roleId), 60 * 24);
        }
        return Role::query()->without('child')->findOrFail($roleId);
    }

    public function canViewRoute(Route $route)
    {
        $currentRole = $this->getFromCookie();

        $hasRole = Route::query()->where('id', $route->id)->whereHas('roles', function (Builder $qr) use ($currentRole) {
            $qr->where('id', $currentRole->id);
        })->exists();

        if ($hasRole) {
            return true;
        }

        if ($route->allow_child_roles) {
            $hasRole = Route::query()->where('id', $route->id)->whereHas('roles', function (Builder $qr) use ($currentRole) {
                $qr->whereIn('id', $currentRole->parents->pluck('id')->toArray());
            })->exists();

            if ($hasRole) {
                return true;
            }
        }
        return false;
    }

    public function canViewRouteInTree(Route $route)
    {
        if ($this->canViewRoute($route)) {
            return true;
        }
        $childRoutes = $route->child;
        foreach ($childRoutes as $childRoute) {
            $hasRole = $this->canViewRouteInTree($childRoute);
            if ($hasRole === true) {
                return true;
            }
        }
        return false;
    }

}

