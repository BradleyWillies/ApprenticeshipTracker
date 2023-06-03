@props(['isInteractive' => false, 'apprenticeModuleData'])
<div class="py-12 text-white">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 sm:px-20 border-gray-200">
            <div class="mt-8 text-2xl">
                <table class="table-auto mx-auto">
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
                    @foreach ($apprenticeModuleData as $apprenticeModule)
                        <tr>
                            <td class="border px-4 py-2">{{ App\Models\Block::find($apprenticeModule->module->block_id)->name }}</td>
                            <td class="border px-4 py-2">
                                @if ($isInteractive)
                                    <x-link href="{{route('apprentice_module.edit', $apprenticeModule->id)}}">{{ $apprenticeModule->module->code.' '.$apprenticeModule->module->title }}</x-link>
                                @else
                                    {{ $apprenticeModule->module->code.' '.$apprenticeModule->module->title }}
                                @endif
                            </td>
                            <td class="border px-4 py-2">{{ $apprenticeModule->grade }}</td>
                            <td class="border px-4 py-2">{{ $apprenticeModule->start_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $apprenticeModule->start_date)->format('d/m/Y') : '' }}</td>
                            <td class="border px-4 py-2">{{ $apprenticeModule->end_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $apprenticeModule->end_date)->format('d/m/Y') : '' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
