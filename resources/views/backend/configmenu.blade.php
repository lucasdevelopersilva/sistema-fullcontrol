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
            <form action="{{route("config.menu.update")}}" method="POST"  enctype="multipart/form-data"> 
                <div class="row">
                    <div class="col-sm-12">
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        @endif
                    </div>                   
                 
                        @csrf
                        <div class="form-group col-sm-3"> 
                            <label>Site</label>
                            <input type="checkbox" name="site"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->site==1 ? 'checked' : ''}}>
                        </div>
                        <div class="form-group col-sm-3"> 
                            <label>WebTV</label>
                            <input type="checkbox" name="webtv"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->webtv==1 ? 'checked' : ''}}>
                        </div>
                        <div class="form-group col-sm-3"> 
                            <label>Rádio</label>
                            <input type="checkbox" name="radio"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->radio==1 ? 'checked' : ''}}>
                        </div>
                        <div class="form-group col-sm-3"> 
                            <label>Facebook</label>
                            <input type="checkbox" name="facebook"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->facebook==1 ? 'checked' : ''}}>
                        </div>
                        <div class="form-group col-sm-3"> 
                            <label>Instagram</label>
                            <input type="checkbox" name="instagram"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->instagram==1 ? 'checked' : ''}}>
                        </div>
                        <div class="form-group col-sm-3"> 
                            <label>Twitter</label>
                            <input type="checkbox" name="twitter"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->twitter==1 ? 'checked' : ''}}>
                        </div>
                        <div class="form-group col-sm-3"> 
                            <label>Whatsapp</label>
                            <input type="checkbox" name="whatsapp"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->whatsapp==1 ? 'checked' : ''}}>
                        </div>
                        <div class="form-group col-sm-3"> 
                            <label>Promoção</label>
                            <input type="checkbox" name="promotion"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->promotion==1 ? 'checked' : ''}}>
                        </div>
                        <div class="form-group col-sm-3"> 
                            <label>Notícia</label>
                            <input type="checkbox" name="notice"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->notice==1 ? 'checked' : ''}}>
                        </div>
                        <div class="form-group col-sm-3"> 
                            <label>Equipe</label>
                            <input type="checkbox" name="team"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->team==1 ? 'checked' : ''}}>
                        </div>
                        <div class="form-group col-sm-3"> 
                            <label>Programação</label>
                            <input type="checkbox" name="programation"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->programation==1 ? 'checked' : ''}}>
                        </div>
                        <div class="form-group col-sm-3"> 
                            <label>Mural</label>
                            <input type="checkbox" name="mural"  data-bootstrap-switch data-off-color="danger" data-on-color="success" {{ $edit->mural==1 ? 'checked' : ''}}>
                        </div>
                        



                        <div class="form-group col-sm-12">
                            <button class="btn btn-primary btn-block"  >Salvar</button>   
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