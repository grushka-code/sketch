@extends('layouts.app')

@section('content')
    <div class="container">
        @role('admin')
        <div class="alert alert-warning text-black-50" role="alert">
            Only Admins see this
        </div>
        @endrole
        <h2>Demo project</h2>
        <div class="col-md-1"> Users List</div>
        <ul>
            <li>Admin <b><i>admin@mail.com</i></b> : <b><i>admin</i></b></li>
            <li>Simple User<b> <i>user@mail.com</i></b> : <b><i>user</i></b></li>
            <li>Simple Moderator for Prices <b><i>moderator@mail.com</i></b> : <b><i>moderator</i></b></li>
        </ul>
    </div>
@endsection
