@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-6 pb-6 text-center">
        @include('pages.withdraw-card', [
            'includeWithdrawButton' => false,
            'includeDepositButton' => false,
        ])

        <article class="prose-sm prose mb-6">
            <h1 class="font-semibold">Withdraw your crypto to your wallet</h1>
        </article>

        <form class="space-y-4" action="{{ route('user.withdrawAction') }}" method="post">
            @csrf

            <input name="amount" type="number" placeholder="Amount (in USDT)" class="input input-bordered w-full max-w-xs" />
                @error('amount')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            <input name="wallet_address" type="text" placeholder="Wallet address" class="input input-bordered w-full max-w-xs" />
                @error('wallet_address')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            <input name="password" type="password" placeholder="Password" class="input input-bordered w-full max-w-xs" />
                @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror

            <button class="btn btn-primary btn-wide">Send request to withdraw</button>
        </form>

        <div class="text-slate-400 italic pt-4">
            Request to withdraw is usually processed within 5 minutes.
        </div>
    </div>

@endsection

@push('js')
    <script>
        function showModal() {
            const modal = document.getElementById('withdraw-modal');
            modal.classList.remove('hidden');
        }
    </script>
@endpush
