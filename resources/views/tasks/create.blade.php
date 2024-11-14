<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('error'))
                        <div class="alert alert-danger text-red-600 bg-red-100 p-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="form-label text-gray-700 dark:text-gray-300">Titulli</label>
                            <input type="text" class="form-control border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md shadow-sm w-full p-2" id="title" name="title">
                            @error('title')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label text-gray-700 dark:text-gray-300">Pershkrimi</label>
                            <textarea class="form-control border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md shadow-sm w-full p-2" id="description" name="description" ></textarea>
                            @error('description')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="priority" class="form-label text-gray-700 dark:text-gray-300">Prioriteti</label>
                            <select class="form-control border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md shadow-sm w-full p-2" id="priority" name="priority" required>
                                <option value=""></option>
                                <option value="1">1 - i larte</option>
                                <option value="2">2 - mesatar</option>
                                <option value="3">3 - i ulet</option>
                            </select>
                            @error('priority')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn-primary mb-3" style="background-color: #3490dc; color: white; padding: 10px 20px; border-radius: 8px; font-size: 16px; transition: background-color 0.3s;">
                            Create Task
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
