@php use App\Models\Translation; @endphp

@extends('tailwindui.desktop.submain')

@push('page_description')
    @include('tailwindui.desktop.description-card', ['description' => $t[Translation::DEPOSIT_PAGE_DESCRIPTION] ])
@endpush

@section('page_name', $t[Translation::DEPOSIT_PAGE_TITLE])

@section('subcontent')
    @include('tailwindui.deposit.content')
@endsection
