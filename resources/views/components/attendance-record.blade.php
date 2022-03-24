@php
        $select_month = \Carbon\Carbon::now()->format('Y-m');
        if (isset($_GET['month'])) {
            $select_month = $_GET['month'];
            $number_of_month = date('t', strtotime($select_month));
        } else {
            $number_of_month = date('t', strtotime($select_month));
        }
@endphp
<div class="p-6 bg-white border-b border-gray-200">
    <div class="text-right my-4">
        <form action="" method="get">
            @csrf
            <input type="month" value="{{ $select_month }}" name="month">
            <input type="submit" value="月切替" class="border p-2 bg-indigo-500 hover:bg-indigo-700 text-gray-100 cursor-pointer ">
        </form>
    </div>
    <table class="table-auto mx-auto w-3/4 border">
        <thead>
            <tr class="text-center border text-gray-100">
                <th class="border px-4 py-2 bg-indigo-500">日付</th>
                <th class="border px-4 py-2 bg-indigo-500">シフト</th>
                <th class="border px-4 py-2 bg-indigo-500">出勤</th>
                <th class="border px-4 py-2 bg-indigo-500">退勤</th>
                <th class="border px-4 py-2 bg-indigo-500">労働時間</th>
                <th class="border px-4 py-2 bg-indigo-500">休憩</th>
                <th class="border px-4 py-2 bg-indigo-500">残業</th>
            </tr>
        </thead>
        <tbody>
            @for($i = 1; $i <= $number_of_month; $i ++)
                @if(array_key_exists(date('Y-m-d', strtotime($select_month . '-' . $i)), $record))
                    <tr class="text-center border odd:bg-indigo-100 even:bg-indigo-200">
                        <td class="border px-4 py-2">{{ date('d', strtotime($select_month . '-' . $i)) }}</td>
                        <td class="border px-4 py-2">
                            @if(!is_null($record[date('Y-m-d', strtotime($select_month . '-' . $i))]->shift_id))
                                {{ $record[date('Y-m-d', strtotime($select_month . '-' . $i))]->shift->shift_name }}
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            @if(!is_null($record[date('Y-m-d', strtotime($select_month . '-' . $i))]->start_time))
                                {{ date("H:i:s", strtotime($record[date('Y-m-d', strtotime($select_month . '-' . $i))]->start_time)) }}
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            @if(!is_null($record[date('Y-m-d', strtotime($select_month . '-' . $i))]->end_time))
                                {{ date("H:i:s", strtotime($record[date('Y-m-d', strtotime($select_month . '-' . $i))]->end_time)) }}
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ \Calc::calcWorkingHours($record[date('Y-m-d', strtotime($select_month . '-' . $i))]->start_time, $record[date('Y-m-d', strtotime($select_month . '-' . $i))]->end_time) }}</td>
                        <td class="border px-4 py-2">{{ $record[date('Y-m-d', strtotime($select_month . '-' . $i))]->break_time }}</td>
                        <td class="border px-4 py-2">
                            @if(!is_null($record[date('Y-m-d', strtotime($select_month . '-' . $i))]->shift_id))
                            {{ \Calc::calcOverTime($record[date('Y-m-d', strtotime($select_month . '-' . $i))]->shift->shift_end, $record[date('Y-m-d', strtotime($select_month . '-' . $i))]->end_time, $record[date('Y-m-d', strtotime($select_month . '-' . $i))]->date) }}
                            @endif
                        </td>
                    </tr>
                @else
                    <tr class="text-center border odd:bg-indigo-100 even:bg-indigo-200">
                        <td class="border px-4 py-2">{{ date('d', strtotime($select_month . '-' . $i)) }}</td>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2"></td>
                        <td class="border px-4 py-2"></td>
                    </tr>
                @endif
            @endfor
        </tbody>
    </table>
</div>
