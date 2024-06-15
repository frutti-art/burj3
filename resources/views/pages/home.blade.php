@extends('layouts.main')

@section('content')

    <div class="px-6 py-6 text-center">
        <h1 class="font-semibold text-4xl">Join one of our VIP levels</h1>
    </div>

    <div class="py-2 sm:py-12 pb-12">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div
                class="isolate mx-auto mt-4 grid max-w-md grid-cols-1 gap-y-8 sm:mt-4 lg:mx-0 lg:max-w-none lg:grid-cols-1">
                @foreach($levels as $index => $level)
                    <div class="flex flex-col justify-between rounded-3xl p-6 ring-1 ring-gray-200 xl:p-6 lg:z-10">
                        <div>
                            <div class="flex items-center justify-between gap-x-4">
                                <h3 id="tier-startup" class="text-lg font-semibold leading-8">{{ $level->name }}</h3>
                                @if($loop->iteration === 2)
                                    <p class="rounded-full px-2.5 py-1 text-xs font-semibold leading-5">Most popular</p>
                                @endif
                            </div>
                            {{--                            <p class="mt-4 text-sm leading-6 ">A plan that scales with your rapidly growing business.</p>--}}
                            <p class="mt-1 flex items-baseline gap-x-1">
                                <span
                                    class="text-3xl font-bold tracking-tight">{{ $level->daily_return_amount }} USDT</span>
                                <span class="text-sm font-semibold leading-6 ">bonus every day!</span>
                            </p>
                            <ul role="list" class="mt-2 mb-2 space-y-3 text-sm leading-6 ">
                                <li class="flex gap-x-1">
                                    <svg class="h-6 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                         aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    {{ $level->claim_limit }}x bonus claim limit
                                </li>
                            </ul>
                        </div>
                        @php
                            $disabled = ($user->level?->rank >= $level->rank)
                        @endphp

                        <a @if($disabled) disabled="disabled"
                           @endif href="{{ route('user.level.upgrade', ['level' => $level->id]) }}"
                           class="btn btn-primary btn-wide mt-2 w-full">Upgrade for {{ $level->upgrade_cost }} USDT
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/>
                            </svg>
                        </a>

                        @if(!$loop->first)
                            <p class="mt-2 text-sm leading-6 text-red-600">You need to
                                invite {{ $level->required_referrals_count }} friends to {{ $levels[$index - 1]->name }}
                                to be able to upgrade</p>
                        @endif
                    </div>

                @endforeach
            </div>
        </div>
    </div>

@endsection

