@extends('layouts.body-admin')

@section('body-admin')
  <div class="page-content">

      <div class="row">
          <div class="col-lg-12 col-xs-12 col-sm-12">
              <div class="portlet light bordered">
                @if ($errors->hasBag('user_error'))
                      <div class="alert alert-danger" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <ul>
                            <p><b>Atenção!</b></p>
                              @foreach ($errors->getBag('user_error')->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                  @if (session('user_success'))
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          {{ session('user_success') }}
                      </div>
                  @endif

                  <div class="portlet-title">
                      <div class="caption">
                          <span class="caption-subject bold uppercase font-dark">Usuários</span>
                          <span class="caption-helper">Lista de usuários</span>
                      </div>
                      <div class="actions">
                          <a href="{{ url('/user/create') }}" class="btn default blue btn-outline btn-sm">
                              <i class="fa fa-plus"></i> Adicionar Usuário
                          </a>
                      </div>
                  </div>
                  <div class="portlet-body">
                    <table class="table table-stripped">
                      <thead>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th></th>
                      </thead>
                      <tbody>
                        @foreach ($user as $key => $u)
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                              <a href="{{ route('user.edit', [$u->id]) }}" class="text-primary">
                                <i class="fa fa-edit"></i>
                              </a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{ $user->links() }}
                  </div>
              </div>
          </div>
      </div>
      <!-- END PAGE BASE CONTENT -->
  </div>
@endsection
