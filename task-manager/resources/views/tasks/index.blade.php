<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Tasks</h2>
            <div class="flex gap-3">
                <a href="{{ route('tasks.trashed') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition">
                    🗑 Trash
                </a>
                <a href="{{ route('tasks.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    + New Task
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Filters --}}
            <form method="GET" action="{{ route('tasks.index') }}" class="mb-6 flex flex-col sm:flex-row gap-3">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by title or description…"
                    class="flex-1 rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                />
                <select name="status" class="rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    <option value="">All Statuses</option>
                    <option value="pending"     {{ request('status') === 'pending'     ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed"   {{ request('status') === 'completed'   ? 'selected' : '' }}>Completed</option>
                </select>
                <button type="submit"
                    class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    Filter
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('tasks.index') }}"
                       class="px-5 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition text-center">
                        Clear
                    </a>
                @endif
            </form>

            {{-- Task Table --}}
            <div class="bg-white rounded-xl shadow overflow-hidden">
                @if ($tasks->isEmpty())
                    <div class="p-12 text-center text-gray-400">
                        <svg class="mx-auto mb-4 h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-lg font-medium">No tasks found.</p>
                        <p class="text-sm mt-1">
                            <a href="{{ route('tasks.create') }}" class="text-indigo-600 hover:underline">Create your first task</a>
                        </p>
                    </div>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Created</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($tasks as $task)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('tasks.show', $task) }}" class="font-medium text-gray-900 hover:text-indigo-600">
                                            {{ $task->title }}
                                        </a>
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
                                        {{ $task->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <a href="{{ route('tasks.show', $task) }}"
                                           class="text-sm text-gray-500 hover:text-indigo-600 mr-3">View</a>
                                        <a href="{{ route('tasks.edit', $task) }}"
                                           class="text-sm text-indigo-600 hover:text-indigo-800 mr-3">Edit</a>
                                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline"
                                              onsubmit="return confirm('Move this task to trash?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    @if ($tasks->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $tasks->links() }}
                        </div>
                    @endif
                @endif
            </div>

            {{-- Results count --}}
            @if ($tasks->total() > 0)
                <p class="mt-3 text-sm text-gray-400 text-right">
                    Showing {{ $tasks->firstItem() }}–{{ $tasks->lastItem() }} of {{ $tasks->total() }} task(s)
                </p>
            @endif

        </div>
    </div>
</x-app-layout>
