<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('tasks.index') }}" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Task Detail</h2>
            </div>
            <a href="{{ route('tasks.edit', $task) }}"
               class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                Edit
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100 flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $task->title }}</h3>
                        <p class="text-sm text-gray-400 mt-0.5">
                            Created {{ $task->created_at->format('M d, Y \a\t g:i A') }}
                        </p>
                    </div>
                    <span class="shrink-0 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $task->getStatusBadgeClass() }}">
                        {{ $task->status_label }}
                    </span>
                </div>

                <div class="px-6 py-5">
                    @if ($task->description)
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $task->description }}</p>
                    @else
                        <p class="text-gray-400 italic">No description provided.</p>
                    @endif
                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                    <span class="text-xs text-gray-400">
                        Last updated {{ $task->updated_at->diffForHumans() }}
                    </span>
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                          onsubmit="return confirm('Move this task to trash?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-500 hover:text-red-700">
                            Move to Trash
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
