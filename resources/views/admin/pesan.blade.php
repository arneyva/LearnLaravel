{{-- untuk Request --}}
{{-- pake bawaane laravel dan bootstarp --}}
{{-- variabel dah ditentukan oleh sistem($errors) --}}
{{-- ($pesan) => bebas diganti apa saja --}}
{{-- pesan default pake bahasa inggris --}}
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $pesan)
            <li>{{ $pesan }}</li>
        @endforeach

    </div>

@endif

{{--  --}}
{{-- dengan menampilkan pesan jika berhasil melakukan aksi di controller--}}
@if (Session::get('pesan'))
    <div class="alert alert-danger" >
        {{ Session::get('pesan') }}
    </div>
@endif
