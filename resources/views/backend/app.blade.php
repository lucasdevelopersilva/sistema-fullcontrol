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
                <div class="col-sm-12">
                    @if($list->fileapp) 
                    Seu aplicativo já foi criado na versão <b>{{$list->version}}</b>, Faça o download do seu aplicativo.
                    <a class="btn btn-primary btn-sm" target="_blank" href='{{route('app.download')}}'>BAIXAR APP</a>
               
                    @endif 
                </div>
                <div class="col-sm-12"><!-- comment -->
                    <form action="{{route("app.gerarApk")}}" method="POST"  enctype="multipart/form-data"> 
                       @csrf
                        <div class="form-group">
                            <label>Tipo de arquivo gerado </label>
                            <select name="type" class="form-control"  >  
                                <option value="apk">Apk </option>                              
                                <option value="aab">Aab </option>                              
                            </select> 
                        </div>
                        <div class="form-group">
                           
                            <label>Versão </label>
                            <select name="version" class="form-control"   > 
                                @for($x=1; $x<=10; $x++) 
                                @for($y=0; $y<=9; $y++) 
                                <option value="{{ $x }}.{{$y}}">{{ $x }}.{{$y}}</option>
                                @endfor
                                @endfor
                            </select> 
                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary btn-block" >Gerar</button>    
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