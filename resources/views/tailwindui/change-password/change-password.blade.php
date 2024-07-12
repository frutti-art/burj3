@extends('tailwindui.main')

@section('content')
    @if($isMobile)
        @include('tailwindui.change-password.change-password-mobile')
    @else
        @include('tailwindui.change-password.change-password-desktop')
    @endif
@endsection
