@extends('templates.base')
@section('title', 'Perfil')
@section('h1', 'Perfil')

@section('content')

<div class="row">
    <form action="{{route('usuarios.password')}}" method="POST">
        @csrf
        <div class="col-5">
            <div class="mb-3">
                <label for="verifica" class="form-label">Digite a senha atual</label>
                <input type="password" class="form-control" id="verifica" name="verifica">
            </div>
        </div>

        <div class="col-5">
            <div class="mb-3">
                <label for="password" class="form-label">Nova Senha</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
        </div>

        <div class="col-5">
            <div class="mb-3">
                <label for="confirmaPassword" class="form-label">Confirmar Nova Senha</label>
                <input type="password" class="form-control" id="confirmaPassword" name="confirmaPassword">
            </div>
        </div>

        <div class="col">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>

    </form>
</div>

@endsection