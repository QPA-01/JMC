@extends('layouts.app')

@section('title','error.')

@section('content')
<div class="alert alert-warning">{{$error}}</div>
<br>
<div class="col-12 text-center">
    <a class="btn  btn-secondary " href="{{ route($route.'.index') }}"><i class="fa fa-fw fa-eye"></i> Regresar</a>
</div>

@endsection