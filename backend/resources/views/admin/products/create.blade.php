@extends('layouts.body-admin')

@section('body-admin')
    <div class="page-content">

        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
    
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark">Produtos</span>
                            <span class="caption-helper">Adicionando uma nova Produtos</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        @if ($errors->hasBag())
                          <div class="alert alert-danger" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <ul>
                                  @foreach ($errors->getBag('default')->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                        @endif @if (session('products_success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> 
                            {{ session('products_success') }}
                        </div>
                        @endif
                        <form role="form" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nome do Produto</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Preço do Produto</label>
                                            <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="price" id="price" value="{{ old('price') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Categoria do Produto</label>
                                            <select name="categories" class="form-control">
                                                <option value="">Selecione uma das opções</option>
                                                @forelse ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old("categories") == $category->id ? "selected" : "" }}>{{ $category->name }}</option>
                                                @empty
                                                    <option value="">Nenhuma categoria cadastrada</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Data de expiração</label>
                                            <input type="text" class="form-control expiration-date" name="expiration_date" id="expiration_date" value="{{ old('expiration_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions text-right">
                                <button type="button" class="btn red"><i class="fa fa-trash-o"></i> Excluir </button>
                                <button type="submit" class="btn blue"><i class="fa fa-save"></i> Salvar</button>
                                <a href="{{url('products')}}" type="reset" class="btn default">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
@endsection