@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>
                <div class="panel-body">

                    {{ Form::model($user, ['action' => ['UserController@update', $user->id], 'method' => 'put', 'class' => 'form-horizontal']) }}

                    {{ Form::label('username', 'Username') }}
                    {{ Form::text('username', $user->username, ['class' => 'form-control']) }}

                    {{ Form::label('email', 'Email address') }}
                    {{ Form::email('email', $user->email, ['class' => 'form-control']) }}

                    {{ Form::label('first_name', 'First Name') }}
                    {{ Form::text('first_name', $user->first_name, ['class' => 'form-control']) }}

                    {{ Form::label('last_name', 'Last Name') }}
                    {{ Form::text('last_name', $user->last_name, ['class' => 'form-control']) }}

                    {{ Form::label('old_password', 'Old Password') }}
                    {{ Form::password('old_password', ['class' => 'form-control']) }}

                    {{ Form::label('password', 'New password') }}
                    {{ Form::password('password', ['class' => 'form-control']) }}

                    {{ Form::label('password_confirmation', 'New password confirmation') }}
                    {{ Form::password('password_confirmation', ['class' => 'form-control']) }}

                    {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

