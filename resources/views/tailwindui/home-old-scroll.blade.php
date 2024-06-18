@php use App\Models\Translation; @endphp
@extends('tailwindui.main')

@push('css')
    <style>
        @keyframes slideUp {
            0% {
                transform: translateY(0);
                opacity: 1;
            }
            100% {
                transform: translateY(-100%);
                opacity: 0;
            }
        }

        @keyframes slideDown {
            0% {
                transform: translateY(100%);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .feed-item {
            opacity: 1;
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
        }

        .feed-item.exit {
            animation: slideUp 0.5s forwards;
        }

        .feed-item.enter {
            animation: slideDown 0.5s forwards;
        }

        .hidden {
            display: none;
        }
    </style>
@endpush

@section('content')

    <div class="text-center">
        <div id="lottie-animation" class="md:w-1/2 w-3/4 h-3/4 mx-auto"></div>
        <p class="mt-1 text-sm text-gray-500 dark:text-[#FFFFFF]">{{ $user->level ? $t[Translation::HOME_CTA_TEXT] : $t[Translation::HOME_CTA_TEXT_WHEN_NO_LEVEL] }}
            &nbsp;</p>
        <div class="mt-3">
            <a href="/panel/levels" type="button"
               class="inline-flex items-center rounded-md bg-indigo-600 dark:bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">

                {{ $user->level ? $t[Translation::HOME_CTA_BUTTON_TEXT] : $t[Translation::HOME_CTA_BUTTON_TEXT_WHEN_NO_LEVEL] }} &nbsp;
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/>
                </svg>


            </a>
        </div>
    </div>


    <div class="gap-x-4 mt-24 border rounded-2xl shadow-lg border-gray-900/5 bg-gray-100 dark:bg-[#192734] mx-4">
        <div class="text-center pt-4">
            <h2 class="text-base font-semibold leading-7 text-indigo-600 dark:text-[#FFFFFF]">{{ $t[Translation::HOME_NEW_MEMBERS_TITLE] }}</h2>
        </div>

        <div id="feed-container" class="p-4 h-96">
            <div class="flow-root">
                <ul id="feed-list" role="list" class="mb-8 text-center flex flex-col items-center justify-center">
                </ul>
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
            path: '/rocket_launch.json' // the path to the animation JSON file
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const feedList = document.getElementById('feed-list');
            const feedItems = [
                "xz**********@gmail.com just invested <b>250 USDT</b>",
                "yz**********@gmail.com just invested <b>250 USDT</b>",
                "az**********@gmail.com just invested <b>250 USDT</b>",
                "bz**********@gmail.com just invested <b>250 USDT</b>",
                "cz**********@gmail.com just invested <b>250 USDT</b>",
                "dz**********@gmail.com just invested <b>250 USDT</b>"
            ];

            let currentIndex = 0;

            function createFeedItem(content) {
                const newItem = document.createElement('li');
                newItem.classList.add('relative', 'pb-8', 'feed-item', 'text-center', 'flex');
                newItem.innerHTML = `
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
                        <p class="text-sm text-gray-500 dark:text-[#8899A6]">${content}</p>
                    </div>
                </div>
            </div>
        `;
                return newItem;
            }

            function updateFeed() {
                const newItem = createFeedItem(feedItems[currentIndex]);
                newItem.classList.add('enter');
                feedList.appendChild(newItem);
                currentIndex = (currentIndex + 1) % feedItems.length;

                if (feedList.children.length > 3) {
                    const firstItem = feedList.children[0];
                    firstItem.classList.remove('enter');
                    firstItem.classList.add('exit');
                    firstItem.addEventListener('animationend', () => {
                        if (feedList.contains(firstItem)) {
                            feedList.removeChild(firstItem);
                        }
                    }, {once: true});

                    firstItem.getBoundingClientRect();
                }

                setTimeout(updateFeed, Math.floor(Math.random() * 8001) + 2000)
            }

            for (let i = 0; i < 3; i++) {
                const initialItem = createFeedItem(feedItems[currentIndex]);
                feedList.appendChild(initialItem);
                currentIndex = (currentIndex + 1) % feedItems.length;
            }

            updateFeed();
        });
    </script>
@endpush
