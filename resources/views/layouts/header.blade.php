@if(session('error'))
    <div role="alert" class="alert my-4 flex">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>{{ session('error') }}</span>
    </div>
@endif

@if(session('success'))
    <div role="alert" class="alert my-4 flex">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

{{--<div class="navbar bg-base-100">--}}

{{--    <div class="navbar-start">--}}
{{--        <a class="btn btn-ghost text-xl">InvestCo</a>--}}
{{--    </div>--}}
{{--    <div class="navbar-center lg:flex">--}}
{{--        <div class="grid grid-flow-col gap-3 text-center auto-cols-max">--}}
{{--            <div class="flex flex-col">--}}
{{--                <span class="countdown font-mono sm:text-xl md:text-5xl">--}}
{{--                  <span id="countdown-hours"></span>--}}
{{--                </span>--}}
{{--                hours--}}
{{--            </div>--}}
{{--            <div class="flex flex-col">--}}
{{--                <span class="countdown font-mono sm:text-xl md:text-5xl">--}}
{{--                  <span id="countdown-minutes"></span>--}}
{{--                </span>--}}
{{--                min--}}
{{--            </div>--}}
{{--            <div class="flex flex-col">--}}
{{--                <span class="countdown font-mono sm:text-xl md:text-5xl">--}}
{{--                  <span id="countdown-seconds"></span>--}}
{{--                </span>--}}
{{--                sec--}}
{{--            </div>--}}
{{--        </div>--}}


{{--    </div>--}}
{{--    <div class="navbar-end">--}}

{{--    </div>--}}
{{--</div>--}}

<div class="container mx-auto px-6 text-center mb-2">
    <form action="{{ route('user.claim-bonus') }}" method="post">
            @csrf
            <button @if(!@$userIsEligibleToClaimBonus) disabled="disabled" @endif class="btn w-full md:w-1/3 btn-primary btn-sm sm:btn-sm md:btn-md lg:btn-lg">
                @if($user->level_id)
                    @if($userIsEligibleToClaimBonus)
                        Claim <span class="mx-0.5"> {{ $user->level->daily_return_amount }}</span> USDT
                    @else
                        Claim <span id="count" class="mx-2"></span> USDT
                    @endif
                @else
                    Upgrade to claim bonus
                @endif
            </button>
        </form>
            <div class="text-slate-400 italic mx-auto flex">
                Your next bonus amount: &nbsp;
            </div>
</div>


{{--<div class="divider my-0"></div>--}}
