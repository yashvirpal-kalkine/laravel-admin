@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
    @if (in_array($page->slug, ['login', 'register']))
        @include('frontend.auth.' . $page->slug . '-form')
    @else
        <div>{!! $page->description !!}</div>
    @endif

@endsection