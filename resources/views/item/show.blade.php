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
                <form action="{{ route('item.update', $item->id) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group my-2">
                            <label for="">Nama barang</label>
                            <input type="text" name="nama_barang" value="{{ $item->item_name }}" id="nama_barang"
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
                                    <option value="{{ $category->id }}" 
                                        {{ @old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                            <input type="text" name="merk" value="{{ $item->brand }}" id="merk"
                                class="form-control mt-2 @error('merk') is-invalid @enderror ">
                            @error('merk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="">Stok</label>
                            <input type="number" name="stok" value="{{ $item->stock }}" id="stok"
                                class="form-control mt-2 @error('stok') is-invalid @enderror ">
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="">Gambar Barang</label>
                            <input type="file" name="gambar" value="{{ $item->image }}" id="gambar"
                                class="form-control mt-2 @error('gambar') is-invalid @enderror" accept="image/*">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="">Deskripsi barang</label>
                            <textarea name="deskripsi" class="form-control mt-2 @error('deskripsi') is-invalid @enderror ">{{ $item->desc }}
                            </textarea>
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
