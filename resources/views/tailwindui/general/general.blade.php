@extends('tailwindui.main')

@section('content')

@if($isMobile)
    @include('tailwindui.general.general-mobile')
@else
    @include('tailwindui.general.general-desktop')
@endif

@endsection
