<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_name',
        'shift_start',
        'shift_end',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
