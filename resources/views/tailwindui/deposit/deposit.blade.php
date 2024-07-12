@extends('tailwindui.main')

@section('content')
    @if($isMobile)
        @include('tailwindui.deposit.deposit-mobile')
    @else
        @include('tailwindui.deposit.deposit-desktop')
    @endif
@endsection
