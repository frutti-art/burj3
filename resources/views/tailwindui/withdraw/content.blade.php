@php use App\Models\Translation; @endphp

<div class="px-4  flex items-center justify-center">
    <div class="max-w-full w-full lg:w-1/2">
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
                                       class="block text-sm font-medium leading-6 text-gray-900 dark:text-[#8899A6]">Amount</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <input value="{{ old('amount') }}" required type="number" name="amount" id="amount"
                                           class="block w-full rounded-md border-0 py-1.5 pr-12 text-gray-900 placeholder:text-gray-400  sm:text-sm sm:leading-6 "
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
                        <label for="wallet-address"
                               class="block text-sm font-medium leading-6 text-gray-900 dark:text-[#8899A6]">Wallet
                            address</label>
                        <div class="mt-2">
                            <input required type="text" name="wallet_address"
                                   value="{{ old('wallet_address') ? old('wallet_address') : $user->withdraw_wallet_address }}"
                                   id="wallet-address" autocomplete="family-name"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 sm:text-sm sm:leading-6">
                        </div>
                        @error('wallet_address')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" id="open-withdraw-modal"
                        class="w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm dark:bg-[#20B9A6] dark:text-[#FFFFFF] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">
                    {{ $t[Translation::WITHDRAW_PAGE_SUBMIT_BUTTON_TEXT] }}
                </button>
            </div>


            <div class="text-slate-400 italic pt-4">
                {{ $t[Translation::WITHDRAW_PAGE_HELP_TEXT] }}
            </div>

            @include('tailwindui.withdraw.withdraw-modal')
        </form>
    </div>
</div>

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
