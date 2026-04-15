@extends('template.app')

@section('title')
    <div class="row">
        <div class="col-md-6">
            <div class="card-title">
                <h3 class="text-uppercase">{{ $category->name }}</h3>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <form action="{{ route('category.destroy', $category->id) }}" method="post">
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
            <h6>Barang yang ada di kategori {{ $category->name }}</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th>Nama Barang</th>
                    <th>Merek</th>
                    <th>Stok</th>
                    <th>#</th>
                </thead>
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
                <form action="{{ route('category.update', $category->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Kategori</label>
                            <input type="text" name="nama_kategori" value="{{ $category->name }}" id="nama_kategori"
                                class="form-control mt-2 @error('nama_kategori') is-invalid @enderror ">
                            @error('nama_kategory')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
