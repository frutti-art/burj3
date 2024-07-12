@php use App\Models\Translation; @endphp

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
<div class="relative isolate bg-slate-50">
    <div class="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2">
        <div class="relative px-6 pb-20 pt-24 sm:pt-32 lg:static lg:px-8 lg:py-48">
            <div class="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">Contact us</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">We're here to help. Get in touch with our team for support, inquiries, or feedback.</p>
                <dl class="mt-10 space-y-4 text-base leading-7 text-gray-600">
                    <div class="flex gap-x-4">
                        <dt class="flex-none">
                            <span class="sr-only">Email</span>
                        </dt>
                        <dd><a href="{{ $t[Translation::LANDING_PAGE_TELEGRAM_URL] }}" class="flex items-center justify-center"><img src="landing/images/t9kq5MoXlBQm.svg" alt="Telegram" width="18"
                                                                                            height="15">&nbsp; Contact us in Telegram</a></dd>
                    </div>
                </dl>
            </div>
        </div>
        <form id="contactForm" action="{{ route('contact-action') }}" method="POST" class="px-6 pb-24 pt-20 sm:pb-32 lg:px-8 lg:py-48">
            @csrf

            <div class="mx-auto max-w-xl lg:mr-0 lg:max-w-lg">
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div>
                        <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">First name</label>
                        <div class="mt-2.5">
                            <input required type="text" name="first_name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div>
                        <label for="last-name" class="block text-sm font-semibold leading-6 text-gray-900">Last name</label>
                        <div class="mt-2.5">
                            <input required type="text" name="last_name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email</label>
                        <div class="mt-2.5">
                            <input required type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">Message</label>
                        <div class="mt-2.5">
                            <textarea required name="message" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <div id="message" class="mb-4 text-sm font-semibold"></div>
                    <div class="flex justify-end">
                        <button type="submit" class="rounded-md bg-[#05A3D4] px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send message</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const messageDiv = document.getElementById('message');

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Create a FormData object
            const formData = new FormData(form);

            // Send the form data using fetch
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
                .then(response => response.json())
                .then(data => {
                    // Display the response message
                    messageDiv.textContent = data.message;
                    messageDiv.className = data.success ? 'text-green-600' : 'text-red-600';

                    // Clear the form if the submission was successful
                    if (data.success) {
                        form.reset();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    messageDiv.textContent = 'An error occurred. Please try again.';
                    messageDiv.className = 'text-red-600';
                });
        });
    });
</script>

</body>
</html>
