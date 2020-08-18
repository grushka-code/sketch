<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static whereIn(string $string, array $permissions)
 */
class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class,'roles_permissions');
    }
}
