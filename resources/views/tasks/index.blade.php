<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('tasks.create') }}" class="inline-block mb-6 bg-blue-600 text-white px-6 py-3 rounded-lg text-lg transition-none" style="background-color: #3490dc; color: white; padding: 10px 20px; border-radius: 8px; font-size: 16px; transition: background-color 0.3s;">
                        Create New Task
                    </a>

                    @if(session('success'))
                        <div class="mb-4 text-green-500 font-semibold bg-green-100 border-l-4 border-green-600 p-4 rounded-lg" style="color:green;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($tasks->isEmpty())
                        <div class="flex items-center justify-center min-h-[200px]">
                            <p class="text-gray-500">No tasks available.</p>
                        </div>
                    @else
                    <div class="mb-6 w-100">
                        <input type="text" id="search" class="border p-2 rounded" style="width: 300px; color: black" placeholder="Search by Priority Number..." oninput="filterTasks()">
                    </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg shadow-lg overflow-hidden">
                                <thead class="bg-blue-600 text-white">
                                    <tr>
                                        <th class="px-6 py-3 text-left">Titulli</th>
                                        <th class="px-6 py-3 text-left">Pershkrimi</th>
                                        <th class="px-6 py-3 text-left">Data e Krijimit</th>
                                        <th class="px-6 py-3 text-left">Statusi</th>
                                        <th class="px-6 py-3 text-left">Prioriteti</th>
                                        <th class="px-6 py-3 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700" id="taskTable">
                                    @foreach ($tasks as $task)
                                        <tr class="task-row border-t border-gray-200 text-white" data-status="{{ $task->status ? 'Perfunduar' : 'Pa Perfunduar' }}" data-priority="{{ $task->priority }}">
                                            <td class="px-6 py-4">{{ $task->title }}</td>
                                            <td class="px-6 py-4">{{ $task->description }}</td>
                                            <td class="px-6 py-4">{{ $task->created_at->format('d M Y') }}</td>
                                            <td class="px-6 py-4">{{ $task->status ? 'Perfunduar' : 'Pa Perfunduar' }}</td>
                                            <td class="px-6 py-4">
                                                @if($task->priority == 1)
                                                            1 - i lartë
                                                        @elseif($task->priority == 2)
                                                            2 - mesatar
                                                        @elseif($task->priority == 3)
                                                            3 - i ulet
                                                        @endif</td>
                                            <td class="px-6 py-4 flex space-x-8">
                                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-yellow-500" style="color: yellow;">
                                                    Edit
                                                </a>

                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function filterTasks() {
        const searchQuery = document.getElementById("search").value.toLowerCase();
        const rows = document.querySelectorAll("#taskTable .task-row");

        rows.forEach(row => {
            const priority = row.getAttribute("data-priority").toLowerCase();

            // Check if either status or priority matches the search query
            if (priority.includes(searchQuery)) {
                row.style.display = ""; // Show row if there's a match
            } else {
                row.style.display = "none"; // Hide row if no match
            }
        });
    }
</script>
