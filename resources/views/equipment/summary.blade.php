@extends('layouts.app')

@section('template_title')
Equipment
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header  text-white" style="background-color: #FF8000;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Disponibilidad de equipos') }}
                        </span>

                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipments_data as $equipment)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $equipment['name'] }}</td>
                                    <td>{{ $equipment['quantity'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection