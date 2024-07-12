@php use App\Models\Translation; @endphp

@extends('tailwindui.desktop.submain')

@section('page_name', $t[Translation::PROFILE_PAGE_TITLE])

@section('subcontent')
    @include('tailwindui.transactions.content')
@endsection
