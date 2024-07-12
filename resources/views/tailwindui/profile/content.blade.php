@php use App\Models\Translation; @endphp

<div class="flex items-center justify-center">
    <div class="max-w-full min-w-full md:min-w-1/2">
        @if($isMobile)
            <div class="pb-2 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-11 text-indigo-600 dark:text-[#E6E4E4]">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                </svg>
            </div>
        @endif

        <div class="text-center pb-4 pt-2">
            <span
                class="text-3xl font-medium leading-6 text-indigo-600 dark:text-[#E6E4E4]">{{ $t[Translation::PROFILE_PAGE_TITLE] }}</span>
            <br>
            @if($isMobile)
                <span class="mt-2 max-w-4xl text-sm text-gray-500 dark:text-[#8899A6]">{{ $t[Translation::PROFILE_PAGE_DESCRIPTION] }}</span>
            @endif
        </div>

        <div class="flex flex-col items-center justify-center space-y-4 pt-4 px-4">
            <a type="button" href="{{ route('user.transactions') }}"
               class="text-center w-full lg:w-1/2 rounded-md dark:bg-[#20B9A6] dark:text-[#FFFFFF] bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">View
                transactions</a>
            <a type="button" href="{{ route('user.change-password') }}"
               class="text-center w-full lg:w-1/2 rounded-md dark:bg-[#20B9A6] dark:text-[#FFFFFF] bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Change
                password</a>
            @if($isMobile)
                <a type="button" href="{{ route('logout') }}"
                   class="text-center w-full md:w-1/2 rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">Log
                    out</a>
            @endif

        </div>
    </div>

</div>
