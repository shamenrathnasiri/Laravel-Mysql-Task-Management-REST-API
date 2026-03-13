<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <p class="text-gray-600 mb-6">Welcome back, <span class="font-semibold text-gray-800">{{ Auth::user()->name }}</span>!</p>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                <a href="{{ route('tasks.index') }}" class="bg-white rounded-xl shadow p-5 hover:shadow-md transition">
                    <p class="text-sm text-gray-500">Total Tasks</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total'] ?? 0 }}</p>
                </a>
                <a href="{{ route('tasks.index', ['status' => 'pending']) }}" class="bg-white rounded-xl shadow p-5 hover:shadow-md transition">
                    <p class="text-sm text-yellow-600">Pending</p>
                    <p class="text-3xl font-bold text-yellow-700 mt-1">{{ $stats['pending'] ?? 0 }}</p>
                </a>
                <a href="{{ route('tasks.index', ['status' => 'in_progress']) }}" class="bg-white rounded-xl shadow p-5 hover:shadow-md transition">
                    <p class="text-sm text-blue-600">In Progress</p>
                    <p class="text-3xl font-bold text-blue-700 mt-1">{{ $stats['in_progress'] ?? 0 }}</p>
                </a>
                <a href="{{ route('tasks.index', ['status' => 'completed']) }}" class="bg-white rounded-xl shadow p-5 hover:shadow-md transition">
                    <p class="text-sm text-green-600">Completed</p>
                    <p class="text-3xl font-bold text-green-700 mt-1">{{ $stats['completed'] ?? 0 }}</p>
                </a>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('tasks.create') }}"
                   class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    + New Task
                </a>
                <a href="{{ route('tasks.index') }}"
                   class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition">
                    View All Tasks
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
