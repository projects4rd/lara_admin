<div
    class="tab-pane"
    id="rd_create_user_tab_2"
    role="tabpanel"
>
    <div class="card">
        <div class="card-header">
            <h5 class="col-xl-9 offset-xl-3 mb-0">Profile Details</h5>
        </div>

        <div class="card-body">
            <div class="form-group row">
                <label class="col-xl-4 col-form-label">Avatar</label>
                <div class="col-lg-9 col-xl-6">
                    <div
                        class="rd-avatar rd-avatar--outline"
                        id="rd_user_add_avatar"
                    >
                        <div
                            class="rd-avatar__holder"
                            style="background-image: url({{ $user->gravatar() }})"
                        >

                        </div>
                        <label
                            class="rd-avatar__upload"
                            data-toggle="rd-tooltip"
                            title=""
                            data-original-title="Change avatar"
                        >
                            <i class="fa fa-pen"></i>
                            <input
                                type="file"
                                name="rd_user_add_user_avatar"
                            >
                        </label>
                        <span
                            class="rd-avatar__cancel"
                            data-toggle="rd-tooltip"
                            title=""
                            data-original-title="Cancel avatar"
                        >
                            <i class="fa fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group row @if ($errors->has('phone')) has-error @endif">
                <label class="col-xl-4 col-lg-4 col-form-label">Phone</label>
                <div class="col-lg-4 col-xl-4">
                    <div class="input-group rd-input-group-solid">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                        </div>
                        <input
                            type="text"
                            class="form-control rd-form-control-solid"
                            id="phone"
                            name="phone"
                            value="{{ $user->phone }}"
                            aria-invalid="false"
                        >
                        @if ($errors->has('phone')) <p class="help-block">{{ $errors->first('phone') }}</p> @endif
                    </div>
                </div>
            </div>

            <div class="form-group row @if ($errors->has('mobile')) has-error @endif">
                <label class="col-xl-4 col-lg-4 col-form-label">Mobile</label>
                <div class="col-lg-4 col-xl-4">
                    <div class="input-group rd-input-group-solid">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                        </div>
                        <input
                            type="text"
                            class="form-control rd-form-control-solid"
                            id="mobile"
                            name="mobile"
                            value="{{ $user->mobile }}"
                            aria-invalid="false"
                        >
                        @if ($errors->has('mobile')) <p class="help-block">{{ $errors->first('mobile') }}</p> @endif
                    </div>
                </div>
            </div>

            <div class="form-group row @if ($errors->has('salutation')) has-error @endif">
                <label
                    class="col-xl-4 col-lg-4 col-form-label"
                    for="salutation"
                >Salutation</label>
                <div class="col-lg-4 col-xl-4">
                    <input
                        id="salutation"
                        class="form-control rd-form-control-solid"
                        name="salutation"
                        type="text"
                        value="{{ $user->salutation }}"
                        aria-invalid="false"
                    >
                    @if ($errors->has('salutation')) <p class="help-block">{{ $errors->first('salutation') }}</p>
                    @endif
                </div>
            </div>

            <div class="form-group row @if ($errors->has('bio')) has-error @endif">
                <label
                    class="col-xl-4 col-lg-4 col-form-label"
                    for="bio"
                >Bio</label>
                <div class="col-lg-4 col-xl-4">
                    <textarea
                        class="form-control rd-form-control-solid"
                        name="bio"
                        rows="3"
                    >{{ $user->bio }}</textarea>
                    @if ($errors->has('bio')) <p class="help-block">{{ $errors->first('bio') }}</p>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>