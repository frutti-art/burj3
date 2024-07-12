@php use App\Models\Translation; @endphp
@extends('tailwindui.main')

@section('content')
    <div>
        <div class="text-center pb-4 pt-2">
            <span
                class="text-3xl font-medium leading-6 text-indigo-600 dark:text-[#FFFFFF]">{{ $t[Translation::TEAM_PAGE_TITLE] }}</span>
            <p class="mt-2 max-w-4xl text-sm text-gray-500 dark:text-[#8899A6]">{{ $t[Translation::TEAM_PAGE_DESCRIPTION] }}</p>
        </div>

        @include('tailwindui.team.qr-card')

        @include('tailwindui.team.referrals-list')
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
