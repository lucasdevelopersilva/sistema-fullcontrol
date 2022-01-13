@extends('layout.backend')
@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if($config)
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{$config->logotipo}}"
                                     alt="{{ $user->name }}">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>

                            <p class="text-muted text-center">{{$user->email}}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Cidade</b> <a class="float-right">{{ $user->city }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Estado</b> <a class="float-right">{{ $user->state }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Data de cadastro</b> <a class="float-right">{{ $user->created_at }}</a>
                                </li>
                            </ul>

                            <a href="{{route('radio.save')}}" class="btn btn-primary btn-block"><b>Alterar</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-sm-8 ">
                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informações</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fa fa-rss"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Notícias</span>
                                            <span class="info-box-number">{{$count_noticia}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Promoções</span>
                                            <span class="info-box-number">{{$count_promocao}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="fa fa-paste"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Programas</span>
                                            <span class="info-box-number">{{$count_programa}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-danger"><i class="far fa-comment"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Recados</span>
                                            <span class="info-box-number">{{$count_mural}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Equipe</span>
                                            <span class="info-box-number">{{$count_team}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>

    <!-- /.card -->

</section>
@endsection