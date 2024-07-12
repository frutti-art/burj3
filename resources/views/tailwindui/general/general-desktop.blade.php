@php use App\Models\Translation; @endphp

@extends('tailwindui.desktop.submain')

@section('page_name', 'Dashboard')

@section('subcontent')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-2 gap-y-6">
        @include('tailwindui.home.account-info-card')
        @include('tailwindui.general.claim-card')
    </div>

@endsection
