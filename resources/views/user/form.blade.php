<!-- Name Form Input -->
<div class="form-group @if ($errors->has('name')) has-error @endif">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" class="form-control" placeholder='Name'>
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<!-- email Form Input -->
<div class="form-group @if ($errors->has('email')) has-error @endif">
    <label for="email">Email</label>
    <input type="text" id="email" name="name" class="form-control" placeholder='Email'>
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>

<!-- password Form Input -->
<div class="form-group @if ($errors->has('password')) has-error @endif">
    <label for="password">Email</label>
    <input type="text" id="password" name="Password" class="form-control" placeholder='Password'>
    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
</div>

<!-- Roles Form Input -->
<div class="form-group @if ($errors->has('roles')) has-error @endif">
    <label for="roles[]">Roles</label> 
    <select multiple="multiple" id="roles[]" name="roles[]" class="form-control">        
        dd($roles);
        @foreach($roles as $role)
          <option value="{{isset($user) ? $user->role->pluck('id')->toArray() : null}}">{{isset($user) ? $user->role->pluck('name') : null}}</option>
        @endforeach
    </select>
    @if ($errors->has('roles')) <p class="help-block">{{ $errors->first('roles') }}</p> @endif
</div>

<!-- Permissions -->
@if(isset($user))
    @include('shared.permissions', ['closed' => 'true', 'model' => $user ])
@endif