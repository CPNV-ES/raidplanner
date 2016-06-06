@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                <div class="panel-body">
                    {{ Form::model($user, ['route' => ['profile.edit', $subdomain], 'method' => 'put', 'class' => 'form-horizontal']) }}


                    {{ Form::label('username', 'Username') }}
                    {{ Form::text('username', $user->username, ['class' => 'form-control']) }}
                    +
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif

                    {{ Form::label('email', 'Email address') }}
                    {{ Form::email('email', $user->email, ['class' => 'form-control']) }}
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                    {{ Form::label('firstname', 'First Name') }}
                    {{ Form::text('firstname', $user->firstname, ['class' => 'form-control']) }}
                    @if ($errors->has('firstname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                    @endif

                    {{ Form::label('lastname', 'Last Name') }}
                    {{ Form::text('lastname', $user->lastname, ['class' => 'form-control']) }}
                    @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif

                    {{ Form::label('old_password', 'Old Password') }}
                    {{ Form::password('old_password', ['class' => 'form-control']) }}
                    @if ($errors->has('old_password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('old_password') }}</strong>
                        </span>
                    @endif


                    {{ Form::label('password', 'New password') }}
                    {{ Form::password('password', ['class' => 'form-control']) }}
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                    {{ Form::label('password_confirmation', 'New password confirmation') }}
                    {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                    {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

