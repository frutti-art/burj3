<div class="stats w-full stats-vertical sm:stats-horizontal shadow mb-8 mt-2">
    <div class="">
        <div class="m-6 justify-center items-center stat-figure flex flex-col text-center sm:space-x-8 space-y-3">
            <div class="flex text-left justify-start items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>

                <div class="ml-2 stat-title">Balance: &nbsp;</div>
                <div class="stat-value text-xl">{{ $user->balance }} USDT</div>
            </div>
            <div class="flex text-left justify-start items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                </svg>


                <div class="ml-2 stat-title">Level: &nbsp;</div>
                <div class="stat-value text-xl">{{ $user->level?->name ?? 'None' }}</div>
            </div>

            @if($includeWithdrawButton ?? true)
                <div class="w-full">
                    <a href="{{ route('user.withdraw') }}" class="btn btn-primary w-full">
                        Withdraw to your wallet
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                        </svg>

                    </a>
                </div>
            @endif

            @if($includeDepositButton ?? true)
                <div class="w-full">
                    <a href="{{ route('user.deposit') }}" class="btn btn-primary w-full">
                        Deposit USDT
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                        </svg>



                    </a>
                </div>
            @endif



        </div>
    </div>
</div>
