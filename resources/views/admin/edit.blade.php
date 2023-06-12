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
                        @include('admin/pesan')
                        <div class="card-body">
                            <h4 class="card-title">Edit Data Penduduk</h4>
                            {{-- methode post agar data tidak tertampil di url --}}
                            {{-- enctype="multipart/form-data" => Kebutuhan Foto --}}
                            <form class="forms-sample" method="POST" action="{{ '/data/' . $variabelview->id }}" enctype="multipart/form-data">
                                {{-- jangan lupa selalu tambahakan csrf dibawah form --}}
                                @csrf
                                {{-- @method('put') permintaan fungsi update (menyimpan data baru)  --}}
                                @method('put')
                                <div class="form-group row">
                                    <label for="id" class="col-sm-3 col-form-label">ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="col-sm-3 col-form-label" disabled
                                        {{-- artinya ketika berada di page edit =>sudah ada data lama kaya yang di show --}}
                                            value="{{ $variabelview->id }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="col-sm-3 col-form-label" name="nama"
                                            value="{{ $variabelview->nama }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">No Telp</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="col-sm-3 col-form-label" name="phone"
                                            value="{{ $variabelview->phone }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="col-sm-3 col-form-label" name="alamat"
                                            value="{{ $variabelview->alamat }}">
                                    </div>
                                </div>
                                {{-- cek dulu ada fotone tidak,kalo tidak ya gapapa--}}
                                @if ($variabelview->foto)
                                <div class="form-group row">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Foto</label>
                                    <div class="col-sm-9">
                                        <img style="max-height: 200px;max-width: 250px"
                                                src="{{ url('featured_image') . '/' . $variabelview->foto }}" alt="">
                                    </div>
                                </div>
                                @endif
                                <div class="form-group  row">
                                    <label for="foto" class="col-sm-3 col-form-label"> Ganti Foto</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="foto" id="foto" class="col-sm-3 col-form-label">

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                                <a href="{{ url('/data') }}" type="submit" class="btn btn-primary mr-2">Back</a>
                                {{-- <a href="{{ url('/data') }}" type="submit" class="btn btn-info mr-2">Update</a> --}}
                                {{-- <button class="btn btn-dark">Cancel</button> --}}
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
