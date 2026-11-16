@extends('layout.main')
@section('conteudo')
<div class="row justify-content-center">
    @if (session('login_success'))
        <div class="alert alert-success mt-3">
            {{ session('login_success') }}
        </div>
    @endif
    <div class="col-md-6 col-sm-8">
        <div class="card p-5">
            <!-- logo -->
            <div class="text-center p-3">
                <img src="assets/images/logo.png" alt="Notes logo">
            </div>
            <a href="/logout" class="btn btn-outline-secondary w-100">Logout</a>
        </div>
    </div>
</div>
@endsection
