@extends('layouts.app')

@section('template_title')
Loan Detail
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header  text-white" style="background-color: #FF8000;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Loan Detail') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('generate_loan') }}" sryl class="btn btn-dark float-right text-white" style="background-color:  #800080 ;" data-placement="left">
                                {{ __('Crear prestamo') }}
                            </a>
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
                                    <th>Equipo</th>
                                    <th>Cantidad</th>
                                    <th>User</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loanDetails as $loanDetail)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $loanDetail->uuid }}</td>
                                    <td>{{ $loanDetail->equipament_id }}</td>
                                    <td>{{ $loanDetail->description }}</td>
                                    <td>{{ $loanDetail->quantity }}</td>
                                    <td>{{ $loanDetail->user_loan_id }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $loanDetails->links() !!}
        </div>
    </div>
</div>
@endsection