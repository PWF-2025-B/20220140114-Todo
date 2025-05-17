<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo List') }}
        </h2>
    </x-slot>

    <div class="py-8 mt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="flex items-center justify-between px-6 py-4 border-b dark:border-gray-700">
                    <a href="{{ route('todo.create') }}"
                        class="inline-block bg-white text-gray-700 uppercase font-semibold text-sm px-6 py-2 rounded-md shadow-sm hover:bg-gray-100 transition duration-200">
                        Create
                    </a>

                    @if (session('success'))
                        <div class="text-sm text-green-600 bg-green-100 border border-green-300 rounded px-4 py-2">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Title</th>
                                <th class="px-6 py-3">Category</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todos as $todo)
                                <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800 border-b">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <a href="{{ route('todo.edit', $todo->id) }}" class="hover:underline text-sm">
                                            {{ $todo->title }}
                                        </a>
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $todo->category->title ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if (!$todo->is_done)
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold 
                                                        bg-blue-100 text-indigo-600 dark:bg-blue-900 dark:text-indigo-600">
                                                Ongoing
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold 
                                                         bg-green-100 text-green-600 dark:bg-green-900 dark:text-green-300">
                                                Completed
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 space-x-2">
                                        <a href="{{ route('todo.edit', $todo->id) }}"
                                           class="text-indigo-600 hover:underline text-sm">Edit</a>

                                        @if (!$todo->is_done)
                                            <form action="{{ route('todo.complete', $todo->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="text-green-600 hover:underline text-sm">Complete</button>
                                            </form>
                                        @else
                                            <form action="{{ route('todo.incomplete', $todo->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="text-yellow-600 hover:underline text-sm">Uncomplete</button>
                                            </form>
                                        @endif

                                        <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 text-sm hover:underline">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No data available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- ✅ Perbaikan variabel disini --}}
                @if ($todoCompleted > 1)
                <div class="px-6 py-4">
                    <form action="{{ route('todo.destroyCompleted') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-block bg-red-600 text-white uppercase font-semibold text-sm px-6 py-2 rounded-md shadow hover:bg-red-700 transition duration-200">
                            Delete All Completed Task
                        </button>
                    </form>
                </div>
                @endif

                {{-- ✅ Tambahkan pagination link --}}
                <div class="px-6 py-4">
                    {{ $todos->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
