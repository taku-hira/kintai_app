<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('flash_message'))
                    <div class="text-center w-1/2 mx-auto my-4 bg-blue-100 border border-blue-500 text-blue-700 px-4 py-3 rounded">
                        {{ session('flash_message') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="text-center w-1/2 mx-auto my-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="border bg-gray-100 text-center w-1/2 my-16 mx-auto p-4 text-3xl text-gray-500 md:text-6xl">
                        <div class="mx-auto my-4" id="clock_date"></div>
                        <div class="mx-auto my-4" id="clock_time"></div>
                    </div>
                    <div class="flex justify-evenly">
                        <form action="{{ route('user.attendanceStamp') }}" method="post">
                            @csrf
                            <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">出勤</button>
                        </form>
                        <form action="{{ route('user.leaveWorkStamp') }}" method="post">
                            @csrf
                            <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">退勤</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('/js/watch.js') }}"></script>
</x-app-layout>
