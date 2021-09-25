@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.change_password') }}</div>

                <div class="panel-body">
                    @if (session('success') or session('error'))
                        <div class="alert alert-{{ session('success') ? 'success' : 'danger' }}">
                            {{ session('success') ?: session('error')}}
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password_update') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label for="old_password" class="col-md-4 control-label">{{ trans('auth.old_password') }}</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control" name="old_password" placeholder="******">

                                @if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label for="new_password" class="col-md-4 control-label">{{ trans('auth.new_password') }}</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" placeholder="******">

                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                            <label for="new_password-confirm" class="col-md-4 control-label">{{ trans('auth.new_password_confirmation') }}</label>
                            <div class="col-md-6">
                                <input id="new_password-confirm" type="password" class="form-control" name="new_password_confirmation" placeholder="******">

                                @if ($errors->has('new_password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('auth.change_password') }}
                                </button>
                                <a href="{{ url()->previous() }}" class="btn">
                                    {{ trans('auth.back') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
