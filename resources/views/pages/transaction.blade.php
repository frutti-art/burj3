@extends('layouts.main')

@section('content')
    <div class="flex flex-col justify-center items-center pt-6">

        <div class="px-6 py-6 text-center">
            <h1 class="font-semibold text-4xl">Deposit to your wallet</h1>
        </div>

        <div>
            {!! QrCode::size(200)->generate($transaction->ulid) !!}
        </div>

        <div class="lg:col-start-3 lg:row-end-1 mx-8 pt-8">
            <h2 class="sr-only">Summary</h2>
            <div class="rounded-lg shadow-sm ring-1 ring-gray-900/5">
                <dl class="flex flex-wrap">
                    <div class="flex-auto pl-6 pt-6 pb-6">
                        <dt class="text-sm font-light leading-6 900">Wallet address</dt>
                        <dd class="mt-1 text-base font-semibold leading-6">{{ $transaction->wallet_address }}</dd>
                    </div>
                </dl>
            </div>
            <div class="text-slate-400 italic pt-4">
                Deposit transaction is usually processed within 1 minute.
            </div>
        </div>
    </div>
@endsection

