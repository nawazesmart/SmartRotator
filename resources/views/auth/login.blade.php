@extends('auth.layouts.main')

@section('title', 'Login')
@section('content')
<div class="card-body mt-2">

    <livewire:auth.login>
        
    <p class="text-center">
        <span>New on our platform?</span>
        <a href="{{ route('signUp') }}">
            <span>Create an account</span>
        </a>
    </p>
</div>
@endsection