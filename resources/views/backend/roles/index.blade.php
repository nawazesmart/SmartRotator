@extends('backend.layouts.main')

@section('title', 'Roles')
@section('content')
<div class="row">
    <div class="col-lg-12">

        <livewire:backend.role>

    </div>
</div>
<!--end row-->

@endsection
@push('js')
    <script src="{{ url('backend/assets/js/jquery-3.6.0.min.js') }}"></script>
@endpush 