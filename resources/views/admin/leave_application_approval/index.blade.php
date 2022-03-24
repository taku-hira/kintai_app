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
                                <table class="table-auto w-full text-center whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">申請日</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">申請No.</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">申請者</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">ステータス</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($applications as $application)
                                            @php
                                                $status = '';
                                                if ($application->approval_flag === 1) {
                                                    $status = '承認済';
                                                } elseif ($application->approval_flag === 2) {
                                                    $status = '差戻';
                                                } else {
                                                    $status = '未承認';
                                                }
                                            @endphp
                                            <tr>
                                                <td class="px-4 py-3">{{ Carbon\Carbon::create($application->created_at)->format('Y/m/d') }}</td>
                                                <td class="px-4 py-3">{{ $application->id }}</td>
                                                <td class="px-4 py-3">{{ $application->user->name }}</td>
                                                <td class="px-4 py-3">{{ $status }}</td>
                                                @if($application->approval_flag === 0)
                                                <td class="px-4 py-3">
                                                    <button onclick="location.href='{{ route('admin.leave_application_approval.edit', ['id' => $application->id]) }}'" class="text-white bg-green-500 border-0 py-2 px-4 focus:outline-none hover:bg-green-600 rounded">承認</button>
                                                </td>
                                                @else
                                                <td class="px-4 py-3">
                                                    <button onclick="location.href='{{ route('admin.leave_application_approval.show', ['id' => $application->id]) }}'" class="text-white bg-indigo-500 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-600 rounded">詳細</button>
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $applications->links() }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
