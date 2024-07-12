@php use App\Models\Translation; @endphp

@extends('tailwindui.desktop.submain')

@push('page_description')
    @include('tailwindui.desktop.description-card', ['description' => $t[Translation::WITHDRAW_PAGE_DESCRIPTION] ])
@endpush

@section('page_name', $t[Translation::WITHDRAW_PAGE_TITLE])

@section('subcontent')
    @include('tailwindui.withdraw.content')
@endsection
