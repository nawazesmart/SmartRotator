<div>
    @include('livewire.modal')
    <div class="card">
        <div class="card-header border-bottom-dashed">
            <div class="row g-4 align-items-center">
                <div class="col-sm">
                    <div class="col-xl-3">
                        <div class="col-sm">
                            <div class="d-flex">
                                <div class="search-box">
                                    <input type="text" wire:model.live="search" class="form-control" id="searchProductList" autocomplete="off" placeholder="Search Roles...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="d-flex flex-wrap align-items-start gap-2">
                        <div class="ms-2">
                            <select class="form-select" wire:model.live="size" name="size">
                                <option value="5">5</option>
                                <option selected value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        @can('add role')
                            <a href="{{ route('roles.create') }}" class="btn btn-primary">
                                <span class="tf-icons mdi mdi-plus me-1"></span>Create
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Role Name</th>
                            <th>Create Date</th>
                            <th>Update Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $key=>$role)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ date('d M, Y', strtotime($role->created_at)) }}</td>
                            <td>
                                @if ($role->created_at == $role->updated_at)
                                    {{ 'N/A' }}
                                @else
                                    {{  date('d M, Y', strtotime($role->created_at)) }}
                                @endif
                            </td>
                            <td>
                                <div class="hstack gap-2">  
                                    @can('view permission')
                                        <button data-bs-toggle="modal" data-bs-target="#permission-{{ $role->id }}" class="btn btn-icon btn-sm btn-outline-primary waves-effect">
                                            <span class="tf-icons mdi mdi-table-headers-eye"></span>
                                        </button>
                                    @endcan
                                    @can('edit role')
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-icon btn-sm btn-outline-primary">
                                            <span class="tf-icons mdi mdi-square-edit-outline"></span>
                                        </a>
                                    @endcan
                                    @can('delete role')
                                        <button class="btn btn-icon btn-sm btn-outline-danger" onClick="confirm('Are you Sure?')" wire:click="delete({{$role->id}})">
                                            <span class="tf-icons mdi mdi-trash-can-outline"></span>
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Permission Modals -->
                        <div id="permission-{{ $role->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">Permission</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-2">
                                            @foreach ($role->permissions as $item)
                                            <div class="col-3">
                                                <span class="badge bg-label-primary w-100">{{ $item->name }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="text-center">
                                    <p class="text-muted mb-0">Data Not Found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="">
                <div class="float-start mt-2">
                    <div class="dataTables_info">Showing 1 to {{ count($roles) }} of {{ $total_role }} entries</div>
                </div>
                <div class="float-end">
                    {{ $roles->links('vendor.livewire.bootstrap')}}
                </div>
            </div>
         </div>
    </div>
</div>
