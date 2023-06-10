<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Modules') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in ") }}
                    @if(auth()->user()->isManager())
                        as a Manager
                    @else
                        as an Apprentice
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-apprentice-module-table :apprenticeModuleData="$apprenticeModuleData" isInteractive="true"/>

</x-app-layout>
