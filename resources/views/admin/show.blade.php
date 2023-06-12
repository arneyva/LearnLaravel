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
              <h4 class="card-title">Details Data Penduduk</h4>
              
              <form class="forms-sample">
                <div class="form-group row">
                  <label for="id" class="col-sm-3 col-form-label">ID</label>
                  <div class="col-sm-9">
                    {{-- disabled artinya gabisa diubah2 --}}
                    <input type="text" class="col-sm-3 col-form-label"  value="{{$variabelview->id}}" disabled> 
                  </div>
                </div>
                <div class="form-group row">
                  <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Nama</label>
                  <div class="col-sm-9">
                    <input type="text" class="col-sm-3 col-form-label"  disabled value="{{$variabelview->nama}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="exampleInputMobile" class="col-sm-3 col-form-label">No Telp</label>
                  <div class="col-sm-9">
                    <input type="text" class="col-sm-3 col-form-label"  disabled value="{{$variabelview->phone}}">
                  </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                      <input type="text" class="col-sm-3 col-form-label"  disabled value="{{$variabelview->alamat}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Foto</label>
                    <div class="col-sm-9">
                        <img style="max-height: 200px;max-width: 250px"
                                src="{{ url('featured_image') . '/' . $variabelview->foto }}" alt="">
                    </div>
                </div>
                <a href="{{ url('/data') }}" type="submit" class="btn btn-primary mr-2">Back</a>
              </form>
            </div>
          </div>
        </div>
        
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
      </div>
    </footer>
    <!-- partial -->
  </div>
@endsection