@extends('backend.layouts.main')

@section('title', 'Create Roles')

@push('css')
    <style>
    .masonry {
        column-count: 3; /* Number of columns */
        column-gap: 15px; /* Gap between columns */
    }

    @media (min-width: 412px) {
        .masonry {
        column-count: 1; /* Two columns on larger screens */
        }
    }

    @media (min-width: 658px) {
        .masonry {
        column-count: 2; /* Two columns on larger screens */
        }
    }

    @media (min-width: 992px) {
        .masonry {
        column-count: 3; /* Three columns on even larger screens */
        }
    }

    @media (min-width: 1200px) {
        .masonry {
        column-count: 3; /* Four columns on extra large screens */
        }
    }
    </style>
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card" id="customerList">
            <div class="card-header border-bottom-dashed">
                <div class="row g-4 align-items-center">
                    <div class="col-sm">
                        <h4 class="card-title mb-0 flex-grow-1">Create Role</h4>
                    </div>
                </div>
            </div>
           
            <div class="card-body">
                <form class="row needs-validation" action="{{ route('roles.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="col-md-3 mb-4">
                        <div class="sticky-side-div">
                            <label for="rolename" class="form-label">Role name</label>
                            <input type="text" class="form-control" name="role_name" id="rolename" placeholder="Role Name" value="{{ old('role_name') }}" required>
                            <div class="invalid-feedback">
                                Please enter role name.
                            </div>
                            @error('role_name')
                                <span class="text-danger"><small>{{ $message }}</small></span>
                            @enderror
                            <div class="mt-3">
                                <button class="btn btn-primary w-100" type="submit">Role Create</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="masonry">
                            @foreach ($groupedPermissions->chunk(1) as $chunks)
                            <div class=" mb-3" style="break-inside: avoid; margin-bottom: 20px;">
                                <div class="card bg-light">
                                    @foreach ($chunks as $prefix => $permissions)
                                        <span class="p-3">
                                            <label class="fs-18 float-start" for="">{{ ucwords($prefix) }}</label>
                                        </span>
                                        <ul>
                                        @foreach($permissions as $permission)
                                            <div>
                                                <input type="checkbox" name="permissions[]" id="permission-checkbox-{{ $permission->id }}" value="{{ $permission->id }}" class="form-check-input permission-checkbox">
                                                
                                                <label for="permission-checkbox-{{ $permission->id }}">&nbsp;&nbsp;{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>    
                    </div> 
                </form>
            </div>
        </div>

    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection