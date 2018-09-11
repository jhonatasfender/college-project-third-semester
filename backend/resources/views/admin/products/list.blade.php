@extends('layouts.body-admin')

@section('body-admin')
    <div class="page-content list-products">
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <div class="portlet light bordered">
                    @if ($errors->hasBag('products_error'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <ul>
                            <p><b>Atenção!</b></p>
                            @foreach ($errors->getBag('products_error')->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif @if (session('products_success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> {{ session('products_success') }}
                    </div>
                    @endif
    
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark">Categorias</span>
                            <span class="caption-helper">Lista de Categorias</span>
                        </div>
                        <div class="actions">
                            <a href="{{ url('/products/create') }}" class="btn default blue btn-outline btn-sm">
                                  <i class="fa fa-plus"></i> Adicionar Produtos
                              </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-stripped">
                            <thead>
                                <th>#</th>
                                <th>Nome</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">
                                            Editar
                                        </a>
                                        <a href="{{ route('products.confirm', [$product, 'products']) }}" class="btn red">
                                            Excluir Registro
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
@endsection
