@extends('layouts.body-admin')

@section('body-admin')
    <div class="page-content">

        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <form id="delete-form" action="{{route('products.destroy', [$product])}}" method="POST">
            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">
                    <div class="show" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmando a exclusão desse registro</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                                </div>
                                <div class="modal-body">
                                    <p>Realmente tenho certeza que desejo excluir o registro {{ $product->name }}.</p>
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                </div>
                                <div class="modal-footer">
                                    <a href="{{route('products.destroy', [$product])}}" class="btn btn-primary">Não tenho certeza</a>
                                    <button type="submit" class="btn red">Sim tenho certeza</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
@endsection