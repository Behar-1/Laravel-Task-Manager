<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('error'))
                        <div class="alert alert-danger text-red-500 mb-4">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="title" class="form-label text-lg font-medium text-gray-700 dark:text-gray-300">Titulli</label>
                            <input type="text" class="form-control block w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" id="title" name="title" value="{{ old('title', $task->title) }}" required>
                            @error('title') <small class="text-red-500">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-6">
                            <label for="description" class="form-label text-lg font-medium text-gray-700 dark:text-gray-300">Pershkrimi</label>
                            <textarea class="form-control block w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" id="description" name="description" required>{{ old('description', $task->description) }}</textarea>
                            @error('description') <small class="text-red-500">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-6">
                            <label for="status" class="form-label text-lg font-medium text-gray-700 dark:text-gray-300">Statusi</label>
                            <select class="form-control block w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" id="status" name="status" required>
                                <option value="1" {{ old('status', $task->status) === true ? 'selected' : '' }}>Perfunduar</option>
                                <option value="0" {{ old('status', $task->status) === false ? 'selected' : '' }}>Pa Perfunduar</option>
                            </select>
                            @error('status') <small class="text-red-500">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-6">
                            <label for="priority" class="form-label text-lg font-medium text-gray-700 dark:text-gray-300">Prioriteti</label>
                            <select class="form-control block w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" id="priority" name="priority" required>
                                <option value="1" {{ old('priority', $task->priority) == 1 ? 'selected' : '' }}>1 - i larte</option>
                                <option value="2" {{ old('priority', $task->priority) == 2 ? 'selected' : '' }}>2 - mesatar</option>
                                <option value="3" {{ old('priority', $task->priority) == 3 ? 'selected' : '' }}>3 - i ulet</option>
                            </select>
                            @error('priority')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn-primary mb-3" style="background-color: #3490dc; color: white; padding: 10px 20px; border-radius: 8px; font-size: 16px; transition: background-color 0.3s;">Update Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
