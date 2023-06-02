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
                        <div class="max-w-2xl mx-auto">
                            <div class="p-4 mx-auto bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                <div class="flow-root">
                                    @if (count($notifications) > 0)
                                        <!-- list of notifications -->
                                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach ($notifications as $notification)
                                                <?php
                                                    $apprentice = new \App\Models\Apprentice();
                                                    foreach ($apprentices as $curApprentice) {
                                                        if ($curApprentice->id == $notification->apprentice_id) $apprentice = $curApprentice;
                                                    }
                                                ?>
                                                <li class="py-3 sm:py-4">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-xl font-medium text-gray-900 truncate dark:text-white">
                                                                {{ $apprentice->user->name}}
                                                            </p>
                                                            <p class="text-base">
                                                            {{ $notification->apprentice_accepted ? 'Accepted' : 'Declined' }}
                                                            </p>
                                                            <p class="text-base">
                                                                This apprentice has <b>{{ $notification->apprentice_accepted ? 'accepted' : 'declined' }}</b> your request to add them.
                                                            </p>
                                                        </div>
                                                        <div class="flex min-w-0">
                                                            <a type="button" href="{{ route('delete_notification', ['notificationId' => $notification->id]) }}" class="cursor-pointer border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
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
