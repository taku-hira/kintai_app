<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            休暇申請一覧
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
                                <div class="w-full text-right my-4">
                                    <button onclick="location.href='{{ route('user.leave_application.create') }}'" class="text-white bg-indigo-500 border-0 py-2 px-2 focus:outline-none hover:bg-indigo-600 rounded">新規申請</button>
                                </div>
                                <table class="table-auto w-full text-center whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">申請日</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">申請No.</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">ステータス</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($application_lists as $application_list)
                                            @php
                                                $status = '';
                                                if ($application_list->approval_flag === 1) {
                                                    $status = '承認済';
                                                } elseif ($application_list->approval_flag === 2) {
                                                    $status = '差戻';
                                                } else {
                                                    $status = '申請中';
                                                }
                                            @endphp
                                            <tr>
                                                <td class="px-4 py-3">{{ Carbon\Carbon::create($application_list->created_at)->format('Y/m/d') }}</td>
                                                <td class="px-4 py-3">{{ $application_list->id }}</td>
                                                <td class="px-4 py-3">{{ $status }}</td>
                                                @if($application_list->approval_flag === 2)
                                                <td class="px-4 py-3">
                                                    <button onclick="location.href='{{ route('user.leave_application.edit', ['id' => $application_list->id]) }}'" class="text-white bg-red-500 border-0 py-2 px-4 focus:outline-none hover:bg-red-600 rounded">再申請</button>
                                                </td>
                                                @else
                                                <td class="px-4 py-3">
                                                    <button onclick="location.href='{{ route('user.leave_application.show', ['id' => $application_list->id]) }}'" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">詳細</button>
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
