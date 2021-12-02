@extends('layout.backend')
@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
                <a href="{{route("users.index")}}" class="btn btn-sm btn-primary" title="Lista"><i class="fa fa-list"></i> LISTA</a>
                <a href="{{route("users.create")}}" class="btn btn-sm btn-primary" title="Nova"><i class="fa fa-plus"></i> NOVA</a>

                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route("users.update",['id'=>$edit->id])}}" method="POST"  enctype="multipart/form-data"> 
                <div class="row">
                    <div class="col-sm-12">
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                    </div>                   
                    <div class="col-sm-12">

                        @csrf
                        <div class="form-group"><!-- comment -->
                            <label>Nome</label>
                            <input class="form-control" name="name" placeholder="Nome" value="{{ $edit->name }}">
                        </div>
                        <div class="form-group"><!-- comment -->
                            <label>E-mail</label>
                            <input class="form-control" type="email" name="email" placeholder="E-mail" value="{{ $edit->email }}">
                        </div>
                        <div class="form-group"><!-- comment -->
                            <label>Senha</label>
                            <input class="form-control" name="password" placeholder="Senha de acesso" value="">
                        </div>                    
                        <div class="form-group"><!-- comment -->
                            <label>Cidade</label>
                            <input class="form-control"   name="city"  value="{{ $edit->city }}">
                        </div>                    
                        <div class="form-group"><!-- comment -->
                            <label>Estado</label>
                            <input class="form-control"   name="state"  value="{{ $edit->state }}">
                        </div>                    
                        <div class="form-group"><!-- comment -->
                            <label>Status</label>
                            <input type="checkbox" name="status"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->status==1 ? 'checked' : ''}}>
                        </div> 
                         <div class="form-group">
                            <button class="btn btn-primary btn-block"  >Salvar</button>   
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>

@endsection