@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-6 pb-6 text-center">
        @include('pages.withdraw-card')

        <article class="prose-sm prose mb-4">
            <h1 class="font-semibold">Join one of our VIP levels</h1>
        </article>

        @foreach($levels as $level)
            <div class="card w-full bg-base-200 border-2 text-slate-800 mb-4">
                <div class="card-body flex flex-col sm:flex-row justify-between items-center">
                        <div>
                            <h2 class="card-title text-4xl">{{ $level->name }}</h2>
                        </div>
                        <div>
                            <div>Daily profit: {{ $level->daily_return_amount }} USDT</div>
                            <div>Max days: {{ $level->claim_limit }}</div>
                            <div class="font-bold text-lg">Total profit: {{ $level->claim_limit * $level->daily_return_amount }} USDT</div>
                        </div>
                        <div>
                            @php
                                $disabled = ($user->level?->rank >= $level->rank)
                            @endphp
                            <div class="card-actions justify-end">
                                @if($disabled)
                                    <a role="button" class="btn btn-primary btn-wide text-white" disabled="disabled" href="{{ route('user.level.upgrade', ['level' => $level->id]) }}">Upgrade</a>
                                @else
                                    <a role="button" class="btn btn-primary btn-wide" href="{{ route('user.level.upgrade', ['level' => $level->id]) }}">Upgrade for {{ $level->upgrade_cost }} USDT</a>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection

