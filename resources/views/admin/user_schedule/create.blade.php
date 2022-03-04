<x-app-layout>
    @php
        $select_month = \Carbon\Carbon::now()->format('Y-m');
        if (isset($_GET['month'])) {
            $select_month = $_GET['month'];
            $number_of_month = date('t', strtotime($select_month));
        } else {
            $number_of_month = date('t', strtotime($select_month));
        }
    @endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            スケジュール登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if (session('flash_message'))
                            <div class="text-center w-1/2 mx-auto my-4 bg-blue-100 border border-blue-500 text-blue-700 px-4 py-3 rounded">
                                {{ session('flash_message') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="text-center w-full mx-auto my-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="text-right my-4">
                            <form action="" method="get">
                                @csrf
                                <input type="month" value="{{ $select_month }}" name="month">
                                <input type="submit" value="月切替" class="border p-2 bg-indigo-500 hover:bg-indigo-700 text-gray-100 cursor-pointer ">
                            </form>
                        </div>
                        <div class="p-2 my-2 w-full flex justify-around">
                            <button type="button" onclick="location.href='{{ route('admin.user_schedule.index') }}'" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">戻る</button>
                            <button form="schedule" type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
                        </div>
                        <table class="table-auto mx-auto w-3/4 border">
                            <thead>
                                <tr class="text-center border text-gray-100">
                                    <th class="border px-4 py-2 bg-indigo-500">日付</th>
                                    <th class="border px-4 py-2 bg-indigo-500">シフト</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form id="schedule" action="{{ route('admin.user_schedule.store', ['id' => $user_id]) }}" method="post">
                                    @for($i = 1; $i <= $number_of_month; $i ++)
                                        <tr class="text-center border odd:bg-indigo-100 even:bg-indigo-200">
                                            <td class="border px-4 py-2">{{ date('Y-m-d', strtotime($select_month . '-' . $i)) }}</td>
                                            <td class="border px-4 py-2 text-center">
                                                @csrf
                                                <input type="hidden" name="date[{{ $i }}]" value="{{ date('Y-m-d', strtotime($select_month . '-' . $i)) }}">
                                                <select class="inline-block text-center appearance-none w-1/2 bg-gray-100 border border-gray-500 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="shift[{{ $i }}]" id="shift">
                                                    <option value="">未登録</option>
                                                    @foreach ($shift_lists as $shift_list)
                                                        <option value="{{ $shift_list->id }}"
                                                            @if(array_key_exists(date('Y-m-d', strtotime($select_month . '-' . $i)), $record)
                                                                && $record[date('Y-m-d', strtotime($select_month . '-' . $i))]->shift_id === $shift_list->id)
                                                                selected
                                                            @endif>
                                                            {{ $shift_list->shift_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endfor
                                </form>
                            </tbody>
                        </table>
                        <div class="p-2 my-2 w-full flex justify-around">
                            <button type="button" onclick="location.href='{{ route('admin.user_schedule.index') }}'" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">戻る</button>
                            <button form="schedule" type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
