<div>
    <div class="mx-auto max-w-7xl sm:px-2 lg:px-8 mb-6">
        <div class="mx-auto max-w-2xl space-y-8 sm:px-4 lg:max-w-full lg:px-0">
            <div class="shadow-sm sm:rounded-lg sm:border">
                <div class="flex items-center border-b border-gray-200 px-2 pb-2 pt-1">
                    <dl class="flex flex-1 text-sm">
                        <div class="flex pr-8 items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-blue-600 dark:text-blue-300">
                                <path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 0 1 .359.852L12.982 9.75h7.268a.75.75 0 0 1 .548 1.262l-10.5 11.25a.75.75 0 0 1-1.272-.71l1.992-7.302H3.75a.75.75 0 0 1-.548-1.262l10.5-11.25a.75.75 0 0 1 .913-.143Z" clip-rule="evenodd" />
                            </svg>
{{--                            <dd class="text-gray-500">Level:</dd>--}}
                            <dt class="font-medium text-gray-900 dark:text-[#FFFFFF]">{{ $user->level->name ?? 'No level' }}</dt>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-blue-600 dark:text-blue-300">
                                <path d="M4.5 3.75a3 3 0 0 0-3 3v.75h21v-.75a3 3 0 0 0-3-3h-15Z" />
                                <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-7.5Zm-18 3.75a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" clip-rule="evenodd" />
                            </svg>
                            <dt class="font-medium text-gray-900 dark:text-[#FFFFFF]">{{ $user->balance }} USDT</dt>
                        </div>
                        <div class="flex items-center justify-end flex-shrink-0 ml-auto">
                            <svg id="theme-toggle" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-600 dark:text-blue-300">
                                <path id="icon-sun" class="block dark:hidden" stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                <path id="icon-moon" class="hidden dark:block" stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                            </svg>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
