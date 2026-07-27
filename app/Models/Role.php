<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasUuids;

    // Tegaskan ke Eloquent bahwa ID bukan integer auto-increment
    public $incrementing = false;
    protected $keyType = 'string';
}