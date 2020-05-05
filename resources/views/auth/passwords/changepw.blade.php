@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Change password</div>

                    <div class="card-body">
                        <div class="row">
                             <div class="col-md-4 text-md-right"><img class="rounded-circle" src="/profiles/{{auth()->user()->profile->profileImage() ?? ''}}" alt=""  width="50px" height="50px"></div>
                        <div class="col-md-6 pt-1" style="font-size: 20px">{{auth()->user()->username}}</div>
                        </div>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                            <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                                {{ csrf_field() }}

                                <div class="pt-3 form-group row{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                    <label for="new-password" class="col-md-4 text-md-right">Current Password</label>

                                    <div class="col-md-6">
                                        <input id="current-password" type="password" class="form-control" name="current-password" required>

                                        @if ($errors->has('current-password'))
                                            <span class="help-block">
                                        <span class="text-danger">{{ $errors->first('current-password') }}</span>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                    <label for="new-password" class="col-md-4 text-md-right">New Password</label>

                                    <div class="col-md-6">
                                        <input id="new-password" type="password" class="form-control" name="new-password" required>

                                        @if ($errors->has('new-password'))
                                            <span class="help-block">
                                        <span class="text-danger">{{ $errors->first('new-password') }}</span>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new-password-confirm" class="col-md-4 text-md-right">Confirm New Password</label>

                                    <div class="col-md-6">
                                        <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Change Password
                                        </button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

