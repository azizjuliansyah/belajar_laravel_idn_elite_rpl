@extends('layout.app')

@section('content')
    <div class="card mt-2">

        <div class="card-header">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProduk">
                Tambah Produk
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </thead>

                    <tbody>
                        @foreach ($products as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($product->photo_product)
                                        <img src="{{ asset('storage/products/photo/' . $product->photo_product) }}"
                                            class="img-fluid" width="100" alt="">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                            data-bs-target="#editProduk{{ $index + 1 }}">
                                            Edit
                                        </button>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm('Yakin ingin menghapus produk ini?')">
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

    <!-- Modal -->
    <div class="modal fade" id="tambahProduk" tabindex="-1" aria-labelledby="tambahProdukLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahProdukLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga Produk</label>
                            <input type="number" class="form-control" name="price" id="price">
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock Produk</label>
                            <input type="number" class="form-control" name="stock" id="stock">
                        </div>
                        <div class="mb-3">
                            <label for="photo_product" class="form-label">Foto Produk</label>
                            <input class="form-control" type="file" name="photo_product" id="photo_product">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($products as $index => $product)
        <!-- Modal -->
        <div class="modal fade" id="editProduk{{ $index + 1 }}" tabindex="-1" aria-labelledby="editProdukLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProdukLabel">Edit Produk {{ $product->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('products.update', $product->id) }}" method="post"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $product->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Harga Produk</label>
                                <input type="number" class="form-control" name="price" id="price"
                                    value="{{ $product->price }}">
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock Produk</label>
                                <input type="number" class="form-control" name="stock" id="stock"
                                    value="{{ $product->stock }}">
                            </div>
                            <div class="mb-3">
                                <label for="photo_product" class="form-label">Foto Produk</label>
                                <div class="row">
                                    @if ($product->photo_product)
                                        <img src="{{ asset('storage/products/photo/' . $product->photo_product) }}"
                                            class="img-fluid" width="40" alt="">
                                    @endif
                                </div>
                                <input class="form-control" type="file" name="photo_product" id="photo_product">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
