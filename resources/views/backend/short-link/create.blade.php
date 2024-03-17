@extends('backend.layouts.main')
@section('title', 'Create Link')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card" id="customerList">
            <div class="card-header border-bottom-dashed">
                <div class="row g-4 align-items-center">
                    <div class="col-sm">
                        <h4 class="card-title mb-0 flex-grow-1">Create Link</h4>
                    </div>
                </div>
            </div>
           
            <livewire:backend.create-link>

        </div>
    </div>
</div>
@endsection