@extends('layout.backend')
@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools"> 
                <a href="{{route("users.create")}}" class="btn btn-sm btn-primary" title="Nova"><i class="fa fa-plus"></i> NOVA</a>

                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
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
                                <li class="list-group-item">{{ $item->status }}</li>
                                <li class="list-group-item">{{ $item->created_at }}</li>
                            </ul>
                        <div class="card-footer">
                            <a href="{{route("users.delete",['id'=>$item->id])}}" class="btn btn-sm btn-danger" title="remover"><i class="fa fa-trash"></i></a>
                            <a href="{{route("users.save",['id'=>$item->id])}}" class="btn btn-sm btn-primary" title="Editar"><i class="far fa-edit"></i></a>
                            <a href="{{route("users.loginid",['id'=>$item->id])}}" class="btn btn-sm btn-primary" title="Login"><i class="fa fa-lock-open"></i> Acessar</a>
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
           
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
@endsection