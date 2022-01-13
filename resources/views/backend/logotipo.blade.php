@extends('layout.backend')
@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
               
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-sm-12">
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                </div>
                <div class="col-sm-6"><!-- comment -->
                    <form action="{{route("config.logotiposave")}}" method="POST"  enctype="multipart/form-data"> 
                        @if($edit->logotipo)
                        <div class="views-logo d-flex justify-content-center">
                            <img src="{{ $edit->logotipo }}" class="img-fluid " rel="file"  />
                        </div>
                        @endif
                         @csrf
                        <hr>
                        <div class="input-image ">
                            <label><i class="fa fa-image"></i> Logotipo</label>
                            <input name="cover" type="file" accept="image/*"   placeholder="imagem"/> 
                        </div> 
                        <hr> 
                        <div class="form-group">
                            <button class="btn btn-primary btn-block"  >Salvar</button>   
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <form action="{{route("config.iconesave")}}" method="POST"  enctype="multipart/form-data"> 
                        @if($edit->icone)
                        <div class="views-logo d-flex justify-content-center">
                            <img src="{{ $edit->icone }}" class="img-fluid " rel="file"  />
                        </div>
                        @endif
                         @csrf
                        <hr>
                        <div class="input-image ">
                            <label><i class="fa fa-image"></i> Icone</label>
                            <input name="cover" type="file" accept="image/*"   placeholder="imagem"/> 
                        </div> 
                        <hr> 
                        <div class="form-group">
                            <button class="btn btn-primary btn-block"  >Salvar</button>   
                        </div> 
                    </form>
                </div>
                <div class="col-sm-6">
                    <form action="{{route("config.backgroundsave")}}" method="POST"  enctype="multipart/form-data"> 
                        @if($edit->background)
                        <div class="views-logo d-flex justify-content-center">
                            <img src="{{ $edit->background }}" class="img-fluid " rel="file"  />
                        </div>
                        @endif
                         @csrf
                        <hr>
                        <div class="input-image ">
                            <label><i class="fa fa-image"></i> Background</label>
                            <input name="cover" type="file" accept="image/*"   placeholder="imagem"/> 
                        </div> 
                        <hr> 
                        <div class="form-group">
                            <button class="btn btn-primary btn-block"  >Salvar</button>   
                        </div> 
                    </form>
                </div>
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