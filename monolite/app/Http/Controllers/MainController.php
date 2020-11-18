<?php


namespace App\Http\Controllers;


use App\Models\Role;
use App\Models\Route;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Gate;

class MainController extends Controller
{
    public function show(Route $route, Request $request)
    {
        $roleId = $request->get("role_id");
        $roles = Role::query()->without('child')->get();
        $editRole = null;
        $mainRoles = Role::query()->where('parent_id', null)->get();

        if ($roleId) {
            $editRole = Role::query()->without('child')->findOrFail($roleId);
        }
        $response = Gate::inspect('view-route', $route);
        if ($response->denied()) {
            abort(403);
        }
        $mainRoutes = Route::query()->where("parent_id", null)->get();

        $currentRole = (new RoleService())->getFromCookie();
        return view('show', [
            'route' => $route,
            'editRole' => $editRole,
            'mainRoutes' => $mainRoutes,
            'mainRoles' => $mainRoles,
            'currentRole' => $currentRole,
            'roles' => $roles
        ]);
    }

    public function setRole(Request $request)
    {
        $roleId = Role::query()->without('child')->findOrFail($request->get('id'))->id;

        Cookie::queue('user_role', strval($roleId), 60 * 24);
        return redirect()->back();
    }

    public function updateRole(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:role',
            'name' => 'required|min:3|max:40',
            'parent_id' => 'nullable|exists:role,id'
        ]);
        $parentId = $request->get('parent_id', null);
        $role = Role::query()->without('child')->find($request->get('id'));
        $role->name = $request->get('name');
        $role->parent_id = $request->get('parent_id', $parentId);
        $role->save();
        return redirect('/');
    }
}
