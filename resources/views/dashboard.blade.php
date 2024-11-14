<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('tasks.create') }}" class="inline-block mb-6 bg-blue-600 text-white px-6 py-3 rounded-lg text-lg transition-none" style="background-color: #3490dc; color: white; padding: 10px 20px; border-radius: 8px; font-size: 16px; transition: background-color 0.3s;">
                        Create New Task
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
