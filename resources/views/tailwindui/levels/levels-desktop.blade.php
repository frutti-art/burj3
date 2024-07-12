@php use App\Models\Translation; @endphp

@extends('tailwindui.desktop.submain')

@section('page_name', $t[Translation::LEVELS_PAGE_TITLE])
@push('page_description')
    @include('tailwindui.desktop.description-card', ['description' => $t[Translation::LEVELS_PAGE_DESCRIPTION]])
@endpush

@section('subcontent')
    @include('tailwindui.levels.list')

@endsection
