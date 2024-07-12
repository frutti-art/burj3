@php use App\Models\Translation; @endphp

<div class="block sm:hidden">
    <div>
        <div class="text-center pb-4 pt-2">
            <span
                class="text-3xl font-medium leading-6 text-indigo-600 dark:text-[#FFFFFF]">{{ $t[Translation::LEVELS_PAGE_TITLE] }}</span>
            <p class="mt-2 max-w-4xl text-sm text-gray-500 dark:text-[#8899A6]">{{ $t[Translation::LEVELS_PAGE_DESCRIPTION] }}</p>
        </div>

        @include('tailwindui.levels.list')
    </div>
</div>
