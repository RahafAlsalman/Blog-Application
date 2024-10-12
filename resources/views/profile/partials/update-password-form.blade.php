<section>
    <header>
        <h2 class="h5 font-weight-bold text-dark">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 small text-muted">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="current_password">{{ __('Current Password') }}</label>
            <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
            @if ($errors->updatePassword->get('current_password'))
                <div class="text-danger mt-2">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="password">{{ __('New Password') }}</label>
            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" />
            @if ($errors->updatePassword->get('password'))
                <div class="text-danger mt-2">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
            @if ($errors->updatePassword->get('password_confirmation'))
                <div class="text-danger mt-2">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="small text-muted"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
