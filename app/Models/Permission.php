<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasUuids;

    // Tegaskan ke Eloquent bahwa ID bukan integer auto-increment
    public $incrementing = false;
    protected $keyType = 'string';
}