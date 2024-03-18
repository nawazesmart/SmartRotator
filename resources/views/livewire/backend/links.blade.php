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
                                    <input type="text" wire:model.live="search" class="form-control" id="searchProductList" autocomplete="off" placeholder="Search Links...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="d-flex flex-wrap align-items-start gap-2">
                        <div class="ms-2">
                            <select class="form-select" wire:model.live="status" name="status">
                                <option value="">All</option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>
                        <div class="ms-2">
                            <select class="form-select" wire:model.live="size" name="size">
                                <option value="5">5</option>
                                <option selected value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        @can('add links')
                            <a href="{{ route('links.create') }}" class="btn btn-primary">
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
                            <th>Link Name</th>
                            <th>Short Link</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Create Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($short_links as $key=>$short_link)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $short_link->name }}</td>
                            <td>
                                <a target="_blank" href="{{url('').'/'.$short_link->main_link}}">{{ url('').'/'.$short_link->main_link }}</a>
                                <a type="button" wire:click="copyLink('{{url('').'/'.$short_link->main_link}}')" class="align-bottom waves-effect">
                                    <i class="tf-icons mdi mdi-content-copy"></i>
                                </a>
                            </td>
                            <td>{{ ucwords($short_link->type) }}</td>
                            <td>
                                @if ($short_link->status == "1")
                                    <span class="badge bg-label-success">Active</span>
                                @else
                                    <span class="badge bg-label-danger">Block</span>
                                @endif
                            </td>
                            <td>{{ date('d M, Y', strtotime($short_link->created_at)) }}</td>
                            <td>
                                <div class="hstack gap-2">  
                                    @can('view links')
                                        <a href="{{ route('links.view', $short_link->id) }}" class="btn btn-icon btn-sm btn-outline-primary waves-effect">
                                            <span class="tf-icons mdi mdi-table-headers-eye"></span>
                                        </a>
                                    @endcan
                                    @can('edit links')
                                        <a href="{{ route('links.edit', $short_link->id) }}" class="btn btn-icon btn-sm btn-outline-primary">
                                            <span class="tf-icons mdi mdi-square-edit-outline"></span>
                                        </a>
                                    @endcan
                                    @can('delete links')
                                        <button class="btn btn-icon btn-sm btn-outline-danger" wire:click="delete({{$short_link->id}})">
                                            <span class="tf-icons mdi mdi-trash-can-outline"></span>
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        
                        @empty
                        <tr>
                            <td colspan="8">
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
                    <div class="dataTables_info">Showing 1 to {{ count($short_links) }} of {{ $total_short_links }} entries</div>
                </div>
                <div class="float-end">
                    {{ $short_links->links('vendor.livewire.bootstrap')}}
                </div>
            </div>
         </div>
    </div>
</div>
@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('copyText', (text) => {
                copyToClipboard(text);
            });

            function copyToClipboard(text){
                const textArea = document.createElement('textarea');
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                alert('Text copied');
                document.body.removeChild(textarea);
            }
        });
    </script>
@endpush
