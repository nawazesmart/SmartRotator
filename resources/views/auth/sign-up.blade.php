@extends('auth.layouts.main')

@section('title', 'Sign Up')
@section('content')
<div class="card-body mt-2">

    <livewire:auth.sign-up>

    <p class="text-center">
        <span>Already have an account?</span>
        <a href="{{ route('login') }}">
            <span>Sign in</span>
        </a>
    </p>
</div>
@endsection