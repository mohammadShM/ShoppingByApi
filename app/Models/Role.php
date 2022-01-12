<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property mixed permissions
 * @property mixed title
 * @method static truncate()
 */
class Role extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }

    public function hasPermission($permission): bool
    {
        return $this->permissions()->where('title', $permission)->exists();
    }

}
