@extends('admin.layouts')
@section('konten')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Form elements </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Forms</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form elements</li>
                    </ol>
                </nav>
            </div>
            <div class="row">

                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            {{-- include pesan --}}
                            @include('admin/pesan')
                            <h4 class="card-title">Details Penduduk</h4>
{{-- jangan lupa selalu tambahakan csrf dibawah form --}}
                            <form class="forms-sample" method="POST" action="/data" enctype="multipart/form-data">
                                @csrf
                                {{-- gapake (id) karena primary key dan otomatis diisi oleh sistem(increasment) --}}
                                {{-- <div class="form-group row">
                                    <label for="id" class="col-sm-3 col-form-label">ID</label>
                                    <div class="col-sm-9"> --}}

                                {{-- jangan lupa kasis properti name="nama kolom" --}}
                                {{-- session untuk menaplikan data yang udah diinputin di controller --}}
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="col-sm-3 col-form-label" name="nama" id="deskripsi"
                                            value="{{ Session::get('nama') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3 col-form-label">No Telp</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="col-sm-3 col-form-label" name="phone" id="phone"
                                            value="{{ Session::get('phone') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="col-sm-3 col-form-label" name="alamat" id="alamat"
                                            value="{{ Session::get('alamat') }}">
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="foto" id="foto" class="col-sm-3 col-form-label">

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Tambah</button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                        bootstrapdash.com 2020</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                            href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                            templates</a> from Bootstrapdash.com</span>
                </div>
            </footer>
            <!-- partial -->
        </div>
    @endsection
