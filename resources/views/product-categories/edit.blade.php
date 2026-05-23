@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Kategori Produk</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('product-categories.update', $product_category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori Produk</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $product_category->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Kategori Produk</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $product_category->description }}</textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('product-categories.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection
