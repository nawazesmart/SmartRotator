<div>
    <div class="card-body">
        <form class="row" wire:submit="store">
            <div class="col-12">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong> {{Session::get('success')}} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> {{Session::get('error')}} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="col-md-4 mb-4">
                <div class="mb-3">
                    <label for="linkname" class="form-label">Link Name</label>
                    <input type="text" wire:model.live="link_name" class="form-control" id="linkname" placeholder="Link Name">
                    @error('link_name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" wire:model.live="description" class="form-control" id="description" placeholder="Description"></textarea>
                    @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" wire:model.live="custom_url" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Custom URL</label>
                    </div>
                </div>
                @if ($custom_url == 1)
                <div class="mb-3">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon34">{{ url('') }}/</span>
                        <input type="text" wire:model.live="short_link" class="form-control" id="short">
                    </div>
                    @error('short_link')<small class="text-danger">{{ $message }}</small>@enderror
                </div>
                @endif
                <div class="mb-3">
                    <button class="btn btn-primary w-100" type="submit"> Create</button>
                </div>
            </div>
            <div class="col-md-8">
                <label class="form-label">Redirects To</label>
                <div class="row g-2">
                    @foreach ($inputs as $index => $item)
                    <div class="col-md-9 mb-1">
                        <div class="input-group">
                            <span class="input-group-text">{{ $index+1 }}</span>
                            <input type="text" wire:model.live="inputs.{{$index}}.link" class="form-control" placeholder="https://">
                        </div>
                        @error('inputs.'.$index.'.link') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-2 mb-1">
                        <div class="input-group">
                            <input type="text" wire:model.live="inputs.{{$index}}.percent" class="form-control" placeholder="Percent" readonly>
                            <span class="input-group-text">%</span>
                        </div>
                        @error('inputs.'.$index.'.percent') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-1 mb-1">
                        @if ($index == 0)
                        <button type="button" wire:click="add" class="btn btn-icon btn-outline-primary waves-effect">
                            <span class="tf-icons mdi mdi-plus"></span>
                        </button>
                        @else
                        <button type="button" wire:click="remove({{ $index }})" class="btn btn-icon btn-outline-danger waves-effect">
                            <span class="tf-icons mdi mdi-close"></span>
                        </button>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </form>
    </div>
</div>
