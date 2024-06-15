<div class="stats w-full stats-vertical sm:stats-horizontal shadow mb-8 mt-8">
    <div class="">
        <div class=" justify-center stat-figure flex flex-col items-center sm:space-x-8 space-y-3">

            @foreach($levelReferralsInfo as $name => $referralsCount)
                <div class="flex text-left justify-start items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                    </svg>

                    <div class="ml-2 stat-value text-xl">{{ $name }} : &nbsp;</div>
                    <div class="stat-title text-xl"> {{ $referralsCount }} referrals</div>
                </div>
            @endforeach

        </div>
    </div>
</div>
