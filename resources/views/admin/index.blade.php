{{--  @extends('admin.layouts') artinya kita pakai templater yang udah kita buat bernama layouts --}}
@extends('admin.layouts')

@section('konten')
    {{-- untuk mengecek apakah data beneran sudah nyambung atau belum --}}
    {{-- {{ json_encode($variabelview) }} --}}

    {{-- Main Section --}}
    <div class="main-panel">
        <div class="content-wrapper">
            {{--  --}}
            <div class="page-header">
                <h3 class="page-title"> Basic Tables </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Tables</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
                    </ol>
                </nav>
            </div>
            {{--  --}}
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @include('admin.pesan')
                          <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>No Telp</th>
                                        <th>Alamat</th>
                                        <th>Foto</th>
                                        <th>Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($variabelview as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td> 
                                                @if ($item->foto)
                                                <img style="max-width:100px,max-height:100px" src="{{ url('featured_image').'/'.$item->foto }}" alt="foto">
                                                    
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ url('/data/' . $item->id) }}" method="POST">
                                                    {{-- semua rute yang dibuat disesuaikan dengan yang ada di php route:list dan Kita sepakat menggunakan (id) sebagai parameternya --}}
                                                    {{-- buat route untuk detail(data/id) --}}
                                                    <a href="{{ url('/data/' . $item->id) }}"
                                                        class="badge badge-warning">Show</a>
                                                    
                                                    {{-- buat route untuk edit(data/id/edit) --}}
                                                    <a href="{{ url('/data/' . $item->id . '/edit') }}"
                                                        class="badge badge-success">Edit</a>

                                                    {{-- khusus untuk deleted --}}
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="badge badge-danger" type="submit"> DELETE</button>
                                                </form>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>

                </div>
                
            </div>
            {{-- Pagination --}}
            {{ $variabelview->links() }}
            {{--  --}}
        </div>
    </div>
@endsection
