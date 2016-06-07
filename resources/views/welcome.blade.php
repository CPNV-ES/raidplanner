@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome on Raidplanner for the server {{title_case($subdomain)}}</div>

                <div class="panel-body">
                    Description of this server MISSING :(
                </div>

                <div class="panel-footer">
                    {{link_to_route('public.server_list', 'Back to list of server') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
