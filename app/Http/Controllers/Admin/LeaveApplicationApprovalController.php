<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Attendance;
use App\Models\LeaveApplication;

class LeaveApplicationApprovalController extends Controller
{
    public function index()
    {
        $applications = LeaveApplication::where('approval_flag', '!=', 2)->latest()->paginate(6);

        return view('admin.leave_application_approval.index', compact('applications'));
    }

    public function show($id)
    {
        $application = LeaveApplication::findOrFail($id);

        return view('admin.leave_application_approval.show', compact('application'));
    }

    public function edit($id)
    {
        $application = LeaveApplication::findOrFail($id);

        return view('admin.leave_application_approval.edit', compact('application'));
    }

    public function update(Request $request, $id)
    {
        $application = LeaveApplication::findOrFail($id);

        $application->admin_comment = $request->admin_comment;

        if ($request->action === 'approval') {
            try {
                DB::beginTransaction();
                $application->approval_flag = 1;
                $application->save();

                $date = $application->request_date;
                $user_id = $application->user_id;

                if (Attendance::where([
                    ['user_id', '=', $user_id],
                    ['date', '=', $date],
                ])->exists()) {
                    $attendance = Attendance::where([
                        ['user_id', '=', $user_id],
                        ['date', '=', $date],
                    ])->first();
                    $schedule = Attendance::findOrFail($attendance->id);
                    $schedule->shift_id = 2;
                    $schedule->save();
                } else {
                    $schedule = new Attendance();
                    $schedule->user_id = $user_id;
                    $schedule->date = $date;
                    $schedule->shift_id = 2;
                    $schedule->save();
                }
                DB::commit();
            } catch(\Exception $e) {
                DB::rollback();
                return redirect()->route('admin.leave_application_approval.index')->with('承認失敗しました');
            }
            return redirect()->route('admin.leave_application_approval.index')->with('flash_message', '承認完了しました。');
        } else {
            $application->approval_flag = 2;
            $application->save();
            return redirect()->route('admin.leave_application_approval.index')->with('flash_message', '差戻しました。');
        }
    }
}
