@php use App\Models\Translation; @endphp

@extends('tailwindui.desktop.submain')

@section('page_name', $t[Translation::PROFILE_PAGE_TITLE])
@push('page_description')
    @include('tailwindui.desktop.description-card', ['description' => $t[Translation::PROFILE_PAGE_DESCRIPTION]])
@endpush

@section('subcontent')
    @include('tailwindui.profile.content')
@endsection
