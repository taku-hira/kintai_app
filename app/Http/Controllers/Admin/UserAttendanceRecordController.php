<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserAttendanceRecordController extends Controller
{
    public function index($id)
    {
        $user_id = $id;
        $attendance_records = User::FindOrFail($user_id)->attendance()->get();
        $record = [];
        foreach ($attendance_records as $attendance_record) {
            $record[$attendance_record->date] = $attendance_record;
        }
        return view('admin.user_attendance_record.index', compact('record'));
    }

    public function edit($user_id, $attendance_id)
    {
        return view('admin.user_attendance_record.edit');
    }
}
