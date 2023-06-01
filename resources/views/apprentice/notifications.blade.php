<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

        <div class="py-10 text-white">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 sm:px-20 border-gray-200">
                    <div class="mt-8 text-2xl">
                        <!-- List of apprentice components -->
                        <div class="max-w-2xl mx-auto">
                            <div class="p-4 mx-auto bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                <div class="flow-root">
                                    @if (count($notificationManagers) > 0)
                                        <!-- list of notifications -->
                                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach ($notificationManagers as $notificationManager)
                                                <li class="py-3 sm:py-4">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-xl font-medium text-gray-900 truncate dark:text-white">
                                                                {{ $notificationManager->user->name }}
                                                            </p>
                                                            <p class="text-base">
                                                                This manager would like access to view your apprenticeship details on this application. Do you wish to accept or decline their request?
                                                            </p>
                                                            <p class="text-xs">
                                                                (This action cannot be undone, only a manager can remove an apprentice)
                                                            </p>
                                                        </div>
                                                        <div class="flex min-w-0">
                                                            <a type="button" method="POST" href="{{ route('update_notification', ['managerId' => $notificationManager->id, 'accepted' => true]) }}" class="cursor-pointer border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
                                                                &#10003;
                                                            </a>
                                                            <a type="button" href="{{ route('update_notification', ['managerId' => $notificationManager->id, 'accepted' => false]) }}" class="cursor-pointer border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
                                                                &#10005;
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No new notifications</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
