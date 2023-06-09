<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Add Modules') }}
        </h2>
    </x-slot>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-2">
                <div class="sm:px-20 border-gray-200">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Invalid input: </strong>
                        <span class="block sm:inline">{{ $error }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="py-2 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="sm:px-20 border-gray-200">
                <div class="mt-8 text-2xl">

                    <form method="POST" action="{{ route('apprentice_module.store') }}">
                        @csrf
                        <table class="table-auto mx-auto">
                            <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($modules as $module)
                                <tr>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="modules[]" value="{{ $module->id }}" @if (array_search($module->id, old('modules') ?? []) !== false) checked @endif>
                                            {{ $module->code . ' - ' . $module->title }}
                                        </label>
                                    </td>
                                    <td>
                                        <x-text-input id="start_date" name="start_dates[{{ $module->id }}]" type="date" class="mt-1 block w-full" value="{{ old('start_dates.' . $module->id) }}" placeholder="dd/mm/yyyy" autofocus />
                                    </td>
                                    <td>
                                        <x-text-input id="end_date" name="end_dates[{{ $module->id }}]" type="date" class="mt-1 block w-full" value="{{ old('end_dates.' . $module->id) }}" placeholder="dd/mm/yyyy" autofocus />
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="flex flex-col items-center">
                            <button type="submit" class="border border-green-500 bg-green-500 text-black font-bold rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                                Add Modules
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
