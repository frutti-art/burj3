@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-6 pb-6 text-center">
        <div class="px-6 py-6 text-center">
            <h1 class="font-semibold text-4xl">Your wallet</h1>
        </div>

        <div class="stats w-full stats-vertical sm:stats-horizontal shadow mb-6">

            @include('pages.withdraw-card')
        </div>
    </div>
@endsection

