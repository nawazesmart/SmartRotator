<div>
    
    <div class="text-center">
        <h5>Verify Your Email</h5>
        <p>Please enter the 4 digit code sent to <strong>{{ $email }}</strong></p>
    </div>
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
    <form id="" class="mb-3" wire:submit="verify">
        <div class="mb-3">
            <div class="form-floating form-floating-outline">
                <input
                    type="text"
                    id="otp"
                    class="form-control"
                    name="otp"
                    wire:model.live="otp"
                    placeholder="Enter Your OTP"/>
                <label for="password">OTP</label>
            </div>
            @error('otp')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Verify</button>
        </div>
    </form>
</div>



    
