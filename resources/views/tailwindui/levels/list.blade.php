@php use App\Models\Translation; @endphp

<ul role="list" class="grid grid-cols-1 gap-x-2 gap-y-8 lg:grid-cols-2 xl:gap-x-6">
    @foreach($levels as $index => $level)
        <li class="overflow-hidden rounded-3xl border p-4 border-gray-200 shadow-sm dark:border-none bg-gray-100 dark:bg-[#1F242C]">
            <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-100 dark:bg-[#1F242C] p-4">
                <div
                    class="text-sm font-medium leading-6 text-gray-900 dark:text-[#E6E4E4]">{{ $level->name }}</div>
                <div class="relative ml-auto">
                    @php
                        $disabled = !$level->is_eligible_to_upgrade;
                    @endphp

                    @if($user->level_id === $level->id)

                        <span
                            class="inline-flex items-center gap-x-1.5 rounded-full px-2 py-1 text-sm font-medium text-gray-900 ring-1 ring-inset ring-gray-200 dark:ring-[#373843] dark:text-[#E6E4E4]">
                                  <svg class="h-1.5 w-1.5 fill-indigo-500 dark:fill-[#20B9A6]" viewBox="0 0 6 6" aria-hidden="true">
                                    <circle cx="3" cy="3" r="3"/>
                                  </svg>
                                  {{ $t[Translation::LEVELS_PAGE_UPGRADE_BUTTON_TEXT_WHEN_CURRENT_LEVEL] }}
                                </span>
                    @else
                        <a
                            type="button"
                            class="inline-flex items-center gap-x-1.5 rounded-md @if($disabled) bg-indigo-200 dark:bg-[#EEEFF0] dark:text-gray-500 @else bg-indigo-600 dark:bg-[#20B9A6] dark:text-[#FFFFFF] @endif px-3 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2"
                            href="{{ $disabled ? '#' : route('user.level.upgrade', ['level' => $level->id]) }}"
                        >
                            {{ $t[Translation::LEVELS_PAGE_UPGRADE_BUTTON_TEXT] }}

                            @if($disabled)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>

                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor"
                                     class="size-6 @if(!$disabled) animate-spinPause @endif">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/>
                                </svg>
                            @endif

                        </a>
                    @endif

                </div>
            </div>
            <dl class="-my-3 divide-y divide-gray-100 dark:divide-[#373843] dark:bg-[#1F242C] px-6 py-4 text-sm leading-6">
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500 dark:text-[#8899A6]">{{ $t[Translation::LEVELS_PAGE_YOU_INVEST] }}</dt>
                    <dd class="flex items-start gap-x-2">
                        <div class="font-medium text-gray-900 dark:text-[#E6E4E4]">{{ $level->upgrade_cost }}
                            USDT
                        </div>
                        <div
                            class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-red-700 bg-red-50 ring-red-600/10 dark:bg-[#20B9A6] dark:text-[#FFFFFF]">
                            one time
                        </div>
                    </dd>
                </div>
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500 dark:text-[#8899A6]">{{ $t[Translation::LEVELS_PAGE_YOU_GET] }}</dt>
                    <dd class="flex items-start gap-x-2">
                        <div
                            class="font-medium text-gray-900 dark:text-[#E6E4E4]">{{ $level->daily_return_amount }}
                            USDT
                        </div>
                        <span
                            class="inline-flex items-center rounded-md bg-green-50 dark:bg-[#20B9A6] dark:text-[#FFFFFF] px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">every 24 hours</span>
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
