@extends('layouts.main')

@section('content')

    <div class=" sm:py-12 pb-12 mx-auto max-w-7xl px-6 lg:px-8 isolate mx-auto">
        <div class="stats w-full stats-vertical sm:stats-horizontal shadow">
            <div class="">
                <div class="text-center items-center justify-center stat-figure flex flex-col sm:flex-col sm:space-x-8 space-y-2">
                    <div class="px-6 py-6 text-center">
                        <h1 class="font-semibold text-4xl">Invite your friends</h1>
                    </div>

                    <div class="pt-4">
                        {!! QrCode::size(200)->generate($user->referral_code) !!}
                    </div>

                    <div class="flex justify-center items-center">
                        Your referral code: &nbsp; <div class="stat-value text-lg">{{ $user->referral_code }}</div>
                    </div>

                    <div>
                        <button class="btn btn-primary btn-wide">Invite your friends
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                            </svg>
                        </button>
                    </div>

                    <div class="text-slate-400 italic">
                        For every friend you invite, you will receive {{ $referralBonusPercentage }}% of their first level upgrade amount in USDT.
                    </div>
                </div>
            </div>
        </div>

        @include('pages.referrals')
    </div>
@endsection

