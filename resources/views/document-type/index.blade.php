@extends('layouts.app')

@section('template_title')
tipo de documento
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-white" style="background-color: #FF8000;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Tipo de documento') }}
                        </span>

                        <div class="float-right">
                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                            <a href="{{ route('document_type.create') }}" sryl class="btn btn-dark float-right text-white" style="background-color:  #800080 ;" data-placement="left">
                                {{ __('Crear') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Uuid</th>
                                    <th>Nombre</th>
                                    <th>Abreviatura</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documentTypes as $documentType)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $documentType->uuid }}</td>
                                    <td>{{ $documentType->name }}</td>
                                    <td>{{ $documentType->abbreviation }}</td>

                                    <td>
                                        <form action="{{ route('document_type.destroy',$documentType->uuid) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('document_type.show',$documentType->uuid) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                                            <a class="btn btn-sm btn-success" href="{{ route('document_type.edit',$documentType->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $documentTypes->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection