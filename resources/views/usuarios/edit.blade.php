@extends('templates.base')
@section('title', 'Editar Perfil')
@section('h1', 'Editar Perfil')

@section('content')

<div class="row">
    <form action="{{route('usuarios.alterar')}}" method="POST">
        @csrf
        <div class="col-5">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}">
            </div>
        </div>

        <div class="col-5">
            <div class="mb-3">
                <label for="email" class="form-label">Endereço Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}">
            </div>
        </div>

        <div class="col">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>

    </form>
</div>

@endsection