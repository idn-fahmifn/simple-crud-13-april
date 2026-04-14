@extends('template.app')

@section('title')
    <div class="row">
        <div class="col-md-6">
            <div class="card-title">
                <h3>Data Kategori</h3>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <a href="" class="btn btn-success">Buat Baru</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Nama Kategori</h5>
                    <div class="mt-2">Dibuat pada : </div>
                    <a href="" class="btn btn-success mt-2 btn-full d-flex justify-content-center">detail</a>
                </div>
            </div>
        </div>
    </div>
@endsection
