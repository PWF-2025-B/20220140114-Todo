<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Container utama --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Search Form dan Notifikasi dalam satu baris --}}
                <div class="p-4">
                    <div class="p-4 bg-gray-800 flex justify-between items-center">
                        {{-- Form Pencarian --}}
                        <form action="{{ route('user.index') }}" method="GET" class="flex gap-2">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Search by name or email..." 
                                autofocus
                                class="border border-gray-600 rounded-md px-4 py-2 text-sm w-60 bg-gray-800 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 !bg-gray-800"
                            />
                            <button 
                                type="submit"
                                class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-100"
                            >
                                Search
                            </button>
                        </form>

                        {{-- Alert success --}}
                        @if (session('success'))
                            <div class="text-sm text-green-600 bg-green-100 border border-green-300 rounded px-4 py-2">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>

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
                            @forelse ($users as $user)
                                <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-800 dark:even:bg-gray-700">
                                    <td class="px-6 py-4">{{ $user->id }}</td>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4 hidden md:table-cell">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        {{ $user->todos->count() }}
                                        (<span class="text-green-600">{{ $user->todos->where('is_done', true)->count() }}</span> /
                                        <span class="text-blue-600">{{ $user->todos->where('is_done', false)->count() }}</span>)
                                    </td>
                                    <td class="px-6 py-4 space-x-2">
                                        @if ($user->is_admin)
                                            <form action="{{ route('user.removeAdmin', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="text-yellow-600 hover:underline text-sm">Remove Admin</button>
                                            </form>
                                        @else
                                            <form action="{{ route('user.makeAdmin', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="text-green-600 hover:underline text-sm">Make Admin</button>
                                            </form>
                                        @endif

                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 whitespace-nowrap text-sm hover:underline">
                                                Delete
                                            </button>
                                        </form>
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

                {{-- Pagination --}}
                <div class="px-6 py-4">
                    {{ $users->appends(['search' => request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>