@extends('backend.layouts.main')
@section('title', 'Edit Link')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card" id="customerList">
            <div class="card-header border-bottom-dashed">
                <div class="row g-4 align-items-center">
                    <div class="col-sm">
                        <h4 class="card-title mb-0 flex-grow-1">Edit Link</h4>
                    </div>
                </div>
            </div>
           
            <livewire:backend.edit-link :id="$id">

        </div>
    </div>
</div>
@endsection