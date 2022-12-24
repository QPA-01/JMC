@extends('layouts.app')

@section('template_title')
update password
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header  text-white" style="background-color: #FF8000;">
                    <span class="card-title">Cambiar contraseña</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('update_password_form') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        @include('user.update_password_form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection