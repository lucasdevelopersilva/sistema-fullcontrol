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
            <form action="{{route("config.update")}}" method="POST"  enctype="multipart/form-data"> 
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
                            <label>Nome da Rádio</label>
                            <input class="form-control" name="title" placeholder="Nome" value="{{ $edit->title }}">
                        </div>
                       
                        <div class="form-group"><!-- comment -->
                            <label>Site</label>
                            <input class="form-control" name="site" value="{{ $edit->site }}">
                        </div>                    
                        <div class="form-group"><!-- comment -->
                            <label>facebook</label>
                            <input class="form-control"   name="facebook"  value="{{ $edit->facebook }}">
                        </div>                    
                        <div class="form-group"><!-- comment -->
                            <label>Instagram</label>
                            <input class="form-control"   name="instagram"  value="{{ $edit->instagram }}">
                        </div>                    
                        <div class="form-group"><!-- comment -->
                            <label>Twitter</label>
                            <input class="form-control"   name="twitter"  value="{{ $edit->twitter }}">
                        </div>                    
                        <div class="form-group"><!-- comment -->
                            <label>Whatsapp</label>
                            <input class="form-control"   name="whatsapp"  value="{{ $edit->whatsapp }}">
                        </div>                    
                        <div class="form-group"><!-- comment -->
                            <label>Link WebTv</label>
                            <input class="form-control"   name="webtv"  value="{{ $edit->webtv }}">
                        </div>                    
                        <div class="form-group"><!-- comment -->
                            <label>Link da rádio</label>
                            <input class="form-control"   name="stream"  value="{{ $edit->stream }}">
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