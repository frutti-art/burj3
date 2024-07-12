@php use App\Models\Translation; @endphp

<div class="block sm:hidden">
    <div id="home-content" class="hidden">
        <div class="text-center">
            <div id="lottie-animation" class="md:w-1/2 w-3/4 h-3/4 mx-auto"></div>
            <p class="mt-1 text-sm text-gray-500 dark:text-[#FFFFFF]">{{ $user->level ? $t[Translation::HOME_CTA_TEXT] : $t[Translation::HOME_CTA_TEXT_WHEN_NO_LEVEL] }} &nbsp;</p>
            <div class="mt-3">
                <a href="/panel/levels" type="button" class="inline-flex items-center rounded-md bg-indigo-600 dark:bg-[#20B9A6] px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">
                    {{ $user->level ? $t[Translation::HOME_CTA_BUTTON_TEXT] : $t[Translation::HOME_CTA_BUTTON_TEXT_WHEN_NO_LEVEL] }} &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="mt-24">
            @include('tailwindui.home.new-members-list')
        </div>
    </div>
</div>
