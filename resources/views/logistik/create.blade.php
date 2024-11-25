@extends('layout.app')

@section('content')
    <div class="row">
        <form action="{{ route('logistik.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail" class="form-label fw-bold">Nama Barang</label>
                <input type="text" name="nama" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="inputNama" class="form-label fw-bold">Deskripsi Barang</label>
                <input type="text" name="deskripsi" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="inputNama" class="form-label fw-bold">Foto</label>
                <input type="file" name="foto" class="form-control" id="exampleInputPassword1">
            </div>

            <button class="btn btn-success px-4" type="submit" name="submit">Submit</button>
        </form>
    </div>
@endsection