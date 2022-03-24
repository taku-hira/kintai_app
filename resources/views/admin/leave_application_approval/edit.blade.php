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
                                                {{ $application->user->name }}
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
                                    <form class="w-full" action="{{ route('admin.leave_application_approval.update', ['id' => $application->id]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="p-2 w-full mx-auto">
                                            <div class="relative">
                                                <label for="admin_comment" class="leading-7 text-sm text-gray-600">管理者コメント（200字以内）</label>
                                                <textarea id="admin_comment" name="admin_comment" class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $application->admin_comment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="p-2 my-2 w-full flex justify-around">
                                            <button type="button"  onclick="location.href='{{ route('admin.leave_application_approval.index') }}'" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">戻る</button>
                                            <button type="submit" name="action" value="sending_back" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">差戻</button>
                                            <button type="submit" name="action" value="approval" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">承認</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
