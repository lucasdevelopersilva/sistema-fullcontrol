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
                            <h2 class="cardtitle" >{{ $item->title }}</h2>
                            <p>{{ $item->description }} <i>{{ $item->created_at }}</i></p>
                        </div>
                        <div class="card-footer">
                            <a href="{{route("recados.delete",['id'=>$item->id])}}" class="btn btn-sm btn-danger" title="remover"><i class="fa fa-trash"></i></a> 
                        </div>
                    </div>
                </div>
                @endforeach
                  @else
                <div class=' col-12'>
                     <div class='alert alert-info'>
                        Não existe recados cadastrada
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