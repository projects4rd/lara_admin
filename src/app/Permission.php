<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    /**
     * Get the permission group.
     *
     * @return string
     */
    public function getGroupAttribute()
    {
        $permissionNameParts = explode('-', $this->name);
        return end($permissionNameParts);
    }
}
