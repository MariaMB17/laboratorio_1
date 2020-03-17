@extends('layout.app')
@section('title', 'Examenes')
@section('content')


    <div class="container">
     <div class="panel panel-default">
         <div class="panel-heading">Examenes</div><br>
  <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('examen.create') }}">Registrar examen</a><br>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr style="text-align:center;">
            <th style="text-align:center;">Código Examen</th>
            <th style="text-align:center;">Descripción</th>
            <th style="text-align:center;">Valor de referencia</th>
            <th style="text-align:center;">Subgrupo</th>
            <th style="text-align:center;">Precio</th>
            <th style="text-align:center;">Action</th>
        </tr>
    @foreach($subgrupos as $subgrup)
    <tr>
        <td style="text-align:center;">{{$subgrup->idexamen}}</td>
        <td style="text-align:center;">{{$subgrup->decripcion}}</td>
        <td style="text-align:center;">{{$subgrup->valor_referencia}}</td>
        <td style="text-align:center;">{{$subgrup->descripcion_sg}}</td>
        <td style="text-align:center;">{{$subgrup->precio}}</td>
        <td style="text-align:center;">
            
            <a class="btn btn-primary" href="./examen/{{$subgrup->idexamen}}/{{$subgrup->idgrupo}}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['examen.destroy', $subgrup->idexamen],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
        </div>
    </div>


@endsection
