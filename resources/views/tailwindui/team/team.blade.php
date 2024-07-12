@extends('tailwindui.main')

@section('content')

@if($isMobile)
    @include('tailwindui.team.team-mobile')
@else
    @include('tailwindui.team.team-desktop')
@endif

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
