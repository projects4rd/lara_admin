<!-- Name Form Input -->
<div class="form-group @if ($errors->has('name')) has-error @endif">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" placeholder='Name'>
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<!-- email Form Input -->
<div class="form-group @if ($errors->has('email')) has-error @endif">
    <label for="email">Email</label>
    <input type="text" id="email" name="name" class="form-control" value="{{ $user->email }}" placeholder='Email'>
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>

<!-- password Form Input -->
<div class="form-group @if ($errors->has('password')) has-error @endif">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" class="form-control" value="{{ $user->password }}" required="" minlength="5" maxlength="255">
    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
</div>
<div class="form-group">
    <label for="password_confirmation">Password confirmation</label>
    <input type="password" id="password_confirmation" name="password_confirmation" data-parsley-equalto="#password" class="form-control" value="{{ $user->password_confirmation }}" required="" minlength="5" maxlength="255">
</div>

<!-- Roles Form Input -->
<div class="form-group @if ($errors->has('roles')) has-error @endif">
    <label for="role">Roles</label>
    <select id="role" name="role" class="form-control" multiple="multiple" required="" placeholder="Choose a Role">
        @foreach($roles as $id => $name)
            <option value="{{ $id }}" {{ $user->hasRole($name) ? "selected" : null }}>{{ $name }}</option>
        @endforeach
    </select>

    @if ($errors->has('roles')) <p class="help-block">{{ $errors->first('roles') }}</p> @endif
</div>

<!-- Permissions -->
@if(isset($user))
    @include('shared.permissions', ['closed' => 'true', 'model' => $user ])
@endif
