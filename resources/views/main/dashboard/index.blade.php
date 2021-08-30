@extends('masterdashboard')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Home</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if (session()->has('success'))
                    <div class="d-flex flex-column-fluid flex-center alert alert-success">
                        <ul>
                            <li>{{ session()->get('success') }}</li>
                            
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Info</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                                <div id="accordion">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100 collapsed" data-toggle="collapse"
                                                    href="#collapseOne" aria-expanded="false">
                                                    Click untuk lihat sistem anda
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                                            <div class="card-body">
                                                <a href="https://{{ Auth::user()->domain_name }}.penguindropship.com">
                                                    <p>https://{{ Auth::user()->domain_name }}.penguindropship.com</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar pengguna utama</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                                <div id="accordion">
                                    <div class="card card-primary">
                                        <form method="POST" action="{{ route('dashboard.registeruser') }}">
                                            @csrf
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="namapengguna" name="id"
                                                        value="{{ Auth::user()->id }}">
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            @if (Auth::user()->status == 'done')
                                                <div class="card-footer">
                                                    <a class="btn btn-secondary disabled">Pengguna telah dicipta</a>
                                                </div>
                                            @else
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">Cipta pengguna</button>
                                                </div>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
