@php use App\Models\Translation; @endphp

<div class="border rounded-3xl border-gray-200 bg-gray-100 dark:bg-[#1F242C] dark:border-none shadow-sm sm:border p-8 mx-2 flex flex-col min-h-[300px]">
    <div class="flex items-center mb-4">
        <span class="text-indigo-600 dark:text-[#E6E4E4] text-lg font-semibold">Account info</span>
    </div>

    <p class="text-gray-500 dark:text-[#8899A6] text-sm">Balance</p>

    <div class="flex items-center mb-16">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="size-6 dark:text-[#E6E4E4]">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/>
        </svg>

        <span class="text-gray-900 dark:text-[#E6E4E4] font-bold text-lg pl-1">{{ $user->balance }} USDT</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div>
            <p class="text-gray-500 dark:text-[#8899A6] text-sm">Daily return %</p>
            <p class="text-gray-900 dark:text-[#E6E4E4] font-bold text-xl">{{ $user->level?->dailyReturnPercentage ?? '-' }}%</p>
        </div>
        <div>
            <p class="text-gray-500 dark:text-[#8899A6] text-sm">Daily return</p>
            <div class="flex items-center">
                <span class="text-gray-900 dark:text-[#E6E4E4] font-bold text-xl">{{ $user->level?->daily_return_amount ?? '-' }} USDT</span>
            </div>
        </div>
        <div>
            <p class="text-gray-500 dark:text-[#8899A6] text-sm">Current level</p>
            <div class="flex items-center">
                <span class="text-gray-900 dark:text-[#E6E4E4] font-bold text-xl">{{ $user->level?->name ?? '-' }}</span>
            </div>
        </div>
    </div>
    <div class="flex-grow"></div>

    <div class="grid grid-cols-2 gap-4 mt-auto">
        <a href="{{ route('user.deposit') }}" class="bg-indigo-600 text-center text-white dark:bg-[#20B9A6] dark:text-[#FFFFFF] font-semibold py-2 px-4 rounded">
            Deposit
        </a>
        <a
            href="{{ route('user.withdraw') }}"
            class="bg-transparent text-center border border-indigo-600 text-indigo-600 dark:bg-[#1F242C]  dark:text-[#FFFFFF] dark:border-[#FFFFFF] font-semibold py-2 px-4 rounded">
            Withdraw
        </a>
    </div>
</div>
