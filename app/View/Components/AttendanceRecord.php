<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AttendanceRecord extends Component
{
    public $record = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct()
    {
        $user_id = Auth::id();
        $attendance_records = User::FindOrFail($user_id)->attendance()->get();

        foreach ($attendance_records as $attendance_record) {
            $this->record[$attendance_record->date] = $attendance_record;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.attendance-record');
    }
}
