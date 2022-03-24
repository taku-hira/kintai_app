<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveApplication;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LeaveApplicationController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $application_lists = LeaveApplication::where('user_id', $user_id)->latest()->get();

        return view('user.leave_application.index', compact('application_lists'));
    }

    public function show($id)
    {
        $application = LeaveApplication::findOrFail($id);

        return view('user.leave_application.show', compact('application'));
    }

    public function create()
    {
        return view('user.leave_application.create');
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();



        $request->validate([
            'date' => ['date_format:Y-m-d', 'required', 'after:today'],
            'user_comment' => ['max:200'],
        ]);

        $leave_application = new LeaveApplication();
        $leave_application->user_id = $user_id;
        $leave_application->request_date = $request->date;
        $leave_application->user_comment = $request->user_comment;
        $leave_application->save();

        return redirect()->route('user.leave_application.index')->with('flash_message', '申請送信完了しました');
    }

    public function edit($id)
    {
        $application = LeaveApplication::findOrFail($id);

        if ($application->approval_flag === 0 || $application->approval_flag === 1) {
            return redirect()->route('user.leave_application.index');
        }

        return view('user.leave_application.edit', compact('application'));
    }

    public function update(Request $request, $id)
    {
        $application = LeaveApplication::findOrFail($id);

        $request->validate([
            'date' => ['date_format:Y-m-d', 'required', 'after:today'],
            'user_comment' => ['max:200'],
        ]);

        $application->request_date = $request->date;
        $application->user_comment = $request->user_comment;
        $application->approval_flag = 0;
        $application->save();

        return redirect()->route('user.leave_application.index')->with('flash_message', '再申請完了しました');
    }
}
