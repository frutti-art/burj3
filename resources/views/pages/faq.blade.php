<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Governance Rewards Estimator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .slider-container {
            position: relative;
            width: 100%;
            margin-top: 1.5rem; /* Add top margin for the slider */
            margin-bottom: 2rem; /* Add bottom margin for the slider */
        }
        .slider-value {
            position: absolute;
            top: 2rem; /* Position the labels below the slider */
            color: white;
            transform: translateX(-50%);
        }
        .slider-min {
            left: 0;
            transform: translateX(0); /* Align the min value to the left */
        }
        .slider-max {
            right: 0;
            transform: translateX(0); /* Align the max value to the right */
        }
    </style>
</head>
<body class="bg-slate-50 text-white flex justify-center items-center w-full">
<div class="bg-[#121B25] w-full">
    <div class="mx-auto max-w-7xl px-6 py-16 sm:py-24 lg:px-8">
        <h2 class="text-2xl font-bold leading-10 tracking-tight text-white">Frequently asked questions</h2>
        <p class="mt-6 max-w-2xl text-base leading-7 text-gray-300">Have a different question and can’t find the answer you’re looking for? Reach out to our support team by contacting us and we’ll get back to you as soon as we can.</p>
        <div class="mt-20">
            <dl class="space-y-16 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-16 sm:space-y-0 lg:grid-cols-3 lg:gap-x-10">

                @foreach($faqs as $faq)
                    <div>
                        <dt class="text-base font-semibold leading-7 text-white">{{ $faq->question }}</dt>
                        <dd class="mt-2 text-base leading-7 text-gray-300">{{ $faq->answer }}</dd>
                    </div>
                @endforeach

            </dl>
        </div>
    </div>
</div>
