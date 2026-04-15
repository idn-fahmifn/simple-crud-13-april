@extends('template.app')

@section('title')
    <div class="row">
        <div class="col-md-6">
            <div class="card-title">
                <h3>Data Barang</h3>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal">
                Buat Baru
            </button>
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
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th>Nama Barang</th>
                    <th>Merek</th>
                    <th>Category</th>
                    <th>#</th>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->brand }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>
                                <a href="{{ route('item.show', $item->uuid) }}" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Data barang belum ada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('item.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group my-2">
                            <label for="">Nama barang</label>
                            <input type="text" name="nama_barang" value="{{ @old('nama_barang') }}" id="nama_barang"
                                class="form-control mt-2 @error('nama_barang') is-invalid @enderror ">
                            @error('nama_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="">Kategori barang</label>
                            <select name="kategori" id=""
                                class="form-control mt-2 @error('kategori') is-invalid @enderror">
                                <option value="" disabled>Pilih Kategori</option>
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                    <option value="" disabled>Kategori tidak ditemukan</option>
                                @endforelse
                            </select>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group
                                my-2">
                            <label for="">Merek</label>
                            <input type="text" name="merk" value="{{ @old('merk') }}" id="merk"
                                class="form-control mt-2 @error('merk') is-invalid @enderror ">
                            @error('merk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="">Stok</label>
                            <input type="number" name="stok" value="{{ @old('stok') }}" id="stok"
                                class="form-control mt-2 @error('stok') is-invalid @enderror ">
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="">Gambar Barang</label>
                            <input type="file" name="gambar" value="{{ @old('gambar') }}" id="gambar"
                                class="form-control mt-2 @error('gambar') is-invalid @enderror" accept="image/*">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="">Deskripsi barang</label>
                            <textarea name="deskripsi" class="form-control mt-2 @error('deskripsi') is-invalid @enderror "></textarea>
                            @error('deskripsi')
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
