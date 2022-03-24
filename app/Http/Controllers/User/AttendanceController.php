<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\User;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function attendanceStamp()
    {
        $user_id = Auth::id();

        $new_time_stamp = Carbon::today()->format('Y-m-d');
        $attendance_record = Attendance::where([
            ['user_id', $user_id],
            ['date', $new_time_stamp],
            ])->first();

        if ($attendance_record) {
            if (!is_null($attendance_record->start_time)) {
                return redirect()->route('user.index')->with('error', '※既に出勤登録が完了しています');
            } else {
                $attendance_record->start_time = Carbon::now();
                $attendance_record->save();
                return redirect()->route('user.index')->with('flash_message', '出勤打刻が完了しました');
            }
        } else {
            $attendance = new Attendance();
            $attendance->user_id = $user_id;
            $attendance->date = Carbon::today();
            $attendance->start_time = Carbon::now();
            $attendance->save();
            return redirect()->route('user.index')->with('flash_message', '出勤打刻が完了しました');
        }
    }

    public function leaveWorkStamp()
    {
        $user_id = Auth::id();
        $new_time_stamp = Carbon::today()->format('Y-m-d');
        $attendance_record = Attendance::where([
            ['user_id', $user_id],
            ['date', $new_time_stamp],
            ])->first();
        if ($attendance_record) {
            if ($attendance_record->end_time) {
                return redirect()->route('user.index')->with('error', '※既に退勤登録が完了しています');
            } else {
                $attendance_record->update([
                    'end_time' => Carbon::now(),
                ]);
                return redirect()->route('user.index')->with('flash_message', '退勤打刻が完了しました');
            }
        } else {
            $attendance = new Attendance();
            $attendance->user_id = $user_id;
            $attendance->date = Carbon::today();
            $attendance->end_time = Carbon::now();
            $attendance->save();
            return redirect()->route('user.index')->with('flash_message', '退勤打刻が完了しました')
                                                ->with('error', '出勤記録が登録されていません');
        }
    }

    public function attendanceRecord()
    {
        return view('user.attendanceRecord');
    }
}
