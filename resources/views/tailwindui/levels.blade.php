@php use App\Models\Translation; @endphp
@extends('tailwindui.main')

@section('content')

    <div>
        <div class="text-center pb-4 pt-2">
            <span
                class="text-3xl font-medium leading-6 text-indigo-600 dark:text-[#FFFFFF]">{{ $t[Translation::LEVELS_PAGE_TITLE] }}</span>
            <p class="mt-2 max-w-4xl text-sm text-gray-500 dark:text-[#8899A6]">{{ $t[Translation::LEVELS_PAGE_DESCRIPTION] }}</p>
        </div>

        <ul role="list" class="grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-1 xl:gap-x-8">
            @foreach($levels as $index => $level)
                <li class="overflow-hidden rounded-xl border border-gray-200 dark:border-none bg-gray-100">
                    <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-100 dark:bg-[#192734] p-4">
                        {{--                <img src="https://tailwindui.com/img/logos/48x48/tuple.svg" alt="Tuple" class="h-12 w-12 flex-none rounded-lg bg-white object-cover ring-1 ring-gray-900/10">--}}
                        <div
                            class="text-sm font-medium leading-6 text-gray-900 dark:text-[#FFFFFF]">{{ $level->name }}</div>
                        <div class="relative ml-auto">
                            @php
                                $disabled = !$level->is_eligible_to_upgrade;
                            @endphp

                            @if($user->level_id === $level->id)

                                <span
                                    class="inline-flex items-center gap-x-1.5 rounded-full px-2 py-1 text-sm font-medium text-gray-900 ring-1 ring-inset ring-gray-200 dark:text-[#FFFFFF]">
                                  <svg class="h-1.5 w-1.5 fill-indigo-500" viewBox="0 0 6 6" aria-hidden="true">
                                    <circle cx="3" cy="3" r="3"/>
                                  </svg>
                                  {{ $t[Translation::LEVELS_PAGE_UPGRADE_BUTTON_TEXT_WHEN_CURRENT_LEVEL] }}
                                </span>
                            @else
                                <a
                                    type="button"
                                    class="inline-flex items-center gap-x-1.5 rounded-md @if($disabled) bg-indigo-200 hover:bg-indigo-200 dark:bg-[#83cbf7] @else bg-indigo-600 hover:bg-indigo-500 dark:bg-blue-600 @endif px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2"
                                    href="{{ $disabled ? '#' : route('user.level.upgrade', ['level' => $level->id]) }}"
                                >
                                    {{ $t[Translation::LEVELS_PAGE_UPGRADE_BUTTON_TEXT] }}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         class="size-6 @if(!$disabled) animate-spinPause @endif">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/>
                                    </svg>
                                </a>
                            @endif

                        </div>
                    </div>
                    <dl class="-my-3 divide-y divide-gray-100 dark:bg-[#192734] px-6 py-4 text-sm leading-6">
                        <div class="flex justify-between gap-x-4 py-3">
                            <dt class="text-gray-500 dark:text-[#8899A6]">{{ $t[Translation::LEVELS_PAGE_YOU_INVEST] }}</dt>
                            <dd class="flex items-start gap-x-2">
                                <div class="font-medium text-gray-900 dark:text-[#FFFFFF]">{{ $level->upgrade_cost }}
                                    USDT
                                </div>
                                <div
                                    class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-red-700 bg-red-50 ring-red-600/10 dark:text-yellow-500 dark:bg-yellow-400/10">
                                    one time
                                </div>
                            </dd>
                        </div>
                        <div class="flex justify-between gap-x-4 py-3">
                            <dt class="text-gray-500 dark:text-[#8899A6]">{{ $t[Translation::LEVELS_PAGE_YOU_GET] }}</dt>
                            <dd class="flex items-start gap-x-2">
                                <div
                                    class="font-medium text-gray-900 dark:text-[#FFFFFF]">{{ $level->daily_return_amount }}
                                    USDT
                                </div>
                                <span
                                    class="inline-flex items-center rounded-md bg-green-50 dark:text-yellow-500 dark:bg-yellow-400/10 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">every 24 hours</span>
                            </dd>
                        </div>
                        @if(!$loop->first && $level->required_referrals_count > 0 && $user->level_id !== $level->id)
                            <div class="flex justify-between gap-x-4 py-1">
                                <dt class="text-red-500">{!! sprintf($t[Translation::LEVELS_PAGE_INVITE_FRIENDS_TEXT], $level->required_referrals_count, $levels[$index - 1]->name) !!}
                                </dt>
                            </div>
                        @endif
                    </dl>
                </li>
            @endforeach
        </ul>

    </div>

@endsection
