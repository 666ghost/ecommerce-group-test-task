<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    public $table = "role";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id', 'name', 'parent_id'
    ];
    protected $with = ["child"];

    public $timestamps = false;

    public function child(): ?HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent(): ?BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while (!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }


    public function routes(): ?BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_route');
    }
}
