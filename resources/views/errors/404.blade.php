@extends('layouts.app')

@section('title','pagina no encontrada.')

@section('content')
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTtVYsiDUJbqTXmh07ljOAPchtTiC2YznX-Hw&usqp=CAU" class="rounded mx-auto d-block img-fluid" alt="Responsive image">
<br>
<div class="col-12 text-center">
    <a class="btn  btn-secondary " href="{{ route('home') }}"><i class="fa fa-fw fa-eye"></i> Regresar</a>
</div>

@endsection