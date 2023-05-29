<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Apprentices') }}
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


    <div class="py-6 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 sm:px-20 border-gray-200">
                <div class="mt-8 text-2xl">
                    @if ($apprentices)
                    <table class="table-auto mx-auto">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">Apprentice</th>
                            <th class="px-4 py-2">Programme Start Date</th>
                            <th class="px-4 py-2">Programme End Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($apprentices as $apprentice)
                            <tr>
                                <td class="border px-4 py-2"><x-link href="{{ route('apprentices.show', $apprentice->id) }}">{{ $apprentice->user->name }}</x-link></td>
                                <td class="border px-4 py-2">{{ $apprentice->getProgrammeStartDate() }}</td>
                                <td class="border px-4 py-2">{{ $apprentice->getProgrammeEndDate() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        No apprentices assigned to your account.
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
