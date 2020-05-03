@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{--v<div class="card">
                <div class="card-header">Titulo</div>

                <div class="card-body">
                   Conteudo
                </div>
            </div> --}}
            <form-contato></form-contato>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <table-contato></table-contato>
        </div>
    </div>
@endsection
