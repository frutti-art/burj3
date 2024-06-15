@php use App\Models\Translation; @endphp
@extends('tailwindui.main')

@section('content')

    <div>
        <div class="text-center pb-4 pt-2">
            <span
                class="text-3xl font-medium leading-6 text-indigo-600 dark:text-[#FFFFFF]">{{ $t[Translation::DEPOSIT_PAGE_TITLE] }}</span>
            <p class="mt-2 max-w-4xl text-sm text-gray-500 dark:text-[#8899A6]">{{ $t[Translation::DEPOSIT_PAGE_DESCRIPTION] }}</p>
        </div>

        <div class="pt-4 flex items-center justify-center">
            {!! QrCode::size(200)->generate($user->wallet_address) !!}
        </div>

        <div class="pt-8 mx-4">
            <div class="mt-2 flex rounded-md shadow-sm">
                <div class="relative flex flex-grow items-stretch">
                    <textarea disabled id="wallet_address" name="wallet_address" id="email"
                              class="block w-full min-h-24 md:min-h-16 overflow-hidden resize-y rounded-none rounded-l-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $user->wallet_address }}</textarea>
                </div>
                <button type="button" onclick="copyToClipboard()"
                        class="dark:text-[#FFFFFF] relative -ml-px inline-flex items-center rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"/>
                    </svg>
                    Copy to clipboard
                </button>
            </div>

            <div class="text-slate-400 italic pt-4">
                {{ $t[Translation::DEPOSIT_PAGE_USUALLY_PROCESSED_TEXT] }}
            </div>

            <div class="text-slate-400 italic pt-4">
                {{ $t[Translation::DEPOSIT_PAGE_HELP_TEXT] }}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function copyToClipboard() {
            // Get the text field
            var copyText = document.getElementById("wallet_address");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);
        }
    </script>
@endpush
