@extends('layout.main')
@section('conteudo')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">
                @include('layout.top')

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- no notes available -->
                @if (count($notas) === 0)
                    <div class="row mt-5">
                        <div class="col text-center">
                            <p class="display-6 mb-5 text-secondary opacity-50">Você não tem notas disponíveis!</p>
                            <a href="{{ route('new') }}" class="btn btn-secondary btn-lg p-3 px-5">
                                <i class="fa-regular fa-pen-to-square me-3"></i>Crie a primeira nota
                            </a>
                        </div>
                    </div>
                @else
                <!-- temp -->
                <hr class="my-5">
                <!-- notes are available -->
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('new') }}" class="btn btn-secondary px-3">
                        <i class="fa-regular fa-pen-to-square me-2"></i>Nova Nota
                    </a>
                </div>
                    @foreach ($notas as $nota)
                        @include('nota')
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
