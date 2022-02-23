<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\shift;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'schedule_type',
        'date',
        'start_time',
        'end_time',
        'break_time',
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
