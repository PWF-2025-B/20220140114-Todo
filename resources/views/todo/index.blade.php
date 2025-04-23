<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo List') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Alert jika todo berhasil dibuat --}}
            @if (session('success'))
                <div class="mb-4 text-sm text-green-600 bg-green-100 border border-green-300 rounded px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tombol Create Todo --}}
            <div class="flex justify-start">
                <a href="{{ route('todo.create') }}"
                class="inline-block border border-gray-300 text-white bg-transparent hover:bg-gray-400 px-6 py-3 rounded-lg shadow-sm transition-all duration-200 text-sm font-semibold">
                    Create Todo
                </a>
            </div>

            {{-- Daftar Todo --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Title</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todos as $data)
                                <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-900 dark:even:bg-gray-800 border-b">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <a href="{{ route('todo.edit', $data->id) }}" class="hover:underline text-sm">
                                            {{ $data->title }}
                                        </a>
                                    </td>

                                    <td class="px-6 py-4">
                                        @if (!$data->is_done)
                                            <span class="inline-block bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded dark:bg-red-900 dark:text-red-300">
                                                On Going
                                            </span>
                                        @else
                                            <span class="inline-block bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded dark:bg-green-900 dark:text-green-300">
                                                Done
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <a href="{{ route('todo.edit', $data->id) }}"
                                            class="text-indigo-600 hover:underline text-sm">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No data available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
