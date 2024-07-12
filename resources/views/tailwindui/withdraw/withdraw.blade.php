@extends('tailwindui.main')

@section('content')
    @if($isMobile)
        @include('tailwindui.withdraw.withdraw-mobile')
    @else
        @include('tailwindui.withdraw.withdraw-desktop')
    @endif
@endsection
