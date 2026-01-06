@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
    @if (in_array($page->slug, ['login', 'register', 'forgot-password', 'reset-password']))
        {{-- @include('frontend.auth.' . $page->slug) --}}
        <div>{!! $page->description !!}</div>
    @else
        <div>{!! $page->description !!}</div>
    @endif

@endsection