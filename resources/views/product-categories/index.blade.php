@extends('layout.app')

@section('content')
    <div class="card mt-2">

        <div class="card-header">
            <a href="{{ route('product-categories.create') }}" class="btn btn-primary">Tambah Data</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </thead>

                    <tbody>
                        @foreach ($product_categories as $index => $product_category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product_category->name }}</td>
                                <td>{{ $product_category->description }}</td>
                                <td>{{ $product_category->created_at }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="{{ route('product-categories.edit', $product_category->id) }}"
                                            class="btn btn-outline-warning">Edit</a>
                                        <form action="{{ route('product-categories.destroy', $product_category->id) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Yakin ingin menghapus kategori produk ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
