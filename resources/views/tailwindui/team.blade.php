@php use App\Models\Translation; @endphp
@extends('tailwindui.main')

@section('content')
    <div>
        <div class="text-center pb-4 pt-2">
            <span
                class="text-3xl font-medium leading-6 text-indigo-600 dark:text-[#FFFFFF]">{{ $t[Translation::TEAM_PAGE_TITLE] }}</span>
            <p class="mt-2 max-w-4xl text-sm text-gray-500 dark:text-[#8899A6]">{{ $t[Translation::TEAM_PAGE_DESCRIPTION] }}</p>
        </div>

        <div class="pt-4 flex items-center justify-center">
            {!! QrCode::size(200)->generate($user->referral_code) !!}
        </div>

        <div class="flex flex-col justify-center items-center pt-8">

            <div class="flex items-center justify-center pb-4 dark:text-[#FFFFFF]">
                {{ $t[Translation::TEAM_PAGE_YOUR_CODE] }} &nbsp;
                <div class="stat-value text-lg font-bold">{{ $user->referral_code }}</div>
            </div>

            <div>
                <button id="shareButton" type="button"
                        class="flex items-center justify-center rounded-md bg-indigo-600 dark:bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    {{ $t[Translation::TEAM_PAGE_SHARE_URL_WITH_FRIENDS] }} &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"/>
                    </svg>


                </button>
            </div>
        </div>

        <div class="border my-12 pt-2 rounded-2xl shadow-lg border-gray-900/5 bg-gray-100 dark:bg-[#192734] mx-4">
            <div class="text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600 dark:text-[#FFFFFF]">{{ $t[Translation::TEAM_PAGE_REFERRALS_LIST_TITLE] }}</h2>
            </div>
            <ul role="list" class="px-8 pb-4 pt-2 divide-y divide-gray-100">
                @foreach($levelReferralsInfo as $name => $referralsCount)
                    <li class="py-2">
                        <div class="flex items-center gap-x-3">
                            <h3 class="flex-auto truncate text-md font-medium leading-6 text-gray-900 dark:text-[#8899A6]">{{ $name }}</h3>
                            <span class="flex-none text-md text-gray-500 dark:text-[#8899A6]">{{ $referralsCount }} {{ $t[Translation::TEAM_PAGE_FRIENDS] }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>


    </div>

@endsection

@push('js')
    <script>
        document.getElementById('shareButton').addEventListener('click', async () => {
            if (navigator.share) {
                try {
                    await navigator.share({
                        title: 'Register here to win crypto!',
                        text: 'Register here to win crypto!',
                        url: '{{ route('register', ['referral_code' => $user->referral_code]) }}'
                    });
                    console.log('Content shared successfully');
                } catch (error) {
                    console.error('Error sharing content:', error);
                }
            }
        });
    </script>
@endpush
