@php use App\Models\Translation; @endphp

@extends('tailwindui.desktop.submain')

@section('page_name', 'Dashboard')
@push('page_description')
    @include('tailwindui.desktop.description-card', ['description' => 'Welcome to your dashboard. Here you can see your account information and new members.'])
@endpush

@section('subcontent')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-2 gap-y-6">
        @include('tailwindui.home.account-info-card')
        @include('tailwindui.home.new-members-list')
    </div>
@endsection
