@extends('templates.base')
@section('title', 'Perfil')
@section('h1', 'Perfil')

@section('content')

<div class="row">
    <div class="col">
        <p>Nome: {{Auth::user()->name}}</p>
    </div>
</div>

<div class="row">
    <div class="col">
        <p>Usuário: {{Auth::user()->username}}</p>
    </div>
</div>

<div class="row">
    <div class="col">
        <p>Email: {{Auth::user()->email}}</p>
    </div>
</div>

@if(Auth::user()->admin)
    <div class="row">
        <div class="col">
            <div class="alert alert-danger">Perigo!!!!!!!!! Você é um <b>admin</b></div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a role="button" href="{{route('usuarios.editar')}}" type="button" class="btn btn-success">Editar</a>
            <a role="button" href="{{route('usuarios.senha')}}" type="button" class="btn btn-warning">Alterar Senha</a>
        </div>
    </div>
</div>

@endsection