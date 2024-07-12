@php use App\Models\Translation; @endphp

<div class="border border-gray-200 bg-gray-100 dark:bg-[#1F242C] dark:border-none shadow-sm rounded-3xl sm:border p-8 mx-2 flex flex-col min-h-[300px]">
    <div class="flex items-center mb-4">
        <span class="text-indigo-600 dark:text-[#E6E4E4] text-lg font-semibold">{{ $t[Translation::HOME_NEW_MEMBERS_TITLE] }}</span>
    </div>

    <div id="feed-container" class="p-4 h-64 overflow-hidden">
        <div class="flow-root">
            <ul id="scroll-container" role="list" class="mb-8 text-center flex flex-col items-center justify-center">
                @foreach($newMembers as $newMember)
                    <li class="relative pb-8 feed-item">
                        <div class="relative flex space-x-3">
                            <div>
                            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-6 ring-white">
                                <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            </div>
                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-[#8899A6]">{!! $newMember !!}</b></p>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
