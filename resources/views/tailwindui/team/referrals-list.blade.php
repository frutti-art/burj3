@php use App\Models\Translation; @endphp

<div class="border border-gray-200 bg-gray-100 dark:bg-[#1F242C] dark:border-none shadow-md rounded-3xl sm:border p-8 mx-2 flex flex-col">
    <div class="flex items-center mb-4">
        <span class="text-indigo-600 dark:text-[#E6E4E4] text-lg font-semibold">{{ $t[Translation::TEAM_PAGE_REFERRALS_LIST_TITLE] }}</span>
    </div>
    <ul role="list" class="px-8 pb-4 pt-2 divide-y divide-gray-300 dark:divide-[#373843]">
        @foreach($levelReferralsInfo as $name => $referralsCount)
            <li class="py-2">
                <div class="flex items-center gap-x-3">
                    <h3 class="flex-auto truncate text-md font-medium leading-6 text-gray-900 dark:text-[#8899A6]">{{ $name }}</h3>
                    <span class="flex-none text-md text-gray-500 dark:text-[#8899A6]">{{ $referralsCount }} {{ $t[Translation::TEAM_PAGE_FRIENDS] }}</span>
                </div>
            </li>
        @endforeach
    </ul>
</div>
