<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight ">
            {{$apprenticeModule->module->code.' '.$apprenticeModule->module->title}}
        </h2>
        <x-link href="{{url()->previous()}}" class="text-sm pt-2 inline-block">< Dashboard</x-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('apprentice_module.update', $apprenticeModule) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div class="flex flex-wrap -mx-4">
                            <div class="w-full md:w-1/2 px-4">
                                <x-input-label for="start_date" value="Start date" />
                                <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date', $apprenticeModule->start_date)" placeholder="dd/mm/yyyy"  autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                            </div>

                            <div class="w-full md:w-1/2 px-4">
                                <x-input-label for="end_date" value="End date" />
                                <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="old('end_date', $apprenticeModule->end_date)" placeholder="dd/mm/yyyy"  autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-4">
                            <div class="w-full md:w-1/2 px-4">
                                <x-input-label for="grade" value="Grade" />
                                <x-text-input id="grade" name="grade" type="number" class="mt-1 block w-full" :value="old('grade', $apprenticeModule->grade)" min="0" max="100" autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('grade')" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-green-500 text-black font-bold rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center">
        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
            <form method="post" action="{{ route('apprentice_module.destroy', $apprenticeModule) }}">
                @csrf
                @method('delete')
                <button type="submit" class="bg-red-600 text-black font-bold rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-700 focus:outline-none focus:shadow-outline">
                    Delete
                </button>
            </form>
        </div>
    </div>

</x-app-layout>
