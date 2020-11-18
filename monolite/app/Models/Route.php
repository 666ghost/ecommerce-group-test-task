<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    public $table = "route";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'uri', 'allow_child_roles'
    ];
    public $timestamps = false;
    public $with = ["child"];

    public function child(): ?HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent(): ?BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function roles(): ?BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_route');
    }

    public function routesTreeByRole(Role $role): ?Collection
    {

    }
}

