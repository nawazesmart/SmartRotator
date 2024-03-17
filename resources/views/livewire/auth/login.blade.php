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
    <form id="" class="mb-3" wire:submit="login">
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
            <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                        <input
                            type="password"
                            id="password"
                            wire:model.live="password"
                            class="form-control"
                            name="password"
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
        </div>
        <div class="mb-3 d-flex justify-content-between">
            <div class="form-check">
                <input class="form-check-input" wire:model="remember" type="checkbox" id="remember-me" checked/>
                <label class="form-check-label" for="remember-me"> Remember Me </label>
            </div>
            <a href="" class="float-end mb-1">
                <span>Forgot Password?</span>
            </a>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
        </div>
    </form>
</div>
