@php use App\Models\Translation; @endphp
@extends('tailwindui.main')

@section('content')

    <div id="home-content" class="hidden">
        <div class="text-center">
            <div id="lottie-animation" class="md:w-1/2 w-3/4 h-3/4 mx-auto"></div>
            <p class="mt-1 text-sm text-gray-500 dark:text-[#FFFFFF]">{{ $user->level ? $t[Translation::HOME_CTA_TEXT] : $t[Translation::HOME_CTA_TEXT_WHEN_NO_LEVEL] }} &nbsp;</p>
            <div class="mt-3">
                <a href="/panel/levels" type="button" class="inline-flex items-center rounded-md bg-indigo-600 dark:bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    {{ $user->level ? $t[Translation::HOME_CTA_BUTTON_TEXT] : $t[Translation::HOME_CTA_BUTTON_TEXT_WHEN_NO_LEVEL] }} &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="gap-x-4 mt-24 border rounded-2xl shadow-lg border-gray-900/5 bg-gray-100 dark:bg-[#192734] mx-4">
            <div class="text-center pt-4">
                <h2 class="text-base font-semibold leading-7 text-indigo-600 dark:text-[#FFFFFF]">{{ $t[Translation::HOME_NEW_MEMBERS_TITLE] }}</h2>
            </div>

            <div id="feed-container" class="p-4 h-96 overflow-hidden">
                <div class="flow-root">
                    <ul id="scroll-container" role="list" class="mb-8 text-center flex flex-col items-center justify-center">
                        @foreach($newMembers as $newMember)
                            <li class="relative pb-8 feed-item">
                                <div class="relative flex space-x-3">
                                    <div>
                            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-6 ring-white">
                                <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                </svg>
                            </span>
                                    </div>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-[#8899A6]">{!! $newMember !!}</b></p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

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
