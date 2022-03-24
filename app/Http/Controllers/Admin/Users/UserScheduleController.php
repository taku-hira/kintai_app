<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Shift;

class UserScheduleController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at')->get();

        return view('admin.user_schedule.index', compact('users'));
    }

    public function create($id)
    {
        $user_id = $id;
        $shift_lists = Shift::all();
        $attendances = Attendance::where([
            ['user_id', '=', $id],
        ])->get();
        $record = [];
        foreach ($attendances as $attendance) {
            $record[$attendance->date] = $attendance;
        }
        return view('admin.user_schedule.create', compact('user_id', 'shift_lists', 'record'));
    }

    public function store(Request $request, $id)
    {
        foreach ($request->date as $key => $date) {
            if (is_null($request->shift[$key])) {
                continue;
            } else {
                if (Attendance::where([
                    ['user_id', '=', $id],
                    ['date', '=', $date],
                ])->exists()) {
                    $attendance = Attendance::where([
                        ['user_id', '=', $id],
                        ['date', '=', $date],
                    ])->first();
                    $schedule = Attendance::findOrFail($attendance->id);
                    $schedule->shift_id = $request->shift[$key];
                    $schedule->save();
                } else {
                    $schedule = new Attendance();
                    $schedule->user_id = $id;
                    $schedule->date = $date;
                    $schedule->shift_id = $request->shift[$key];
                    $schedule->save();
                }
            }
        }
        return redirect()->route('admin.user_attendance_record.index', ['id' => $id])->with('flash_message', 'スケジュール登録完了しました');
    }
}
