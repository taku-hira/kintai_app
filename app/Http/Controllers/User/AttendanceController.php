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
        $latest_time_stamp = Attendance::where('user_id', $user_id)->latest()->first();
        $new_time_stamp = Carbon::today()->format('Y-m-d');

        if ($latest_time_stamp) {
            if ($new_time_stamp === $latest_time_stamp->date) {
                return redirect()->route('user.index')->with('error', '※既に出勤登録が完了しています');
            }
        }

        $attendance = new Attendance();
        $attendance->user_id = $user_id;
        $attendance->date = Carbon::today();
        $attendance->start_time = Carbon::now();
        $attendance->save();
        return redirect()->route('user.index')->with('flash_message', '出勤打刻が完了しました');
    }

    public function leaveWorkStamp()
    {
        $user_id = Auth::id();
        $latest_work_record = Attendance::where('user_id', $user_id)->latest()->first();

        if ($latest_work_record) {
            if ($latest_work_record->end_time) {
                return redirect()->route('user.index')->with('error', '※既に退勤登録が完了しています');
            }
        }
        if ($latest_work_record) {
            $latest_work_record->update([
                'end_time' => Carbon::now(),
            ]);
            return redirect()->route('user.index')->with('flash_message', '退勤打刻が完了しました');
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
