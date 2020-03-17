@extends('layout.app')
@section('title', 'Examenes')
@section('content')


    <div class="container">
     <div class="panel panel-default">
         <div class="panel-heading">Menu</div><br>
  <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <p>HELOOOOOOOOOO!!!!!!!</p>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    
        </div>
    </div>


@endsection
