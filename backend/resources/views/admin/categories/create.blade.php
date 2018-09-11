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
                            <span class="caption-subject bold uppercase font-dark">Categorias</span>
                            <span class="caption-helper">Adicionando uma nova Categorias</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        @if ($errors->hasBag('categories_update_error'))
                          <div class="alert alert-danger" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <ul>
                                  @foreach ($errors->getBag('categories_update_error')->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                        @endif @if (session('categories_success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> 
                            {{ session('categories_success') }}
                        </div>
                        @endif
                        <form role="form" method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nome da Categoria</label>
                                            <input type="text" class="form-control" name="name" id="name">
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="file" accept="image/*"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions text-right">
                                <button type="button" class="btn red"><i class="fa fa-trash-o"></i> Excluir </button>
                                <button type="submit" class="btn blue"><i class="fa fa-save"></i> Salvar</button>
                                <a href="{{url('categories')}}" type="reset" class="btn default">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
@endsection