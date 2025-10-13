<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Log in (Livewire)</div>
            <div class="panel-body">
                {{-- No 'action' or 'method' attributes needed for the form --}}
                <form wire:submit.prevent="login">
                    <fieldset>
                        <div class="form-group">
                            {{-- Bind the input to the public property 'email' --}}
                            <input wire:model="email" class="form-control" placeholder="E-mail" name="email" type="text" autofocus="">
                            @error('email')
                                <div class="alert alert-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group position-relative">
                            {{-- Bind the input to the public property 'password' --}}
                            <input wire:model="password" class="form-control hide-password" placeholder="Password" name="password" type="password">
                            <span class="far fa-eye eye-login see-password position-absolute close"></span>
                        </div>
                        {{-- The button automatically submits the form --}}
                        <button type="submit" class="btn btn-primary">Login</button>
                    </fieldset>
                </form>
            </div>
            @if (session()->has('failed'))
                <div class="alert alert-danger">
                    <strong>{{ session('failed') }}</strong>
                </div>
            @endif
        </div>
    </div>
</div>
