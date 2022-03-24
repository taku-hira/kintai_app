<x-app-layout>
    @php
        $status = '';
        if ($application->approval_flag === 1) {
            $status = '承認済';
        } elseif ($application->approval_flag === 2) {
            $status = '差戻';
        } else {
            $status = '申請中';
        }
    @endphp
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
                                <div class="flex flex-wrap -m-2">
                                <div class="p-2 my-2 w-full">
                                    <div class="relative">
                                        <div class="leading-7 text-sm text-gray-600">申請日</div>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ Carbon\Carbon::create($application->created_at)->format('Y/m/d') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 my-2 w-full">
                                    <div class="relative">
                                        <div class="leading-7 text-sm text-gray-600">申請者</div>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ $application->user_id }}
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 my-2 w-full">
                                    <div class="relative">
                                        <div class="leading-7 text-sm text-gray-600">希望休暇日</div>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ $application->request_date }}
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 my-2 w-full">
                                    <div class="relative">
                                        <div class="leading-7 text-sm text-gray-600">ステータス</div>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ $status }}
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 my-2 w-full">
                                    <div class="relative">
                                        <div class="leading-7 text-sm text-gray-600">コメント</div>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ $application->user_comment }}
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 my-2 w-full">
                                    <div class="relative">
                                        <div class="leading-7 text-sm text-gray-600">管理者コメント</div>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ $application->admin_comment }}
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 my-2 w-full flex justify-around">
                                    <button type="button" onclick="location.href='{{ route('admin.leave_application_approval.index') }}'" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">戻る</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
