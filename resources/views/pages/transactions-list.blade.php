@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-2 pb-6 text-center">
        <div class="mt-12 mb-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-bold leading-6 text-white">Transactions list</h1>
                </div>
            </div>
        </div>
        <div class="mt-8 flow-root overflow-hidden">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <table class="w-full text-left">
                    <thead>
                    <tr>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Type</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Amount</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td class="relative py-4 pr-3 text-sm font-medium text-white">
                                {{ ucwords(str_replace('_', ' ', $transaction->reference)) }}
                            </td>
                            <td class="px-3 py-4 text-sm text-gray-500">
                                @if($transaction->type === 'deposit')
                                    +{{ $transaction->amount }} USDT
                                @else
                                    -{{ $transaction->amount }} USDT
                                @endif

                            </td>
                            <td class="text-sm text-gray-500">{{ $transaction->updated_at->format('d M, Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

@endsection
