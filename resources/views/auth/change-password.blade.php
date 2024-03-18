@extends('auth.layouts.main')

@section('title', 'Login')
@section('content')
<div class="card-body mt-2">

    <livewire:auth.change-password :id="$id" :token="$token">
        
</div>
@endsection