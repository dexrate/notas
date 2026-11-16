@extends('layout.main')
@section('conteudo')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">
            @include('layout.top')
            <!-- label and cancel -->
            <div class="row">
                <div class="col">
                    <p class="display-6 mb-0">Editar Nota</p>
                </div>
                <div class="col text-end">
                    <a href="{{ route('home') }}" class="btn btn-outline-danger">
                        <i class="fa-solid fa-xmark"></i>
                    </a>            
                </div>
            </div>

            <!-- form -->
            <form action="{{ route('editar-nota-submit', ['id' => $nota->id]) }}" method="post">
                @csrf
                <input type="hidden" name="nota_id" value="{{ Crypt::encrypt($nota->id) }}">
                <div class="row mt-3">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Titulo</label>
                            <input type="text" class="form-control bg-primary text-white" name="titulo" value="{{ old('titulo', $nota->titulo) }}">
                            {{-- mostra erro --}}
                            @error('titulo')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nota</label>
                            <textarea class="form-control bg-primary text-white" name="conteudo" rows="5">{{ old('conteudo', $nota->conteudo) }}</textarea>
                            {{-- mostra erro --}}
                            @error('conteudo')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-end">
                        <a href="{{ route('home') }}" class="btn btn-primary px-5"><i class="fa-solid fa-ban me-2"></i>Cancel</a>
                        <button type="submit" class="btn btn-secondary px-5"><i class="fa-regular fa-circle-check me-2"></i>Save</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>

@endsection