<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Flash message --}}
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-200 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Validation errors --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-200 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" id="save-forms" action="{{ route('places.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- Number --}}
                    <div>
                        <label for="number" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Number</label>
                        <input type="number" name="number" id="number" min="1" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800
                                   dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            value="{{ old('number') }}">
                    </div>

                    {{-- Notes --}}
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Notes</label>
                        <textarea name="notes" id="notes" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800
                                   dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('notes') }}</textarea>
                    </div>
                    {{-- Submit --}}
                    <div class="flex justify-end">
                        <button type="submit" id="save-btn" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2                                    focus:ring-indigo-500 transition ease-in-out duration-150">
                            Save Item
                        </button>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        @vite(['resources/js/dashboard.js'])
    </x-slot>
</x-app-layout>
