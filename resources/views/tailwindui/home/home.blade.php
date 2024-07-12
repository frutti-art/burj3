@extends('tailwindui.main')

@section('content')
    @if($isMobile)
        @include('tailwindui.home.home-mobile')
    @else
        @include('tailwindui.home.home-desktop')
    @endif

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script>
        var animation = lottie.loadAnimation({
            container: document.getElementById('lottie-animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '/rocket_launch.json'
        });

        animation.addEventListener('DOMLoaded', () => {
            document.getElementById('home-content').classList.remove('hidden');
            animation.play();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const feedContainer = document.getElementById('feed-container');
            const scrollContainer = document.getElementById('scroll-container');
            let feedItems = document.querySelectorAll('.feed-item');


            function scrollItems(key) {
                if (key >= feedItems.length) {
                    return;
                }

                let firstItem = feedItems[key];
                const itemHeight = firstItem.offsetHeight * (key + 1);

                scrollContainer.style.transition = 'transform 1s linear';
                scrollContainer.style.transform = `translateY(-${itemHeight}px)`;

                key++;
                setTimeout(() => {
                    scrollItems(key);
                }, getRandomInterval());
            }

            function getRandomInterval() {
                return Math.floor(Math.random() * (9000 - 2000 + 1)) + 2000;
            }

            setTimeout(() => {
                scrollItems(0);
            }, 1500);

        });
    </script>

@endpush
