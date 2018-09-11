@extends('layouts.body-admin')

@section('body-admin')
    <div class="page-content list-categories">
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <div class="portlet light bordered">
                    @if ($errors->hasBag('categories_error'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <ul>
                            <p><b>Atenção!</b></p>
                            @foreach ($errors->getBag('categories_error')->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif @if (session('categories_success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> {{ session('categories_success') }}
                    </div>
                    @endif
    
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark">Categorias</span>
                            <span class="caption-helper">Lista de Categorias</span>
                        </div>
                        <div class="actions">
                            <a href="{{ url('/categories/create') }}" class="btn default blue btn-outline btn-sm">
                                  <i class="fa fa-plus"></i> Adicionar Categorias
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
                                @foreach ($categories as $key => $c)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $c->id) }}" class="btn btn-info">
                                            Editar
                                        </a>
                                        <a href="{{ route('categories.confirm', [$c, 'categories']) }}" class="btn red">
                                            Excluir Registro
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
@endsection
