@extends('layout.backend')
@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools"> 


                <form class="form-inline" method="POST" action="{{route("users.index")}}">
                    @csrf
                    <a href="{{route("users.create")}}" class="btn btn-sm btn-primary" title="Nova"><i class="fa fa-plus"></i> NOVA</a>&nbsp;
                    <input name="buscar"   class="form-control" type="search" placeholder="Buscar App" value="{{ $search }}">
                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
            </div>

            <div class="row">
                @if (count($list)>=1) 
                @foreach ($list as $item)

                <div class=' col-sm-6 col-md-4 col-lg-3 col'>
                    <div class='card'>                        
                        <div class="card-body">
                            <h2 class="cardtitle" >{{ $item->name }}</h2> 
                        </div>
                        <ul class="list-group-flush list-group">
                            <li class="list-group-item">{{ $item->email }}</li>
                            <li class="list-group-item">{{ $item->city }}</li>
                            <li class="list-group-item">{{ $item->state }}</li>
                            <li class="list-group-item">{{ ($item->status==1?"Ativo":"Desativado") }}</li>
                            <li class="list-group-item">{{ $item->created_at }}</li>
                        </ul>
                        <div class="card-footer">
                            <a href="#" class="btn btn-sm btn-danger" title="remover" data-toggle="modal" data-target="#modal-{{ $item->id }}"><i class="fa fa-trash"></i></a>
                            <a href="{{route("users.save",['id'=>$item->id])}}" class="btn btn-sm btn-primary" title="Editar"><i class="far fa-edit"></i></a>
                            <a href="{{route("users.loginid",['id'=>$item->id])}}" class="btn btn-sm btn-primary" title="Login"><i class="fa fa-lock-open"></i> Acessar</a>
                        </div>  
                          <div class="modal" tabindex="-1" role="dialog" id="modal-{{ $item->id }}" aria-labelledby="modal-{{ $item->id }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Apagar Rádio <b>{{ $item->name }}</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Tem certeza que deseja apagar essa rádio?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{route("users.delete",['id'=>$item->id])}}" class="btn  btn-success" title="remover">Confirmar</a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class=' col'>
                    <div class='alert alert-info'>
                        Não existe rádios cadastradas
                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{$list->links()}}
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>


@endsection