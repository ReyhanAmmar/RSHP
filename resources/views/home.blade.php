@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} - {{ session('user_name') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} - {{ session('user_role_name') }}
                
                <div class="menu-grid">
                    <a href="{{ route('admin.datauser.index') }}" class="menu-card">
                        <div class="menu-icon">👤</div>
                        <h3>Data User</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
