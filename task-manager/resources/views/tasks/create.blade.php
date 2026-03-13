<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('tasks.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Task</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow p-6">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf

                    {{-- Title --}}
                    <div class="mb-5">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                        <input
                            id="title"
                            name="title"
                            type="text"
                            value="{{ old('title') }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-400 @enderror"
                            placeholder="Enter task title"
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
                            placeholder="Optional description…"
                        >{{ old('description') }}</textarea>
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
                            <option value="pending"     {{ old('status', 'pending') === 'pending'     ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed"   {{ old('status') === 'completed'   ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex justify-end gap-3">
                        <a href="{{ route('tasks.index') }}"
                           class="px-5 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-300 transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                            Create Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
