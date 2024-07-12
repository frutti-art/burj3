@php use App\Models\Translation; @endphp

<div>
    <div class="text-center pb-4 pt-2">
            <span
                class="text-3xl font-medium leading-6 text-indigo-600 dark:text-[#FFFFFF]">{{ $t[Translation::TEAM_PAGE_TITLE] }}</span>
        <p class="mt-2 max-w-4xl text-sm text-gray-500 dark:text-[#8899A6]">{{ $t[Translation::TEAM_PAGE_DESCRIPTION] }}</p>
    </div>

    @include('tailwindui.team.qr-card')

    <div class="py-12">
        @include('tailwindui.team.referrals-list')
    </div>
</div>
