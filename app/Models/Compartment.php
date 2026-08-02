<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compartment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'is_active'];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
