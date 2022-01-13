@extends('layout.backend')
@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
                <a href="{{route("promocao.index")}}" class="btn btn-sm btn-primary" title="Lista"><i class="fa fa-list"></i> LISTA</a>
                <a href="{{route("promocao.create")}}" class="btn btn-sm btn-primary" title="Nova"><i class="fa fa-plus"></i> NOVA</a>

                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route("promocao.update",['id'=>$edit->id])}}" method="POST"  enctype="multipart/form-data"> 
                <div class="row">
                    <div class="col-sm-12">
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                    </div>
                    <div class="col-sm-4"><!-- comment -->
                        @if($edit->cover)
                        <div class="views-logo">
                            <img src="{{ $edit->cover }}" class="img-fluid " rel="file"  />
                        </div>
                        @endif
                        <hr>
                        <div class="input-image ">
                            <label><i class="fa fa-image"></i> Imagem de Capa</label>
                            <input name="cover" type="file" accept="image/*"   placeholder="imagem"/> 
                        </div> 
                        <hr> 
                        <div class="form-group">
                            <button class="btn btn-primary btn-block"  >Salvar</button>   
                        </div>
                    </div>
                    <div class="col-sm-8">

                        @csrf
                        <div class="form-group"><!-- comment -->
                            <label>Título</label>
                            <input class="form-control" name="title" placeholder="Título da promoção" value="{{ $edit->title }}">
                        </div>
                        <div class="form-group"><!-- comment -->
                            <label>Data do sorteio</label>
                            <input class="form-control" type="date" name="data" placeholder="" value="{{ $edit->data }}">
                        </div>
                        <div class="form-group "><!-- comment -->
                            <label>Descrição</label>
                            <textarea class="form-control ckeditor" name="description"   >{{ $edit->description }}</textarea>
                        </div>
                        <div class="form-group"><!-- comment -->
                            <label>Status</label>
                            <input type="checkbox" name="status"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->status==1 ? 'checked' : ''}}>
                        </div>  
                    </div>
                    <div class="col-sm-12">
                        <h2>Participantes</h2>
                        <table class="table table-bordered table-dark">
                            <thead>
                                <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>E-MAIL</th>
                            <th>CPF</th>
                            <th>NASCIMENTO</th>
                            <th>TELEFONE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($participantes as $item) 
                                <tr>
                            <th>{{$item->id}}</th>
                            <th>{{$item->name}}</th>
                            <th>{{$item->email}}</th>
                            <th>{{$item->cpf}}</th>
                            <th>{{$item->nascimento}}</th>
                            <th>{{$item->phone}}</th>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
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