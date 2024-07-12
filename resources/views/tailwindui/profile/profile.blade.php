@extends('tailwindui.main')

@section('content')
    @if($isMobile)
        @include('tailwindui.profile.profile-mobile')
    @else
        @include('tailwindui.profile.profile-desktop')
    @endif
@endsection
