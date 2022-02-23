<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;
use Illuminate\Auth\Events\Validated;
use Carbon\Carbon;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::all();

        return view('admin.shifts.index', compact('shifts'));
    }

    public function create()
    {
        return view('admin.shifts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'shift_name' => ['required'],
            'shift_start' => ['date_format:H:i', 'required'],
            'shift_end' => ['date_format:H:i', 'required', 'after:shift_start'],
        ]);

        $shift = new Shift;
        $shift->shift_name = $request->shift_name;
        $shift->shift_start = $request->shift_start;
        $shift->shift_end = $request->shift_end;
        $shift->save();

        return redirect()->route('admin.shifts.index')->with('flash_message', 'シフト追加しました');
    }

    public function edit($id) {
        $shift = Shift::findOrFail($id);

        return view('admin.shifts.edit', compact('shift'));
    }

    public function update(Request $request, $id)
    {
        $shift = Shift::findOrFail($id);

        $request->validate([
            'shift_name' => ['required'],
            'shift_start' => ['date_format:H:i', 'required'],
            'shift_end' => ['date_format:H:i', 'required', 'after:shift_start'],
        ]);

        $shift->shift_name = $request->shift_name;
        $shift->shift_start = $request->shift_start;
        $shift->shift_end = $request->shift_end;
        $shift->save();

        return redirect()->route('admin.shifts.index')->with('flash_message', '更新完了しました');
    }
}
