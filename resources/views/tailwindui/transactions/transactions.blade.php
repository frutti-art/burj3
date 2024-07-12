@extends('tailwindui.main')

@section('content')
    @if($isMobile)
        @include('tailwindui.transactions.transactions-mobile')
    @else
        @include('tailwindui.transactions.transactions-desktop')
    @endif
@endsection
