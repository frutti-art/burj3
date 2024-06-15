@php use App\Models\Translation; @endphp
@extends('tailwindui.main')

@section('content')
    <div class="px-4">
        <div class="text-center pb-4 pt-2">
            <span
                class="text-3xl font-medium leading-6 text-indigo-600 dark:text-[#FFFFFF]">{{ $t[Translation::WITHDRAW_PAGE_TITLE] }}</span>
            <p class="mt-2 max-w-4xl text-sm text-gray-500 dark:text-[#8899A6]">{{ $t[Translation::WITHDRAW_PAGE_DESCRIPTION] }}</p>
        </div>

        <form action="{{ route('user.withdrawAction') }}" method="post">
            @csrf

            <div class="space-y-4">
                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        @error('password')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <div class="mt-2">
                            <div>
                                <label for="amount"
                                       class="block text-sm font-medium leading-6 text-gray-900">Amount</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input value="{{ old('amount') }}" required type="number" name="amount" id="amount"
                                           class="block w-full rounded-md border-0 py-1.5 pr-12 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                           placeholder="0.00" aria-describedby="amount-currency">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <span class="text-gray-500 sm:text-sm" id="amount-currency">USDT</span>
                                    </div>
                                </div>
                                @error('amount')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="wallet-address" class="block text-sm font-medium leading-6 text-gray-900">Wallet
                            address</label>
                        <div class="mt-2">
                            <input required type="text" name="wallet_address"
                                   value="{{ old('wallet_address') ? old('wallet_address') : $user->withdraw_wallet_address }}"
                                   id="wallet-address" autocomplete="family-name"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        @error('wallet_address')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" id="open-withdraw-modal"
                        class="w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    {{ $t[Translation::WITHDRAW_PAGE_SUBMIT_BUTTON_TEXT] }}
                </button>
            </div>


            <div class="text-slate-400 italic pt-4">
                {{ $t[Translation::WITHDRAW_PAGE_HELP_TEXT] }}
            </div>

            @include('tailwindui.withdraw-modal')
        </form>
    </div>

@endsection

@push('js')
    <script>
        function showModal() {
            // if amount is empty then return
            const amount = document.getElementById('amount').value;
            const walletAddress = document.getElementById('wallet-address').value;

            if (!amount || !walletAddress) return;

            const modal = document.getElementById('withdraw-modal');
            modal.classList.remove('hidden');
        }

        document.getElementById('open-withdraw-modal').addEventListener('click', showModal);

    </script>
@endpush
