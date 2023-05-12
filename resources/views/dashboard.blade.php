<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
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

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Apprentice Table') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        <table class="table-auto">
                            <thead>
                            <tr>
                                <th class="px-4 py-2">Block</th>
                                <th class="px-4 py-2">Module</th>
                                <th class="px-4 py-2">Grade</th>
                                <th class="px-4 py-2">Start Date</th>
                                <th class="px-4 py-2">End Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($apprenticeData->modules as $apprenticeModule)
                                <tr>
                                    <td class="border px-4 py-2">{{ $apprenticeModule->block_id }}</td>
                                    <td class="border px-4 py-2">{{ $apprenticeModule->name }}</td>
                                    <td class="border px-4 py-2">{{ $apprenticeModule->pivot->grade }}</td>
                                    <td class="border px-4 py-2">{{ $apprenticeModule->pivot->start_date }}</td>
                                    <td class="border px-4 py-2">{{ $apprenticeModule->pivot->end_date }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
