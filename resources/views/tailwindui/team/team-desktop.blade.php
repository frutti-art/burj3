@php use App\Models\Translation; @endphp

@extends('tailwindui.desktop.submain')

@section('page_name', $t[Translation::TEAM_PAGE_TITLE])
@push('page_description')
    @include('tailwindui.desktop.description-card', ['description' => $t[Translation::TEAM_PAGE_DESCRIPTION]])
@endpush

@section('subcontent')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-2 gap-y-6">
        @include('tailwindui.team.qr-card')

        @include('tailwindui.team.referrals-list')
    </div>

@endsection
