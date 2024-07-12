@php use App\Models\Translation; @endphp

<div
    class="border border-gray-200 bg-gray-100 dark:bg-[#1F242C] dark:border-none shadow-sm rounded-3xl sm:border p-8 mx-2 flex flex-col min-h-[200px]">

    <div class="flex items-center mb-4">
        <span class="text-indigo-600 dark:text-[#E6E4E4] text-lg font-semibold">Claim info</span>
    </div>
    <div class="mb-6 mt-2 space-y-2 font-normal leading-6 text-gray-600 dark:text-[#E6E4E4] text-center">
        @if($user->level_id)
            To claim <span
                class="inline-flex items-center rounded-md bg-blue-50 px-1.5 py-1 text-xs font-medium text-blue-700 dark:text-gray-900 ring-1 ring-inset">{{ $user->level->daily_return_amount }} USDT</span>
            please come back in:
        @else
            Next claim in:
        @endif
        <div class="flex items-center text-gray-900 justify-center space-x-2 text-center auto-cols-max pt-8 dark:text-[#E6E4E4]">
            <div class="flex flex-row items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>

                <span class="countdown text-sm font-semibold md:text-2xl">
                    <span id="countdown-hours"></span>
                </span>
                hours
            </div>
            <div class="flex flex-row items-center justify-center">
                <span class="countdown text-sm font-semibold md:text-2xl">
                  <span id="countdown-minutes"></span>
                </span>
                min
            </div>
            <div class="flex flex-row items-center justify-center">
                <span class="countdown text-sm font-semibold md:text-2xl">
                  <span id="countdown-seconds"></span>
                </span>
                sec
            </div>
        </div>
    </div>


    <div class="flex-grow"></div>

    <div class="pt-2 mt-auto">
        @if($user->level_id)
            @if($userIsEligibleToClaimBonus)
                <form action="{{ route('user.claim-bonus') }}" method="post">
                    @csrf
                    <button type="submit"
                            class="w-full rounded-md bg-indigo-600 dark:bg-[#20B9A6] dark:text-[#FFFFFF] dark:text-white px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        {{ $t[Translation::GENERAL_PAGE_CLAIM_TEXT] }} {{ $user->level->daily_return_amount }} USDT
                    </button>
                </form>
            @else
                <button type="button"
                        class="w-full rounded-md bg-gray-100 dark:bg-[#EEEFF0] dark:ring-0 px-3.5 py-2.5 text-sm font-semibold text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300">
                    {{ $t[Translation::GENERAL_PAGE_CLAIM_TEXT] }} <span id="count" class="mx-2"></span> USDT
                    </span>
                </button>
            @endif
        @else
            <button type="button"
                    class="w-full rounded-md bg-gray-100 px-3.5 py-2.5 text-sm font-semibold text-gray-400 shadow-sm ring-1 ring-inset ring-gray-300">
                Upgrade to claim bonus
            </button>
        @endif
    </div>

</div>

@include('tailwindui.general.claim-js')
