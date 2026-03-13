<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('tasks.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Trash</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow overflow-hidden">
                @if ($tasks->isEmpty())
                    <div class="p-12 text-center text-gray-400">
                        <svg class="mx-auto mb-4 h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <p class="text-lg font-medium">Trash is empty.</p>
                    </div>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Deleted</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($tasks as $task)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <p class="font-medium text-gray-700 line-through">{{ $task->title }}</p>
                                        @if ($task->description)
                                            <p class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ $task->description }}</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $task->getStatusBadgeClass() }}">
                                            {{ $task->status_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $task->deleted_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <form method="POST" action="{{ route('tasks.forceDelete', $task->id) }}" class="inline"
                                              onsubmit="return confirm('Permanently delete this task? This cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-500 hover:text-red-700">Delete Forever</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($tasks->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $tasks->links() }}
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
