<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Manage Apprentices') }}
        </h2>
    </x-slot>

    @if ($apprenticesOfManager)
        <div class="py-10 text-white">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 sm:px-20 border-gray-200">
                    <div class="flex flex-col items-center">
                        <div x-data="{ isOpen: false }" class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            <!-- Button to open the add apprentice modal -->
                            <button type="button" @click="isOpen = true" class="border border-green-500 bg-green-500 text-black font-bold rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                                Add apprentice
                            </button>

                            <!-- Modal -->
                            <div x-show="isOpen" @click.away="isOpen = false" class="fixed inset-0 flex items-center justify-center text-black">
                                <div class="relative modal bg-white rounded-lg shadow-lg p-6">
                                    <!-- Modal close button -->
                                    <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" @click="isOpen = false">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>

                                    <!-- Modal content -->
                                    <p class="mt-2">Select an apprentice to add to your account.</p>
                                    <p>A request will be sent to them.</p>
                                    <div class="flex mt-2">
                                        <form action="{{ route('add_manager_apprentice') }}">
                                            @csrf
                                            <select name="apprentice">
                                                @foreach ($allApprentices as $apprentice)
                                                    {{ $match = false }}
                                                    <!-- Check if the apprentice is already assigned to the manager -->
                                                    @foreach ($apprenticesOfManager as $apprenticeOfManager)
                                                        @if ($apprentice->user->id == $apprenticeOfManager->user->id)
                                                            {{ $match = true }}
                                                        @endif
                                                    @endforeach
                                                    <!-- if the apprentice isn't already assigned to the manager add it as an option to the select box -->
                                                    @if ($match != true)
    {{--                                                <option value="{{ $apprentice->user->id }}">{{ $apprentice->user->name }}</option>--}}
                                                        <option value="{{ $apprentice }}">{{ $apprentice->user->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                            <button type="submit" class="cursor-pointer mx-auto border border-green-500 bg-green-500 text-black font-bold rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                                                Send request
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 text-2xl">


                        <!-- List of apprentice components -->
                        <div class="max-w-2xl mx-auto">
                            <div class="p-4 max-w-md mx-auto bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                <div class="flow-root">
                                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($apprenticesOfManager as $apprentice)
                                            <li class="py-3 sm:py-4">
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-lg font-medium text-gray-900 truncate dark:text-white">
                                                            {{ $apprentice->user->name }}
                                                        </p>
                                                    </div>
                                                    <div x-data="{ isOpen: false }" class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                        <!-- Button to open the remove apprentice modal -->
                                                        <button type="button" @click="isOpen = true" class="border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
                                                            &#10005;
                                                        </button>

                                                        <!-- Modal -->
                                                        <div x-show="isOpen" @click.away="isOpen = false" class="fixed inset-0 flex items-center justify-center text-black">
                                                            <div class="relative modal bg-white rounded-lg shadow-lg p-6">
                                                                <!-- Modal close button -->
                                                                <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" @click="isOpen = false">
                                                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                    </svg>
                                                                </button>

                                                                <!-- Modal content -->
                                                                <h2 class="text-xl font-bold mb-4">{{ $apprentice->user->name }}</h2>
                                                                <p>Are you sure you want to remove this apprentice from your account?</p>
                                                                <div class="flex">
                                                                    <a type="button" href="{{ route('remove_manager_apprentice', $apprentice) }}" class="cursor-pointer mx-auto border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
                                                                        Remove apprentice
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
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

</x-app-layout>
