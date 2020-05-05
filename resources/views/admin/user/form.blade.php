<div class="tab-content">
    <div class="tab-pane active" id="rd_create_user_tab_1" role="tabpanel">
        <div class="card">

            <div class="card-header">
                <h5 class="col-xl-9 offset-xl-3 mb-0">User's Profile Details</h5>
            </div>
            
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-xl-4 col-form-label">Avatar</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="rd-avatar rd-avatar--outline" id="rd_user_add_avatar">
                            <div class="rd-avatar__holder" style="background-image: url({{ $user->gravatar() }})">

                            </div>
                            <label class="rd-avatar__upload" data-toggle="rd-tooltip" title=""
                                data-original-title="Change avatar">
                                <i class="fa fa-pen"></i>
                                <input type="file" name="rd_user_add_user_avatar">
                            </label>
                            <span class="rd-avatar__cancel" data-toggle="rd-tooltip" title=""
                                data-original-title="Cancel avatar">
                                <i class="fa fa-times"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group row @if ($errors->has('first_name')) has-error @endif">
                    <label class="col-xl-4 col-lg-4 col-form-label">First Name</label>
                    <div class="col-lg-4 col-xl-4">
                        <input class="form-control" id="first_name" name="first_name" type="text"
                            value="{{ $user->first_name }}" aria-invalid="false">
                        @if ($errors->has('first_name')) <p class="help-block">{{ $errors->first('first_name') }}</p> @endif
                    </div>
                </div>

                <div class="form-group row @if ($errors->has('last_name')) has-error @endif">
                    <label class="col-xl-4 col-lg-4 col-form-label" for="last_name">Last Name</label>
                    <div class="col-lg-4 col-xl-4">
                        <input class="form-control" id="last_name" name="last_name" type="text" value="{{ $user->last_name }}"
                            aria-invalid="false">
                        @if ($errors->has('Last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
                    </div>
                </div>

                <div class="form-group row @if ($errors->has('email')) has-error @endif">
                    <label class="col-xl-4 col-lg-4 col-form-label" for="email">Email</label>
                    <div class="col-lg-4 col-xl-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-at"></i></span>
                            </div>
                            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}"
                                aria-invalid="false">
                            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                        </div>
                    </div>
                </div>

                <div class="form-group row @if ($errors->has('password')) has-error @endif">
                    <label class="col-xl-4 col-lg-4 col-form-label" for="password">Password</label>
                    <div class="col-lg-4 col-xl-4">
                        <input type="password" id="password" name="password" class="form-control" value="{{ $user->password }}"
                            placeholder="Password">
                        @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                    </div>
                </div>

                <div class="form-group form-group-last row">
                    <label class="col-xl-4 col-lg-4 col-form-label" for="password_confirmation">Confirm Password</label>
                    <div class="col-lg-4 col-xl-4">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                            value="{{ $user->password_confirmation }}" placeholder="Confirm password">
                        @if ($errors->has('password_confirmation')) <p class="help-block">
                            {{ $errors->first('password_confirmation') }}
                        </p> @endif
                    </div>
                </div>

                <div class="form-group row @if ($errors->has('roles')) has-error @endif">
                    <label class="col-xl-4 col-lg-4 col-form-label" for="roles">Roles</label>
                    <div class="col-lg-4 col-xl-4">
                        <select id="roles" name="roles" class="form-control" multiple="multiple" required=""
                            placeholder="Choose a Role">
                            @foreach($roles as $id => $name)
                            <option value="{{ $id }}" {{ $user->hasRole($name) ? "selected" : null }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('roles')) <p class="help-block">{{ $errors->first('roles') }}</p> @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Permissions -->
        @if(isset($user))
        @include('shared.permissions', ['closed' => 'true', 'model' => $user ])
        @endif

    </div>

    <div class="tab-pane" id="rd_create_user_tab_2" role="tabpanel">
        tab 2
    </div>

    <div class="tab-pane" id="rd_create_user_tab_3" role="tabpanel">
        tab 3
    </div>

    <div class="tab-pane" id="rd_create_user_tab_4" role="tabpanel">
        tab 4
    </div>
</div>
