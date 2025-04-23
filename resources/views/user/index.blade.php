<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <!-- Search Form -->
                <form action="{{ route('user.index') }}" method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name..." autofocus
                        class="border border-gray-300 rounded-md px-4 py-2 text-sm w-full md:w-1/3" />
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700">Search</button>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Id</th>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3 hidden md:table-cell">Email</th>
                                <th class="px-6 py-3">Todo</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $data)
                                <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-800 dark:even:bg-gray-700">
                                    <td class="px-6 py-4">{{ $data->id }}</td>
                                    <td class="px-6 py-4">{{ $data->name }}</td>
                                    <td class="px-6 py-4 hidden md:table-cell">{{ $data->email }}</td>
                                    <td class="px-6 py-4">
                                        {{ $data->todos->count() }}
                                        (<span class="text-green-600">{{ $data->todos->where('is_done', true)->count() }}</span> /
                                        <span class="text-blue-600">{{ $data->todos->where('is_done', false)->count() }}</span>)
                                    </td>
                                    <td class="px-6 py-4">
                                        <!-- Tambahkan tombol atau link aksi di sini jika perlu -->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        No data available
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4">
                    {{ $users->appends(['search' => request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
