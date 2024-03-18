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
    <form class="mb-3" wire:submit="forgot_password">
        <div class="form-floating form-floating-outline mb-3">
            <input 
            type="text" 
            class="form-control" 
            id="email" 
            wire:model.live="email"
            name="email-username"
            placeholder="Enter your email" 
            autofocus />
            <label for="email">Email</label>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Send OTP</button>
        </div>
    </form>
</div>
