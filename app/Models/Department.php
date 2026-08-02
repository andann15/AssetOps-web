<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['compartment_id', 'name', 'is_active'];

    public function compartment()
    {
        return $this->belongsTo(Compartment::class);
    }

    public function workUnits()
    {
        return $this->hasMany(WorkUnit::class);
    }
}
