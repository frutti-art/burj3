@php use App\Models\Translation; @endphp

<div>
    <div class="border border-gray-200 bg-gray-100 dark:bg-[#1F242C] dark:border-none shadow-sm rounded-3xl sm:border p-8 mx-2 flex flex-col">
        <div class="flex items-center mb-4">
            <span class="text-indigo-600 dark:text-[#E6E4E4] text-lg font-semibold">{{ $t[Translation::TEAM_PAGE_QR_CODE_LIST_TITLE] }}</span>
        </div>
        <div class="pt-4 flex items-center justify-center">
            {!! QrCode::size(200)->generate($user->referral_code) !!}
        </div>

        <div class="flex flex-col justify-center items-center pt-8">

            <div class="flex items-center justify-center pb-4 dark:text-[#E6E4E4]">
                {{ $t[Translation::TEAM_PAGE_YOUR_CODE] }} &nbsp;
                <div class="stat-value text-lg font-bold">{{ $user->referral_code }}</div>
            </div>

            <div>
                <button id="shareButton" type="button"
                        class="flex items-center justify-center rounded-md bg-indigo-600 dark:bg-[#20B9A6] dark:text-[#FFFFFF] px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    {{ $t[Translation::TEAM_PAGE_SHARE_URL_WITH_FRIENDS] }} &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"/>
                    </svg>


                </button>
            </div>
        </div>
    </div>


</div>
