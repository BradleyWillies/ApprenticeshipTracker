<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Manage Apprentices') }}
        </h2>
    </x-slot>

    @if ($apprentices)
        <div class="py-10 text-white">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 sm:px-20 border-gray-200">
                    <div class="flex flex-col items-center">
                        <button
                            type="button"
                            class=" border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline"
                        >
                            Add apprentice
                        </button>
                    </div>
                    <div class="mt-8 text-2xl">


                        <!-- This is an example component -->
                        <div class="max-w-2xl mx-auto">
                            <div class="p-4 max-w-md mx-auto bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                <div class="flow-root">
                                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($apprentices as $apprentice)
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-lg font-medium text-gray-900 truncate dark:text-white">
                                                            {{ $apprentice->user->name }}
                                                        </p>
                                                    </div>
                                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        <button
                                                            type="button"
                                                            class="border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline"
                                                        >
                                                            X
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div x-data="{ isOpen: false }">
        <!-- Button to open the modal -->
        <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded" @click="isOpen = true">Open Modal</button>

        <!-- Modal -->
        <div x-show="isOpen" @click.away="isOpen = false" class="fixed inset-0 flex items-center justify-center">
            <div class="modal bg-white rounded-lg shadow-lg p-6">
                <!-- Close button -->
                <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" @click="isOpen = false">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Modal content goes here -->
                <h2 class="text-xl font-bold mb-4">Modal Title</h2>
                <p class="text-gray-700">This is the modal content.</p>
            </div>
        </div>
    </div>

</x-app-layout>
