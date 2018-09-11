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
                            <span class="caption-helper">Editar Produtos</span>
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
                        <form role="form" method="POST" action="{{ route('products.update', [$product]) }}" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nome do Produto</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Preço do Produto</label>
                                            <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" name="price" id="price" value="{{ $product->price }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Categoria do Produto</label>
                                            <select name="categories" class="form-control">
                                                <option value="">Selecione uma das opções</option>
                                                @forelse ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? "selected" : "" }}>{{ $category->name }}</option>
                                                @empty
                                                    <option value="">Nenhuma categoria cadastrada</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Data de expiração</label>
                                            <input type="text" class="form-control expiration-date" name="expiration_date" id="expiration_date" value="{{ date('d/m/Y', strtotime($product->expiration_date)) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="description" id="description" class="form-control" rows="{{ strlen($product->description) / 50 }}">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="file[]" accept="image/*" multiple>
                                        </div>
                                        <div class="form-group" id="list-image">
                                            <table class="table">
                                                @forelse ($product->images as $img)
                                                    <tr>
                                                        <td><img src="{{ url("/storage/app/public/image/w_80,h_80/" . $img->file) }}" alt=""></td>
                                                        <td>
                                                            <a href="{{ route('products.distroyImage', [$img, $product]) }}" class="btn red">Excluir Imagem</a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <option value="">Nenhuma Imagem desse produto encontrado</option>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions text-right">
                                <a href="{{ route('products.confirm', [$product]) }}" class="btn red">Excluir Registro</a>
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