<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'request_date',
        'user_comment',
        'admin_comment',
        'approval_flag',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
