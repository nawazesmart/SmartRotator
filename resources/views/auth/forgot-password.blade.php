@extends('auth.layouts.main')

@section('title', 'Forgot Password')
@section('content')
<div class="card-body mt-2">

    <livewire:auth.forgot-password>
        
    <p class="text-center">
        <span>Wait, I remember my password...</span>
        <a href="{{ route('login') }}">
            <span> Click here</span>
        </a>
    </p>
</div>
@endsection