<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shift;
use App\Models\Attendance;

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

        return view('admin.user_attendance_record.index', compact('record', 'user_id'));
    }

    public function create(Request $request, $id)
    {
        $date = $request->date;
        $shift_lists = Shift::all();
        return view('admin.user_attendance_record.create', compact('date', 'shift_lists', 'id'));
    }

    public function store(Request $request, $id)
    {
        $attendance_record = new Attendance();

        $attendance_record->user_id = $id;
        $attendance_record->shift_id = $request->shift;
        $attendance_record->date = $request->date;
        $attendance_record->start_time = $request->date . '-' . $request->start_time;
        $attendance_record->end_time = $request->date . '-' . $request->end_time;
        $attendance_record->break_time = $request->break_time;
        $attendance_record->save();

        return redirect()->route('admin.user_attendance_record.index', ['id' => $id])->with('flash_message', '編集完了しました');
    }

    public function edit($user_id, $attendance_id)
    {
        $record = User::FindOrFail($user_id)->attendance()->FindOrFail($attendance_id);
        $shift_lists = Shift::all();
        return view('admin.user_attendance_record.edit', compact('record', 'shift_lists'));
    }

    public function update(Request $request, $user_id, $attendance_id)
    {
        $attendance_record = User::FindOrFail($user_id)->attendance()->FindOrFail($attendance_id);

        $request->validate([
            'shift' => ['required'],
            'start_time' => ['date_format:H:i', 'required'],
            'end_time' => ['date_format:H:i', 'required', 'after:start_time'],
            'break_time' => ['date_format:H:i', 'required',],
        ]);

        $attendance_record->shift_id = $request->shift;
        $attendance_record->start_time = $attendance_record->date . '-' . $request->start_time;
        $attendance_record->end_time = $attendance_record->date . '-' . $request->end_time;
        $attendance_record->break_time = $request->break_time;
        $attendance_record->save();

        return redirect()->route('admin.user_attendance_record.index', ['id' => $user_id])->with('flash_message', '勤怠編集完了しました');
    }
}
