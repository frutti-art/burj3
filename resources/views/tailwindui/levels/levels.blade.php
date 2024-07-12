@extends('tailwindui.main')

@section('content')
        @if($isMobile)
            @include('tailwindui.levels.levels-mobile')
        @else
            @include('tailwindui.levels.levels-desktop')
        @endif
@endsection
