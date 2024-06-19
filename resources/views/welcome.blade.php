@php use App\Models\Translation; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $appName }}</title>
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description"
          content="Onyx is the backbone of Web3 and blockchain infrastructure powered by Onyxcoin" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <!-- Facebook Meta Tags-->
    <meta property="og:title" content="{{ $appName }}">
    <meta property="og:description"
          content="{{ $appName }}">
    <meta property="og:image" content="images/RxAP9bVzJ6dc.jpg">
    <meta property="og:url" content=href="#">
    <meta property="og:site_name" content="{{ $appName }}">
    <meta property="og:type" content="website">
    <!-- Twitter Meta Tags-->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $appName }}">
    <meta name="twitter:description"
          content="{{ $appName }}">
    <meta name="twitter:image" content="images/RxAP9bVzJ6dc.jpg">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>Onyx</title>
    <link href="#" rel="stylesheet">
    <link rel="stylesheet" href="landing/css/sFHqOmhIyQye.css">

    <style>
        .full-screen-iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .iframe-container {
            position: relative;
            width: 100%;
            height: 100vh;
        }

        .tooltip .tooltip-text {
            visibility: hidden;
            width: 200px; /* Adjust the width as needed */
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            padding: 5px 10px;
            position: absolute;
            z-index: 1;
            bottom: 100%; /* Position the tooltip above the text */
            left: 50%;
            margin-left: -100px; /* Use half of the tooltip's width to center it */
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

    </style>
</head>
<body style="
            /*width:100%;*/
            /*height:100vh;*/
            /*overflow:hidden;*/
            /*margin:0;*/
            /*padding:0;*/
            /*border:none;*/
">
<div class="layout">
    <header class="header">
        <div class="maw2000 flex items-center gap-10 justify-between">
            <div class="flex-none">
                <div class="logo">
                    <picture>
                        <source srcset="landing/images/D9JzfwmqJM3j.webp" type="image/webp">
                        <img src="landing/images/yJc7QCoKPMm0.png" srcset="landing/images/yJc7QCoKPMm0.png" alt="img"
                             width="110"
                             height="31" title="The Backbone of Decentralised Web3 Protocols">
                    </picture>
                </div>
            </div>
            <div class="flex-1 lg:hidden">
                <nav class="top-menu">
                    <ul class="top-menu__list">
                        <li><a href="#xcn">{{ $t[Translation::LANDING_PAGE_MENU_1] }}</a></li>
                        <li><a href="#governance">{{ $t[Translation::LANDING_PAGE_MENU_2] }}</a></li>
                        <li><a href="#markets">{{ $t[Translation::LANDING_PAGE_MENU_3] }}</a></li>
                    </ul>
                </nav>
            </div>
            <div class="flex-none launch-btn-wrapper lg:hidden"><a class="launch-btn"
                                                                   href="{{ route('register') }}"><span
                        class="text flex-1">{{ $t[Translation::LANDING_PAGE_REGISTER_BUTTON_TEXT] }}</span><span class="icon flex-none"><span
                            class="svg-image-arrow-right block"></span></span></a></div>
            <div class="flex-none hidden lg:block">
                <button class="hamburger hamburger--squeeze show-menu-btn" type="button" aria-label="Menu button"><span
                        class="hamburger-box"><span class="hamburger-inner"></span></span></button>
            </div>
        </div>
    </header>
    <div class="mobile-menu">
        <div class="mobile-menu__inner">
            <div class="mobile-menu__header">
                <div class="flex items-center justify-between">
                    <div class="flex-none">
                        <picture>
                            <source srcset="landing/images/D9JzfwmqJM3j.webp" type="image/webp">
                            <img src="landing/images/yJc7QCoKPMm0.png" srcset="landing/images/yJc7QCoKPMm0.png"
                                 alt="img" width="110"
                                 height="31" title="The Backbone of Decentralised Web3 Protocols">
                        </picture>
                    </div>
                    <div class="flex-none">
                        <button class="close-menu-btn" type="button" aria-label="Close menu"><span
                                class="block svg-image-close"></span></button>
                    </div>
                </div>
            </div>
            <div class="mobile-menu__body">
                <ul class="space-y-7 mobile-menu-list">
                    <li><a class="flex items-center gap-6" href="#xcn">
                            <div class="flex-none">
                                <picture>
                                    <source srcset="landing/images/pBYqXLK1aYf6.webp" type="image/webp">
                                    <img src="landing/images/AsraKvFD9SSS.png" srcset="landing/images/AsraKvFD9SSS.png"
                                         alt="img" width="38"
                                         height="38">
                                </picture>
                            </div>
                            <div class="flex-1 text-xl font-medium">XCN</div>
                        </a></li>
                    <li><a class="flex items-center gap-6" href="#governance">
                            <div class="flex-none">
                                <picture>
                                    <source srcset="landing/images/jysIrZ5Jx3Vm.webp" type="image/webp">
                                    <img src="landing/images/w8agvh0bmieK.png" srcset="landing/images/w8agvh0bmieK.png"
                                         alt="img" width="38"
                                         height="38">
                                </picture>
                            </div>
                            <div class="flex-1 text-xl font-medium">Governance</div>
                        </a></li>
                    <li><a class="flex items-center gap-6" href="#markets">
                            <div class="flex-none">
                                <picture>
                                    <source srcset="landing/images/0qIHsw3AooJ6.webp" type="image/webp">
                                    <img src="landing/images/7xdkSeONdWxa.png" srcset="landing/images/7xdkSeONdWxa.png"
                                         alt="img" width="38"
                                         height="38">
                                </picture>
                            </div>
                            <div class="flex-1 text-xl font-medium">Markets</div>
                        </a></li>
                </ul>
            </div>
            <div class="mobile-menu__footer"><a class="launch-btn" href="{{ route('register') }}"><span
                        class="text flex-1">{{ $t[Translation::LANDING_PAGE_REGISTER_BUTTON_TEXT] }}</span><span class="icon flex-none"><span
                            class="block svg-image-arrow-right"></span></span></a></div>
        </div>
    </div>

    <main class="main">
        <section class="relative z-[4] bg-black overflow-hidden">
            <div class="pt-12 welcome-area">
                <div class="container">
                    <h1 class="text-center text-55"><span
                            class="gradient-white-title is-up">{{ $t[Translation::LANDING_PAGE_PAGE_TITLE_LINE_1] }} </span><br><span
                            class="gradient-white-title is-up">{{ $t[Translation::LANDING_PAGE_PAGE_TITLE_LINE_2] }}</span></h1>
                    <div class="h-[268px] mt-12 relative -z-[1] mix-blend-lighten pointer-events-none">
                        <div class="welcome-image">
                            <video src="landing/media/iAIIMeAO3BXx.mp4" muted="" autoplay="" playsinline=""
                                   preload="auto"
                                   id="welcome-beginning"></video>
                            <video src="landing/media/SSILOCrQ9Ewv.mp4" muted="" loop="" playsinline="" preload="auto"
                                   id="welcome-loop"></video>
                        </div>
                    </div>
                    <div class="flex justify-center items-center gap-3 is-up">
                        <div class="flex-none text-greye2 text-22">{{ $t[Translation::LANDING_PAGE_PAGE_DESCRIPTION] }}</div>
                        <div class="flex-none">
                            <picture>
                                <source srcset="landing/images/rMbvTiCQdXtB.webp" type="image/webp">
                                <img src="landing/images/BzdVISY6hy2I.png" srcset="landing/images/BzdVISY6hy2I.png"
                                     alt="img"
                                     decoding="async" loading="lazy" width="29" height="29">
                            </picture>
                        </div>
                    </div>
                    <div class="flex justify-center mt-20 gap-8 sm:gap-2 xs:flex-col">
                        <div class="flex-none is-up"><a class="black-trs-btn" href="#">{{ $t[Translation::LANDING_PAGE_HERO_BUTTON_1_TEXT] }}</a></div>
                        <div class="flex-none is-up"><a class="blue-btn" href="#">{{ $t[Translation::LANDING_PAGE_HERO_BUTTON_2_TEXT] }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-10 sm:pt-0">
            <div class="container">
                <div class="mt-[242px] mb-[365px] sm:mb-[242px]">
                    <div class="distribution-area-logo">
                        <div class="distribution-area-logo_el mix-blend-exclusion">
                            <div class="video-distribution-wrapper">
                                <video src="landing/media/5O8wGANUxv6j.mp4" muted="" playsinline="" preload="auto"
                                       id="video-distribution"></video>
                                <video src="landing/media/UeQpiWy1Amy4.mp4" muted="" loop="" playsinline=""
                                       preload="auto"
                                       id="video-distribution-loop"></video>
                                <div class="bottom-gr"></div>
                            </div>
                        </div>
                        <div
                            class="distribution-name flex items-center justify-center gap-3 distribution-name-bottom op-0 tooltip">
                            <div class="flex-none"><img src="landing/images/chK7zf8IJLgm.svg" alt="Payments" width="22"
                                                        height="22"></div>
                            <div>
                                <div class="flex-none text-24 text-ea">Q4 2025</div>
                                <div class="tooltip-text">{{ $t[Translation::LANDING_PAGE_Q4_2025_TEXT] }}
                                </div>
                            </div>
                        </div>

                        <div
                            class="distribution-name flex items-center justify-center gap-3 distribution-name-right op-0">
                            <div class="flex-none"><img src="landing/images/O4qI8RXs6Ymt.svg" alt="Governance"
                                                        width="21"
                                                        height="21"></div>
                            <div class="flex-none text-24 text-ea"></div>
                        </div>
                        <div
                            class="distribution-name flex items-center justify-center gap-3 distribution-name-left op-0">
                            <div class="flex-none"><img src="landing/images/GVSLaly9RxYq.svg" alt="Staking" width="20"
                                                        height="20"></div>
                            <div class="flex-none text-24 text-ea"></div>
                        </div>
                        <div
                            class="distribution-name flex items-center justify-center gap-3 distribution-name-top op-0 tooltip">
                            <div class="flex-none text-24">Q1 2025</div>
                            <div class="tooltip-text"> {{ $t[Translation::LANDING_PAGE_Q1_2025_TEXT] }}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="relative -top-10" id="markets"></div>
                <div class="flex justify-center items-center gap-16 relative flex-wrap z-[8]">
                    <div class="flex-none is-up"><a class="partner-logo" href="#"><img
                                src="landing/images/DKNHlF0j3W6s.svg"
                                alt="partner logo" width="152"
                                height="28"></a></div>
                    <div class="flex-none is-up"><a class="partner-logo" href="#"><img
                                src="landing/images/uD1yiFw0bR6C.svg"
                                alt="partner logo" width="136"
                                height="32"></a></div>
                    <div class="flex-none is-up"><a class="partner-logo" href="#"><img
                                src="landing/images/sALeczfGQIMq.svg"
                                alt="partner logo" width="125"
                                height="26"></a></div>
                    <div class="flex-none is-up"><a class="partner-logo" href="#"><img
                                src="landing/images/XgeL2KmxV8lD.svg"
                                alt="partner logo" width="141"
                                height="23"></a></div>
                    <div class="flex-none is-up"><a class="partner-logo" href="#"><img
                                src="landing/images/PwPfJhRMVVms.svg"
                                alt="partner logo" width="136"
                                height="35"></a></div>
                    <div class="flex-none is-up"><a class="partner-logo" href="#"><img
                                src="landing/images/vSYgEV4f5LrY.svg"
                                alt="partner logo" width="129"
                                height="31"></a></div>
                </div>
            </div>
        </section>

        <div class="iframe-container">
            <iframe class="full-screen-iframe" src="/levels-calculator"></iframe>
        </div>
    </main>
    <footer class="footer">
        <div class="footer__top">
            <div class="container">
                <nav class="maw1000 flex gap-5 justify-center sm:grid sm:grid-cols-2">
                    <section class="flex-none space-y-6">
                        <h2 class="bottom-menu__title">{{ $t[Translation::LANDING_PAGE_FOOTER_MENU_1_TITLE] }}</h2>
                        <ul class="bottom-menu space-y-4">
                            <li><a href="#" target="_blank">Coinbase</a></li>
                            <li><a href="#" target="_blank">Kraken</a>
                            </li>
                            <li><a href="#" target="_blank">Bithumb</a></li>
                            <li><a href="#" target="_blank">Kucoin</a></li>
                            <li><a href="#" target="_blank">Gate</a></li>
                            <li><a href="#" target="_blank">HTX</a></li>
                        </ul>
                    </section>
                    <section class="flex-none space-y-6">
                        <h2 class="bottom-menu__title">{{ $t[Translation::LANDING_PAGE_FOOTER_MENU_2_TITLE] }}</h2>
                        <ul class="bottom-menu space-y-4">
                            <li><a href="{{ $t[Translation::LANDING_PAGE_TWITTER_URL] }}" target="_blank">Twitter</a></li>
                            <li><a href="{{ $t[Translation::LANDING_PAGE_TELEGRAM_URL] }}" target="_blank">Telegram</a></li>
                        </ul>
                    </section>
                </nav>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container flex items-center sm:flex-col gap-5">
                <div class="flex-none w-[200px] sm:w-auto">
                    <div class="footer-logo">
                        <picture>
                            <source srcset="landing/images/D9JzfwmqJM3j.webp" type="image/webp">
                            <img src="landing/images/yJc7QCoKPMm0.png" srcset="landing/images/yJc7QCoKPMm0.png"
                                 alt="img" width="110"
                                 height="31" title="The Backbone of Decentralised Web3 Protocols">
                        </picture>
                    </div>
                </div>
                <small class="flex-1 text-center text-sm">Copyright© 2024 {{ $appName }}. All rights reserved.</small>
                <div class="flex-none w-[200px] sm:w-auto">
                    <ul class="footer-socials justify-end">
                        <li><a href="{{ $t[Translation::LANDING_PAGE_TELEGRAM_URL] }}"><img src="landing/images/t9kq5MoXlBQm.svg" alt="Telegram" width="18"
                                             height="15"></a></li>
                        <li><a href="{{ $t[Translation::LANDING_PAGE_TWITTER_URL] }}"><img src="landing/images/vTt9yzU7xQVA.svg" alt="twitter"
                                             width="18" height="15"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div class="overlay"></div>
</div>
<script src="landing/js/myc6Qf9SHGLm.js"></script>

</body>
</html>
