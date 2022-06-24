<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
            @if(auth()->user()->role_id == 1)
            <a href="{{ url('user/dashboard') }}">User Dashboard</a>
            @elseif(auth()->user()->role_id == 2)
            <a href="{{ url('student/dashboard') }}">Student Dashboard</a>
            @else
            <a href="{{ url('teacher/dashboard') }}">Teacher Dashboard</a>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
