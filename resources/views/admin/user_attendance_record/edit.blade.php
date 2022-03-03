<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-12 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                @if ($errors->any())
                                    <div class="text-center w-full mx-auto my-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="my-4 text-right">
                                    <form id="delete_{{ $record->id }}" method="POST"
                                    action="{{ route('admin.user_attendance_record.destroy',
                                    [
                                        'user_id' => $record->user_id,
                                        'attendance_id' => $record->id
                                    ]
                                    ) }}">
                                        @csrf
                                        @method('DELETE')
                                            <a href="#" data-id="{{ $record->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded">
                                                完全削除
                                            </a>
                                    </form>
                                </div>
                                <form action="{{ route('admin.user_attendance_record.update', ['user_id' => $record->user_id, 'attendance_id' => $record->id]) }}" method="POST">
                                    @csrf
                                    <div class="flex flex-wrap -m-2">
                                    <div class="p-2 my-2 w-full">
                                        <div class="relative">
                                            <label for="name" class="leading-7 text-sm text-gray-600">日付</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                {{ $record->date }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2 my-2 w-full">
                                        <div class="relative">
                                            <label for="shift" class="leading-7 text-sm text-gray-600">シフト</label>
                                            <select name="shift" id="shift">
                                                @foreach ($shift_lists as $shift_list)
                                                    <option value="{{ $shift_list->id }}" @if ($record->shift_id == $shift_list->id) selected @endif>
                                                        {{ $shift_list->shift_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="p-2 my-2 w-full">
                                        <div class="relative">
                                            <label for="start_time" class="leading-7 text-sm text-gray-600">出勤時間(HH:ii)</label>
                                            <input type="text" id="start_time" name="start_time" value="{{ date('H:i', strtotime($record->start_time)) }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 my-2 w-full">
                                        <div class="relative">
                                            <label for="end_time" class="leading-7 text-sm text-gray-600">退勤時間(HH:ii)</label>
                                            <input type="text" id="end_time" name="end_time" value="{{ date('H:i', strtotime($record->end_time)) }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 my-2 w-full">
                                        <div class="relative">
                                            <label for="braak_time" class="leading-7 text-sm text-gray-600">休憩時間(HH:ii)</label>
                                            <input type="text" id="break_time" name="break_time" value="{{ date('H:i', strtotime($record->break_time)) }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                    </div>
                                    <div class="p-2 my-2 w-full flex justify-around">
                                        <button type="button" onclick="location.href='{{ route('admin.user_attendance_record.index', ['id' => $record->user_id]) }}'" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">戻る</button>
                                        <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('/js/alert.js') }}"></script>
</x-app-layout>
