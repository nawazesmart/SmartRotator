<div>
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
    <form id="formAuthentication" class="mb-3" wire:submit="store">
        <div class="form-floating form-floating-outline mb-3">
            <input
            type="text"
            class="form-control"
            id="name"
            name="name"
            wire:model.live="name"
            placeholder="Enter your name"
            autofocus />
            <label for="name">Full Name</label>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-floating form-floating-outline mb-3">
            <input 
            type="text" 
            class="form-control" 
            id="email" 
            wire:model.live="email"
            name="email" 
            placeholder="Enter your email" />
            <label for="email">Email</label>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="input-group input-group-merge">
                <div class="form-floating form-floating-outline">
                    <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    wire:model.live="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                    <label for="password">Password</label>
                </div>
                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
            </div>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary d-grid w-100">
            <i wire:loading="" wire:target="store" class="mdi mdi-loading mdi-spin align-middle me-2"></i>
            <span wire:loading.remove wire:target="store">Sign up</span>
        </button>
    </form>
</div>
