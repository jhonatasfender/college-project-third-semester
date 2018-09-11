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
                            <span class="caption-subject bold uppercase font-dark">Usuário</span>
                            <span class="caption-helper">Editar Usuário</span>
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
                        @endif @if (session('registered_success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button> 
                            {{ session('registered_success') }}
                        </div>
                        @endif
                        <form role="form" method="POST" action="{{ route('registered.update', [$registered->id]) }}" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nome do Usuário</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $registered->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ $registered->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Senha</label>
                                            <input type="password" class="form-control" name="password" id="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Confirmar Senha</label>
                                            <input type="password_confirmation" class="form-control" name="password_confirmation" id="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Endereço</label>
                                            <input type="text" class="form-control" name="address" id="address" value="{{ $registered->address }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions text-right">
                                <a href="{{ route('registered.confirm', [$registered]) }}" class="btn red">Excluir Registro</a>
                                <button type="submit" class="btn blue"><i class="fa fa-save"></i> Salvar</button>
                                <a href="{{url('registered')}}" type="reset" class="btn default">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>
@endsection