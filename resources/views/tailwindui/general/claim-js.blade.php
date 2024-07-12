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
