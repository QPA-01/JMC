@extends('layouts.app')

@section('template_title')
Update Category Equipment
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">Editar categoría de equipo</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('category_equipment.update', $categoryEquipment->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('category-equipment.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection