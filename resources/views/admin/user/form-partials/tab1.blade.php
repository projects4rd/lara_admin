<div
    class="tab-pane active"
    id="rd_create_user_tab_1"
    role="tabpanel"
>

    <div class="card">
        <div class="card-header">
            <h5 class="col-xl-9 offset-xl-3 mb-0">User Details</h5>
        </div>

        <div class="card-body">

            <div class="form-group row @if ($errors->has('first_name')) has-error @endif">
                <label class="col-xl-4 col-lg-4 col-form-label">First Name</label>
                <div class="col-lg-4 col-xl-4">
                    <input
                        class="form-control rd-form-control-solid"
                        id="first_name"
                        name="first_name"
                        type="text"
                        value="{{ old('first_name') ?? $user->first_name }}"
                        aria-invalid="false"
                    >
                    @if ($errors->has('first_name')) <p class="help-block">{{ $errors->first('first_name') }}</p>
                    @endif
                </div>
            </div>

            <div class="form-group row @if ($errors->has('last_name')) has-error @endif">
                <label
                    class="col-xl-4 col-lg-4 col-form-label"
                    for="last_name"
                >Last Name</label>
                <div class="col-lg-4 col-xl-4">
                    <input
                        class="form-control rd-form-control-solid"
                        id="last_name"
                        name="last_name"
                        type="text"
                        value="{{ old('last_name') ?? $user->last_name }}"
                        aria-invalid="false"
                    >
                    @if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p>
                    @endif
                </div>
            </div>

            <div class="form-group row @if ($errors->has('email')) has-error @endif">
                <label
                    class="col-xl-4 col-lg-4 col-form-label"
                    for="email"
                >Email</label>
                <div class="col-lg-4 col-xl-4">
                    <div class="input-group rd-input-group-solid">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-at"></i></span>
                        </div>
                        <input
                            type="text"
                            class="form-control rd-form-control-solid"
                            id="email"
                            name="email"
                            value="{{ old('email') ?? $user->email }}"
                            aria-invalid="false"
                        >
                        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                    </div>
                </div>
            </div>

            <div class="form-group row @if ($errors->has('slug')) has-error @endif">
                <label
                    class="col-xl-4 col-lg-4 col-form-label"
                    for="last_name"
                >Slug</label>
                <div class="col-lg-4 col-xl-4">
                    <input
                        class="form-control rd-form-control-solid"
                        id="slug"
                        name="slug"
                        type="text"
                        value="{{ old('slug') ?? $user->slug }}"
                        aria-invalid="false"
                    >
                    @if ($errors->has('slug')) <p class="help-block">{{ $errors->first('slug') }}</p>
                    @endif
                </div>
            </div>

            <div class="form-group row @if ($errors->has('password')) has-error @endif">
                <label
                    class="col-xl-4 col-lg-4 col-form-label"
                    for="password"
                >Password</label>
                <div class="col-lg-4 col-xl-4">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control rd-form-control-solid"
                        value="{{ old('password') ?? $user->password }}"
                    >
                    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                </div>
            </div>

            <div class="form-group form-group-last row">
                <label
                    class="col-xl-4 col-lg-4 col-form-label"
                    for="password_confirmation"
                >Confirm Password</label>
                <div class="col-lg-4 col-xl-4">
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control rd-form-control-solid"
                        value="{{ old('password_confirmation') ?? $user->password_confirmation }}"
                    >
                    @if ($errors->has('password_confirmation')) <p class="help-block">
                        {{ $errors->first('password_confirmation') }}
                    </p> @endif
                </div>
            </div>

            <div class="form-group row @if ($errors->has('roles')) has-error @endif">
                <label
                    class="col-xl-4 col-lg-4 col-form-label"
                    for="roles"
                >Roles</label>
                <div class="col-lg-4 col-xl-4">
                    <select
                        id="roles"
                        name="roles[]"
                        class="form-control rd-form-control-solid"
                        multiple="multiple"
                        required=""
                        placeholder="Choose a Role"
                    >
                        @foreach($roles as $id => $name)
                        <option
                            value="{{ $id }}"
                            {{ $user->hasRole($name) ? "selected" : null }}
                        >{{ $name }}
                        </option>
                        @endforeach
                    </select>
                    @if ($errors->has('roles')) <p class="help-block">{{ $errors->first('roles') }}</p> @endif
                </div>
            </div>

            <div class="form-group row @if ($errors->has('approved')) has-error @endif">
                <label
                    class="col-xl-4 col-lg-4 col-form-label"
                    for="roles"
                >Approved</label>
                <div class="col-lg-4 col-xl-4">
                    <div class="checkbox-inline">

                        <input
                            id="approved"
                            name="approved"
                            type="checkbox"
                            value="{{ old('approved') ?? $user->approved }}"
                            checked="{{ old('approved') ?? $user->approved }}"
                        >
                        <span></span>
                        @if ($errors->has('approved')) <p class="help-block">{{ $errors->first('approved') }}</p>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>