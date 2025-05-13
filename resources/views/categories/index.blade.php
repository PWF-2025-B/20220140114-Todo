<x-app-layout>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo Category') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center items-center">
        <div class="w-full max-w-7xl bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">

            {{-- Header action + success message --}}
            <div class="flex items-center justify-between px-6 py-4 border-b dark:border-gray-700">
                <a href="{{ route('category.create')}}" 
                   class="inline-block bg-white text-gray-700 uppercase font-semibold text-sm px-6 py-2 rounded-md shadow-sm hover:bg-gray-100 transition duration-200">
                    CREATE
                </a>

                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition
                         x-init="setTimeout(() => show = false, 5000)"
                         class="text-sm text-green-600 bg-green-100 border border-green-300 rounded px-4 py-2">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            {{-- Danger message (optional) --}}
            @if (session('danger'))
                <div x-data="{ show: true }" x-show="show" x-transition
                     x-init="setTimeout(() => show = false, 5000)"
                     class="px-6 pt-4 text-sm text-red-600 bg-red-100 border border-red-300 rounded mx-6">
                    {{ session('danger') }}
                </div>
            @endif

            {{-- Table content --}}
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left">Title</th>
                            <th scope="col" class="px-6 py-3">Todo</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-b border-gray-600 dark:border-gray-500">
                                <td class="px-6 py-4 font-medium text-white dark:text-white">
                                    <a href="{{ route('category.edit', $category) }}" class="hover:underline text-xs">
                                        {{ $category->title }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">{{ $category->todos->count() }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('category.destroy', $category) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
