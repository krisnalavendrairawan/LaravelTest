@extends('layouts.main')

@section('title', 'Daftar Produk')

@section('content')
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="bi bi-box-seam me-2"></i>Manajemen Produk
            </h1>
            <p class="text-muted">Kelola semua produk Anda dengan mudah</p>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary" id="btnAddProduct">
                <i class="bi bi-plus-circle me-1"></i> Tambah Produk Baru
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Produk</h5>
            <div>
                <button class="btn btn-sm btn-outline-secondary" id="btnRefresh">
                    <i class="bi bi-arrow-clockwise"></i> Refresh
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="productsTable" width="100%">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add/Edit Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm">
                        <input type="hidden" id="product_id">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama" name="nama" required placeholder="Masukkan nama produk">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required placeholder="Masukkan deskripsi produk"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="harga" class="form-label">Harga (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="harga" name="harga" min="0" step="0.01" required placeholder="0">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" min="0" required placeholder="0">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btnSave">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Product Modal -->
    <div class="modal fade" id="viewProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fw-bold">Nama Produk:</label>
                        <p id="view_nama" class="mb-1"></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Deskripsi:</label>
                        <p id="view_deskripsi" class="mb-1"></p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Harga:</label>
                            <p id="view_harga" class="mb-1"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Stok:</label>
                            <p id="view_stok" class="mb-1"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Dibuat:</label>
                            <p id="view_created" class="mb-1"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Diperbarui:</label>
                            <p id="view_updated" class="mb-1"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus produk ini?</p>
                    <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="btnConfirmDelete">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var table = $('#productsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('products.index') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {data: 'nama', name: 'nama'},
                {data: 'harga_formatted', name: 'harga'},
                {
                    data: 'stok',
                    name: 'stok',
                    render: function(data, type, row) {
                        if (data < 10) {
                            return '<span class="low-stock">' + data + '</span>';
                        }
                        return data;
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data) {
                        return new Date(data).toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric'
                        });
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

        $('#btnRefresh').on('click', function() {
            table.ajax.reload();
            toastr.info('Data produk telah diperbarui');
        });

        $('#btnAddProduct').on('click', function() {
            $('#productForm').trigger('reset');
            $('#product_id').val('');
            $('#modalTitle').text('Tambah Produk Baru');
            $('#productModal').modal('show');
        });

        $('#btnSave').on('click', function() {
            var product_id = $('#product_id').val();
            var url = product_id ? '/products/' + product_id : '/products';
            var method = product_id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: {
                    nama: $('#nama').val(),
                    deskripsi: $('#deskripsi').val(),
                    harga: $('#harga').val(),
                    stok: $('#stok').val()
                },
                success: function(response) {
                    $('#productModal').modal('hide');
                    table.ajax.reload();
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.message || 'Terjadi kesalahan');
                }
            });
        });

        $(document).on('click', '.btn-view', function() {
            var product_id = $(this).data('id');

            $.ajax({
                url: '/products/' + product_id,
                type: 'GET',
                success: function(response) {
                    var product = response.data;
                    $('#view_nama').text(product.nama);
                    $('#view_deskripsi').text(product.deskripsi);
                    $('#view_harga').text('Rp ' + parseFloat(product.harga).toLocaleString('id-ID'));
                    $('#view_stok').text(product.stok);

                    var created = new Date(product.created_at);
                    var updated = new Date(product.updated_at);

                    $('#view_created').text(created.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    }));

                    $('#view_updated').text(updated.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    }));

                    $('#viewProductModal').modal('show');
                },
                error: function(xhr) {
                    toastr.error('Gagal memuat data produk');
                }
            });
        });

        $(document).on('click', '.btn-edit', function() {
            var product_id = $(this).data('id');

            $.ajax({
                url: '/products/' + product_id + '/edit',
                type: 'GET',
                success: function(response) {
                    var product = response.data;
                    $('#product_id').val(product.id);
                    $('#nama').val(product.nama);
                    $('#deskripsi').val(product.deskripsi);
                    $('#harga').val(product.harga);
                    $('#stok').val(product.stok);

                    $('#modalTitle').text('Edit Produk');
                    $('#productModal').modal('show');
                },
                error: function(xhr) {
                    toastr.error('Gagal memuat data produk');
                }
            });
        });

        $(document).on('click', '.btn-delete', function() {
            var product_id = $(this).data('id');
            $('#btnConfirmDelete').data('id', product_id);
            $('#deleteModal').modal('show');
        });

        $('#btnConfirmDelete').on('click', function() {
            var product_id = $(this).data('id');

            $.ajax({
                url: '/products/' + product_id,
                type: 'DELETE',
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    table.ajax.reload();
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    toastr.error('Gagal menghapus produk');
                }
            });
        });
    });
</script>
@endsection
