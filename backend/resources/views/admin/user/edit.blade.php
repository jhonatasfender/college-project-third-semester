@extends('layouts.app')
<link href="{{asset('assets/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css" />
@section('content')
  <div class="page-content">
      <!-- BEGIN PAGE BASE CONTENT -->
      <div class="row">
          <div class="col-md-12">
              <!-- BEGIN PROFILE CONTENT -->
              <div class="profile-content">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="portlet light profile-sidebar-portlet bordered">
                          <div class="profile-userpic">
                              <img src="{{$usuario->getPhoto()}}" class="img-responsive" alt="" style="width:149px;height:149px">
                          </div>
                          <div class="profile-usertitle">
                              <div class="profile-usertitle-name">
                                {{$usuario->nome}}
                              </div>
                          </div>
                      </div>
                    </div>

                      <div class="col-md-9">
                          <div class="portlet light bordered">
                              <div class="portlet-title tabbable-line">
                                  <div class="caption caption-md">
                                      <i class="icon-globe theme-font hide"></i>
                                      <span class="caption-subject font-blue-madison bold uppercase">Dados do Usuário</span>
                                  </div>
                                  <ul class="nav nav-tabs">
                                      <li class="active">
                                          <a href="#edit-profile" data-toggle="tab">Informações</a>
                                      </li>
                                      <li>
                                          <a href="#edit-photo" data-toggle="tab">Alterar imagem</a>
                                      </li>
                                      <li>
                                          <a href="#edit-pass" data-toggle="tab">Alterar senha</a>
                                      </li>
                                      {{-- <li>
                                          <a href="#tab_1_4" data-toggle="tab">Configurações de privacidade</a>
                                      </li> --}}
                                  </ul>
                              </div>
                              <div class="portlet-body">
                                  <div class="tab-content">
                                      <!-- PERSONAL INFO TAB -->
                                      <div class="tab-pane active" id="edit-profile">
                                        @if ($errors->hasBag('usuario_error'))
                                              <div class="alert alert-danger" role="alert">
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  <ul>
                                                      @foreach ($errors->getBag('usuario_error')->all() as $error)
                                                          <li>{{ $error }}</li>
                                                      @endforeach
                                                  </ul>
                                              </div>
                                          @endif
                                          @if (session('usuario_success'))
                                              <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  {{ session('usuario_success') }}
                                              </div>
                                          @endif
                                          <form method="post" action="{{route('usuarios.update', [$usuario->id])}}">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}

                                              <div class="form-group">
                                                  <label class="control-label">Nome</label>
                                                  <input type="text" placeholder="Digite seu nome" name="nome" class="form-control" value="{{$usuario->nome}}" />
                                              </div>
                                              <div class="form-group">
                                                  <label class="control-label">E-mail</label>
                                                  <input type="text" class="form-control" disabled value="{{$usuario->email}}"/>
                                              </div>
                                              <div class="form-group">
                                                  <label class="control-label">CPF</label>
                                                  <input type="text" class="form-control cpf" name="cpf" value="{{$usuario->cpf}}"/>
                                              </div>
                                              <div class="form-group">
                                                  <label class="control-label">Data de nascimento</label>
                                                  {{$usuario->data_nascimento}}
                                                  <input type="text"  class="form-control datepicker date" name="data_nascimento" value="{{$usuario->data_nascimento->format('d/m/Y')}}"/>
                                              </div>
                                              @if (Auth::user()->can('perfil.edit'))
                                                <div class="form-group">
                                                  <label class="control-label">Perfil</label>
                                                  <select class="form-control" name="perfil">
                                                    @foreach ($perfis as $key => $perfil)
                                                      @if($perfil->nome == "administrador" && Auth::user()->can('is-admin'))
                                                        <option value="{{$perfil->id}}"{{ $usuario->perfil->id == $perfil->id ? "selected" : ""}}>{{$perfil->label}}</option>
                                                        @else
                                                        <option value="{{$perfil->id}}"{{ $usuario->perfil->id == $perfil->id ? "selected" : ""}}>{{$perfil->label}}</option>
                                                      @endif
                                                    @endforeach
                                                  </select>
                                                </div>
                                              @else
                                                <div class="form-group">
                                                  <label class="control-label">Perfil</label>
                                                  <input type="text"  disabled class="form-control" name="" value="{{$usuario->perfil->label}}"/>
                                                </div>
                                              @endcan
                                              <div class="margiv-top-10 text-right">
                                                  @can ('usuarios.delete')
                                                    <button onclick="event.preventDefault(); if(confirm('Você tem certeza disso?')) document.getElementById('delete-form').submit();" type="button" class="btn red"><i class="fa fa-trash-o"></i> Excluir Usuário</button>
                                                  @endcan
                                                  <button type="submit" class="btn blue"><i class="fa fa-save"></i> Salvar</button>
                                                  <a href="{{url('/usuarios')}}" class="btn default"> Cancelar</a>
                                              </div>
                                          </form>
                                          @can ('usuarios.delete')
                                          <form id="delete-form" action="{{route('usuarios.destroy', [$usuario->id])}}" method="POST" style="display: none;">
                                              {{ csrf_field() }}
                                              {{ method_field('DELETE') }}
                                          </form>
                                        @endcan
                                      </div>
                                      <!-- END PERSONAL INFO TAB -->
                                      <!-- CHANGE AVATAR TAB -->
                                      <div class="tab-pane" id="edit-photo">
                                        @if ($errors->hasBag('usuario_photo_error'))
                                              <div class="alert alert-danger" role="alert">
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  <ul>
                                                      @foreach ($errors->getBag('usuario_photo_error')->all() as $error)
                                                          <li>{{ $error }}</li>
                                                      @endforeach
                                                  </ul>
                                              </div>
                                          @endif
                                          @if (session('usuario_photo_success'))
                                              <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  {{ session('usuario_photo_success') }}
                                              </div>
                                          @endif
                                          <form action="{{url('/usuarios/alterar-foto/'.$usuario->id)}}" method="POST" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                              <div class="form-group">
                                                  <div class="fileinput fileinput-new" data-provides="fileinput">
                                                      <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                          <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;" alt="" /> .
                                                      </div>
                                                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                      <div>
                                                          <span class="btn default btn-file btn-block">
                                                                <span class="fileinput-new"> Selecionar uma imagem </span>
                                                                <span class="fileinput-exists"> Alterar </span>
                                                                <input type="file" name="foto">
                                                          </span>
                                                          <a href="javascript:;" class="btn default btn-block fileinput-exists" data-dismiss="fileinput">
                                                            Remover
                                                          </a>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="margin-top-10 text-right">
                                                  <button type="submit" class="btn blue"><i class="fa fa-save"></i> Alterar imagem </button>
                                                  <button type="reset" class="btn default"> Cancelar </button>
                                              </div>
                                          </form>
                                      </div>
                                      <!-- END CHANGE AVATAR TAB -->
                                      <!-- CHANGE PASSWORD TAB -->
                                      <div class="tab-pane" id="edit-pass">
                                        @if ($errors->hasBag('usuario_password_error'))
                                              <div class="alert alert-danger" role="alert">
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  <ul>
                                                      @foreach ($errors->getBag('usuario_password_error')->all() as $error)
                                                          <li>{{ $error }}</li>
                                                      @endforeach
                                                  </ul>
                                              </div>
                                          @endif
                                          @if (session('usuario_password_success'))
                                              <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  {{ session('usuario_password_success') }}
                                              </div>
                                          @endif
                                          <form action="{{url('/usuarios/alterar-senha/'.$usuario->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}

                                              <div class="form-group">
                                                  <label class="control-label">Nova senha</label>
                                                  <input type="password" class="form-control" name="password"  value=""/>
                                              </div>
                                              <div class="form-group">
                                                  <label class="control-label">Confirmação da senha</label>
                                                  <input type="password" class="form-control" name="password_confirmation"  value=""/>
                                              </div>
                                              <div class="margin-top-10 text-right">
                                                  <button type="submit" class="btn blue"><i class="fa fa-save"></i> Alterar senha </button>
                                                  <button type="reset" class="btn default"> Cancelar </button>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- END PROFILE CONTENT -->
          </div>
      </div>
      <!-- END PAGE BASE CONTENT -->
  </div>
@endsection
@section('script')
<script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" charset="utf-8"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js')}}" charset="UTF-8"></script>
<script type="text/javascript">
  $('.datepicker').datepicker({
    language: 'pt-BR',
    autoclose: true,
    format: 'dd/mm/yyyy',
    orientation: 'auto top'
  });
</script>
@endsection
