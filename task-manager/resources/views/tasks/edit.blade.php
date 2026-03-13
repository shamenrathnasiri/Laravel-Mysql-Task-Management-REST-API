<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('tasks.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Task</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow p-6">
                <form method="POST" action="{{ route('tasks.update', $task) }}">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div class="mb-5">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                        <input
                            id="title"
                            name="title"
                            type="text"
                            value="{{ old('title', $task->title) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-400 @enderror"
                            autofocus
                        />
                        @error('title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-5">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-400 @enderror"
                        >{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                        <select
                            id="status"
                            name="status"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('status') border-red-400 @enderror"
                        >
                            <option value="pending"     {{ old('status', $task->status) === 'pending'     ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed"   {{ old('status', $task->status) === 'completed'   ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <p class="text-xs text-gray-400 mb-6">
                        Created {{ $task->created_at->format('M d, Y \a\t g:i A') }} &middot;
                        Last updated {{ $task->updated_at->diffForHumans() }}
                    </p>

                    <div class="flex justify-between items-center">
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                              onsubmit="return confirm('Move this task to trash?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-500 hover:text-red-700">
                                Move to Trash
                            </button>
                        </form>

                        <div class="flex gap-3">
                            <a href="{{ route('tasks.show', $task) }}"
                               class="px-5 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
