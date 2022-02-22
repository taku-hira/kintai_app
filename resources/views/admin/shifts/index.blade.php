<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            シフト一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                @if (session('flash_message'))
                                    <div class="text-center w-1/2 mx-auto my-4 bg-blue-100 border border-blue-500 text-blue-700 px-4 py-3 rounded">
                                        {{ session('flash_message') }}
                                    </div>
                                @endif
                                <table class="table-auto w-full text-center whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">シフト</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">スケジュール</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">登録日</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shifts as $shift)
                                            <tr>
                                                <td class="px-4 py-3">{{ $shift->shift_name }}</td>
                                                <td class="px-4 py-3">{{ $shift->shift_start . '-' . $shift->shift_end }}</td>
                                                <td class="px-4 py-3">{{ Carbon\Carbon::create($shift->created_at)->format('Y/m/d') }}</td>
                                                <td class="px-4 py-3">
                                                    <button onclick="location.href=''" class="text-white bg-indigo-500 border-0 py-2 px-2 focus:outline-none hover:bg-indigo-600 rounded">編集する</button>
                                                </td>
                                                <form id="delete_{{ $shift->id }}" method="POST" action="{{ route('admin.users.destroy', ['id' => $shift->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <td class="px-4 py-3">
                                                        <a href="#" data-id="{{ $shift->id }}" onclick="deletePost(this)" class="text-white bg-red-400 border-0 py-2 px-4 focus:outline-none hover:bg-red-500 rounded">
                                                            削除する
                                                        </a>
                                                    </td>
                                                </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="w-full text-center my-4">
                                    <button onclick="location.href='{{ route('admin.shifts.create') }}'" class="text-white bg-indigo-500 border-0 py-2 px-2 focus:outline-none hover:bg-indigo-600 rounded">シフト追加</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('/js/alert.js') }}"></script>
</x-app-layout>
