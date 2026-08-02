<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkUnitHistory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'from_work_unit_id',
        'to_work_unit_id',
        'changed_by',
        'reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fromWorkUnit()
    {
        return $this->belongsTo(WorkUnit::class, 'from_work_unit_id');
    }

    public function toWorkUnit()
    {
        return $this->belongsTo(WorkUnit::class, 'to_work_unit_id');
    }

    public function changer()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
