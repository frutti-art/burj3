@php use App\Models\Translation; @endphp


    <div class="px-2 pb-6 pt-4">
        <div class="flex flex-row items-center justify-center space-x-4">
            <a type="button"
               href="{{ route('user.deposit') }}"
               class="flex items-center justify-center space-x-1 w-full rounded-md bg-indigo-600 dark:bg-[#20B9A6] px-3.5 py-2 text-sm font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">
                <span>{{ $t[Translation::GENERAL_PAGE_DEPOSIT_BUTTON_TEXT] }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"/>
                </svg>

            </a>

            <a type="button"
               href="{{ route('user.withdraw') }}"
               class="flex items-center justify-center space-x-1 w-full rounded-md bg-white px-3.5 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                <span>{{ $t[Translation::GENERAL_PAGE_WITHDRAW_BUTTON_TEXT] }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5"/>
                </svg>
            </a>

        </div>
    </div>

    @include('tailwindui.general.claim-card')


{{--    <div id="lottie-animation" class="md:w-1/2 mx-auto"></div>--}}

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/countup.js@1.9.3/dist/countUp.min.js"></script>

    <script>
        var animation = lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '/mining.json' // the path to the animation JSON file
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const endTime = getNext8AM();
            updateCountdown();

            function updateCountdown() {
                const hoursElement = document.getElementById('countdown-hours');
                const minutesElement = document.getElementById('countdown-minutes');
                const secondsElement = document.getElementById('countdown-seconds');
                const now = new Date();
                const duration = endTime - now;

                if (duration < 0) {
                    document.getElementById('countdown').innerHTML = "Countdown has ended!";
                    return;
                }

                let hours = Math.floor((duration / (1000 * 60 * 60)) % 24);
                let minutes = Math.floor((duration / 1000 / 60) % 60);
                let seconds = Math.floor((duration / 1000) % 60);

                // Update CSS variables for each countdown part
                hoursElement.style.setProperty('--value', hours);
                minutesElement.style.setProperty('--value', minutes);
                secondsElement.style.setProperty('--value', seconds);

                setTimeout(updateCountdown, 1000);
            }

            function getNext8AM() {
                const now = new Date();
                let next8AM = new Date();  // Create a new Date object
                next8AM.setHours(8, 0, 0, 0);  // Set time to 8 AM today

                // Check if current time is past today's 8 AM
                if (now >= next8AM) {
                    // If it's past 8 AM, set next8AM to 8 AM the next day
                    next8AM.setDate(next8AM.getDate() + 1);
                }

                return next8AM;
            }


            var max_count = {!! $user?->level?->daily_return_amount ?? 1 !!};
            var gained_bonus = {!! $gainedBonus !!};
            var durationToNextClaim = {!! $durationToNextClaim !!};

            var countUpOptions = {
                separator: " ",
                duration: 100
            };

            var count = new CountUp("count", gained_bonus, max_count, 13, durationToNextClaim, countUpOptions);


            count.start(countUpOnComplete);

            function countUpOnComplete() {
                var countUpModal = UIkit.modal("#modal-countup");
                countUpModal.show();
                setTimeout(function () {
                    countUpModal.hide();
                    setTimeout(function () {
                        countUpModal.$destroy(true);
                    }, 3000);
                }, 5000);
            }


        });

    </script>

@endpush
