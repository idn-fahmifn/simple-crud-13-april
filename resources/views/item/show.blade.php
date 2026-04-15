@extends('template.app')

@section('title')
    <div class="row">
        <div class="col-md-6">
            <div class="card-title">
                <h3 class="text-uppercase">{{ $item->item_name }}</h3>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <form action="{{ route('item.destroy', $item->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal">
                    Ubah
                </button>
                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin kategori ini akan dihapus?')">
                    Hapus
                </button>
            </form>

        </div>
    </div>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi Kesalahan!</strong> Berikut adalah kesalahan anda :
            <ol>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ol>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <div class="row">
        <div class="card-title mb-4">
            <h6>Detail {{ $item->item_name }}</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="fw-bold">Nama Barang</td>
                        <td>{{ $item->item_name }}</td>
                        <td rowspan="5" class="text-center">
                            <img src="{{ asset('storage/images/items/' . $item->image) }}" class="img-fluid " width="360" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Kategori</td>
                        <td>{{ $item->category->name }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Merek</td>
                        <td>{{ $item->brand }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Stok</td>
                        <td>{{ $item->stock }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Deskripsi</td>
                        <td>{{ $item->desc }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
            </div>
        </div>
    </div>
@endsection
