<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight ">
            {{$apprentice->user->name}}
        </h2>
        <x-link href="{{route('manager_dashboard')}}" class="text-sm pt-2 inline-block">< Dashboard</x-link>
    </x-slot>

    <x-apprentice-module-table :apprenticeModuleData="$apprenticeModuleData"/>

</x-app-layout>
