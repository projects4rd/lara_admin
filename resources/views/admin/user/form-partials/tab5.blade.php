<div
    class="tab-pane"
    id="rd_create_user_tab_5"
    role="tabpanel"
>
    <div class="card">
        <div class="card-header">
            <h5 class="col-xl-9 offset-xl-3 mb-0">Settings</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <label class="col-form-label col-3 text-lg-right text-left"></label>
                <div class="col-9">
                    <h6 class="text-dark font-weight-bold mb-7">Email</h6>
                </div>
            </div>

            <div class="form-group row @if ($errors->has('email_notifications')) has-error @endif">
                <label
                    class="col-xl-4 col-lg-4 col-form-label"
                    for="roles"
                >Allow Email Notification</label>
                <div class="col-lg-4 col-xl-4">
                    <div class="checkbox">

                        <input
                            id="email_notifications"
                            name="email_notifications"
                            type="checkbox"
                            checked=""
                        >
                        <span></span>
                        @if ($errors->has('email_notifications')) <p class="help-block">
                            {{ $errors->first('email_notifications') }}</p>
                        @endif

                    </div>
                </div>
            </div>

        </div>

        <div class="form-group row">
            <label class="col-xl-4 col-lg-4 col-form-label">Email Notification</label>
            <div class="col-lg-4 col-xl-4">
                <span class="switch">

                    <input
                        type="checkbox"
                        checked="checked"
                        name="select"
                    >
                    <span></span>

                </span>
            </div>

        </div>

        <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-8">
                <div class="form-group row">
                    <label class="col-form-label col-3 text-lg-right text-left">When To Email</label>
                    <div class="col-9">
                        <div class="checkbox-single mb-2">
                            <label class="checkbox">
                                <input type="checkbox">You have new notifications.
                                <span></span>
                            </label>
                        </div>
                        <div class="checkbox-single mb-2">
                            <label class="checkbox">
                                <input
                                    type="checkbox"
                                    checked=""
                                >Someone comments your blog post
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>