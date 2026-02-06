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

                <form method="POST" id="save-forms" action="{{ route('items.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                        <input type="text" name="name" id="name" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800
                                   dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            value="{{ old('name') }}">
                    </div>

                    {{-- Quantity --}}
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Quantity</label>
                        <input type="number" name="quantity" id="quantity" min="1" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800
                                   dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            value="{{ old('quantity') }}">
                    </div>

                    {{-- Place --}}
                    <div>
                        <label for="place_number" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Place</label>
                        <select name="place_number" id="place_number" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800
                                   dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Select a place</option>
                            @foreach ($places as $place)
                                <option value="{{ $place->number }}" {{ old('place_number') == $place->number ? 'selected' : '' }}>
                                    {{ $place->name ?? 'Place ' . $place->number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800
                                   dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
                    </div>

                    {{-- Notes --}}
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Notes</label>
                        <textarea name="notes" id="notes" rows="2"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800
                                   dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('notes') }}</textarea>
                    </div>

                    {{-- Image --}}
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Image</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-900 dark:text-gray-100
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-md file:border-0
                                   file:text-sm file:font-semibold
                                   file:bg-indigo-50 file:text-indigo-700
                                   hover:file:bg-indigo-100
                                   dark:file:bg-indigo-900 dark:file:text-indigo-200 dark:hover:file:bg-indigo-800">
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold
                                   text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                                   focus:ring-indigo-500 transition ease-in-out duration-150">
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
