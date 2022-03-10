<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            申請編集
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
                                <form action="{{ route('user.leave_application.update', ['id' => $application->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex flex-wrap -m-2">
                                        <div class="p-2 my-2 w-full">
                                            <div class="relative">
                                                <label for="date" class="leading-7 text-sm text-gray-600">休暇希望日</label>
                                                <input type="date" id="date" name="date" value="{{ $application->request_date }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                        <div class="p-2 w-full mx-auto">
                                            <div class="relative">
                                                <label for="user_comment" class="leading-7 text-sm text-gray-600">コメント（200字以内）</label>
                                                <textarea id="user_comment" name="user_comment" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $application->user_comment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="p-2 my-2 w-full flex justify-around">
                                            <button type="button" onclick="location.href='{{ route('user.leave_application.index') }}'" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">戻る</button>
                                            <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">再申請</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
