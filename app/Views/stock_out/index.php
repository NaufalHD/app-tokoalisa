<?= $this->extend('layout/template'); ?>
<? //php session_start(); 
?>
<?php helper('settings'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">

        <!-- <? //= dd($_SESSION['username']); 
                ?> -->
        <!-- <? //= dd(session()->session_id); 
                ?> -->
        <!-- <? //= dd(session()->get('username')); 
                ?> -->
        <!-- <? //php if (null != session()->get('username')) { 
                ?> -->

        <?php if (session()->islogin) { ?>
            <div class="my-5">
                <h2>Username: <?= session()->get('username'); ?></h2>
                <br><br>
                <h2>pemilik?: <?= session()->get('user_isadmin'); ?></h2>
                <br>
                <a href="/logout" class="btn btn-danger mt-3">Logout</a>
            </div>
        <?php } ?>


        <br>
        <div class="col-6">
            <!-- <form action="/komik/pencarian" method="POST"> -->
            <!-- method kalau gaditulis mau pakai tipe apa, pasti akan menjadi sebuah method GET -->

            <!-- sebenernya pake tag yang dibawah ini -->
            <!-- 
                <form action="" method="post">
             -->

            <!-- actionnya dikosongkan karena ingin memakai didalam controller yang sama, yaitu 
             controller Komik -->
            <!-- <form>
                <div class="input-group mb-3">
                    <input type="text" name="keyword" class="form-control" placeholder="Masukkan input pencarian disini cuyyy" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Cari Cuy</button>
                </div>
            </form> -->
        </div>
        <br>

    </div>

    <div class="row">
        <div class="col">
            <!-- <a href="/login" class="btn btn-success mt-3">Login</a> -->
            <a href="<?= base_url(); ?>" class="btn btn-primary mt-3">Home</a>

            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-tambah-stock-out">
                Tambah Stock Out
            </button>

            <h1 class="mt-3">
                Daftar Stock Out
            </h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <!-- mb is margin bottom -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="stock_out_table" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <!-- <th scope="col">ID Barang</th> -->
                            <th scope="col">Barcode</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Date</th>
                            <!-- <th scope="col">Alamat</th> -->
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <!-- Modal tambah stock out -->
            <div class="modal fade" id="modal-tambah-stock-out">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Stock Out Barang</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- <input type="hidden" id="user_id"> -->
                            <!-- <form action=""> -->
                            <div class="form-group">
                                <label for="product_item">Date</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="date" id="stock_out_date" value="<?= date('Y-m-d') ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-4">
                                <table width="100%">
                                    <tr>
                                        <div class="form-group input-group">
                                            <input type="hidden" id="bstock_id">
                                            <!-- <input type="hidden" id="stok_harga"> -->
                                            <!-- <input type="hidden" id="stok_jumlah"> -->
                                            <!-- <input type="hidden" id="qty_cart"> -->
                                            <!-- <input type="text" id="barcode" class="form-control" autofocus> -->
                                            <div class="d-grid gap-2 col-6 mx-auto">
                                                <button type="button" class="btn btn-outline-info btn-lg" style="color: black;" data-bs-toggle="modal" data-bs-target="#modal-item-barang">Pilih Barang</button>
                                            </div>
                                        </div>
                                    </tr>
                                </table>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Barcode</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="barcode" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Nama Barang</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="nama_barang_keluar" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Stok Awal</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="stok_awal_barang_keluar" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Unit</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="unit_barang_keluar" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Qty</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="number" id="stock_out_qty" value="0" min=0 class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Catatan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="stock_out_catatan" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-2 border border-danger rounded" id="validation-div" style="display:none;">
                                <div class="col-md-12 m-2">
                                    <div id="validation-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="float-right">
                                <button type="button" id="tambah_stock_out" class="btn btn-flat btn-success">
                                    <!-- <button type="submit" id="tambah_pelanggan" class="btn btn-flat btn-success"> -->
                                    <i class="fas fa-paper-plane"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>

            </div>

            <!-- Modal detail stock out -->
            <div class="modal fade" id="modal-detail-stock-out">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-tittle">Detail Stock Out</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered" id="table_detail_stock_out" width="100%">
                                <tr>
                                    <td width="40%" class="fw-semibold">Date</td>
                                    <td id="detail_stock_out_date"> </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Barcode</td>
                                    <td id="detail_stock_out_barang_barcode"> </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Nama Barang</td>
                                    <td id="detail_stock_out_nama_barang"> </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Catatan</td>
                                    <td id="detail_stock_out_catatan"> </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Qty</td>
                                    <td id="detail_stock_out_qty"> </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <!-- modal item barang -->
            <div class="modal fade" id="modal-item-barang">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-tittle">Pilih Barang</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </div>
                        <div class="modal-body table-responsive">
                            <table class="table table-bordered table-striped" id="table1" width="100%">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Barcode</td>
                                        <td>Nama</td>
                                        <td>Unit</td>
                                        <td>Harga</td>
                                        <td>Stock</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($item_barang as $data) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data->bstock_custom_code ?></td>
                                            <td><?= $data->bstock_nama_barang ?></td>
                                            <td><?= $data->bstock_unit ?></td>
                                            <!-- rupiah nya ini ada di php helper, liat file ini paling atas -->
                                            <td class="text-right"><?= rupiah($data->bstock_harga) ?></td>
                                            <td class="text-right"><?= $data->bstock_ready_stock ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-info" id="select" data-id="<?= $data->bstock_id ?>" data-harga="<?= $data->bstock_harga ?>" data-barcode="<?= $data->bstock_custom_code ?>" data-stok="<?= $data->bstock_ready_stock ?>" data-nama_barang="<?= $data->bstock_nama_barang ?>" data-unit_barang="<?= $data->bstock_unit ?>">
                                                    <i class="fas fa-check"></i> Select
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?= $this->endSection(); ?>

    <?= $this->section("pageScript") ?>

    <script>
        // dataTables
        // inisialisai data stock out
        $(function() {
            var table = $('#stock_out_table').removeAttr('width').DataTable({
                "paging": true,
                "length": false,
                // "length": true,
                "searching": true,
                "ordering": true,
                // "lengthChange": true,
                // "lengthMenu": [2, 3, 5, 75, 100],
                "info": false,
                // "pageLength": 2,
                "autoWidth": false,
                "scrollY": '45vh',
                /*  */
                "scrollX": true,
                "scrollCollapse": false,
                "responsive": true,
                // mengambil data melalui ajax
                "ajax": {
                    "url": '<?php echo base_url("/stock_out/getDataStockOut") ?>',
                    "type": "POST",
                    "dataType": "json",
                    async: "true"
                }
            });
        });

        $(document).on('click', '#select', function() {
            $('#bstock_id').val($(this).data('id'));
            // $('#stok_harga').val($(this).data('harga'));
            $('#barcode').val($(this).data('barcode'));
            $('#stok_awal_barang_keluar').val($(this).data('stok'));
            $('#nama_barang_keluar').val($(this).data('nama_barang'));
            $('#unit_barang_keluar').val($(this).data('unit_barang'));
            $('#modal-item-barang').modal('hide');
            $('#modal-tambah-stock-out').modal('show');
            // get_cart_qty($(this).data('id'))
        })

        $(document).on('click', '#tambah_stock_out', function() {
            var stock_out_date = $('#stock_out_date').val()
            var stock_out_barang_id = $('#bstock_id').val()
            var stock_out_barang_barcode = $('#barcode').val()
            var stock_out_qty = parseInt($('#stock_out_qty').val())
            var stock_out_catatan = $('#stock_out_catatan').val()
            var stock_out_nama_barang = $('#nama_barang_keluar').val()

            var stock_awal_barang_keluar = parseInt($('#stok_awal_barang_keluar').val())

            console.log('stock awal qty: ' + stock_awal_barang_keluar)
            console.log('stock out qty: ' + stock_out_qty)

            if (stock_out_barang_id == null || stock_out_barang_id == 0) {
                alert('Harap pilih barang terlebih dahulu')
            } else if (stock_out_qty < 1) {
                alert('Qty dimasukkan tidak valid')
            } else if (stock_out_qty > stock_awal_barang_keluar) {
                alert('Qty dimasukkan melebihi stok tersedia')
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('stock_out/save') ?>',
                    data: {
                        'stock_out_date': stock_out_date,
                        'stock_out_barang_id': stock_out_barang_id,
                        'stock_out_barang_barcode': stock_out_barang_barcode,
                        'stock_out_nama_barang': stock_out_nama_barang,
                        // 'stock_in_supp': stock_in_supp,
                        'stock_out_qty': stock_out_qty,
                        'stock_out_catatan': stock_out_catatan,
                        // 'stock_in_harga_masuk': stock_in_harga_masuk,
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success) {
                            // dibawah ini working code
                            $('#stock_out_table').DataTable().ajax.reload(null, false).draw(false);
                            alert('Stok Out berhasil ditambahkan')
                            // $('#validation-msg').val(result.messages)
                            $('#validation-msg').html(Object.values(result.messages).join("<br>"))
                            $('#modal-tambah-stock-out').modal('hide')
                            $('#validation-div').hide()
                            location.href = '<?= site_url('stock_out') ?>'
                            clear_input_form()
                        } else {
                            alert('Gagal menambahkan stok barang')
                            $('#validation-div').show()
                            $('#validation-msg').html(Object.values(result.messages).join("<br>"))

                            console.log(Object.values(result.messages))
                        }
                    }
                })
            }
        });

        function clear_input_form() {
            $('#bstock_id').val("")
            $('#stock_out_date').val("")
            $('#stock_out_barang_id').val("")
            $('#stock_out_barang_barcode').val("")
            $('#stock_out_nama_barang').val("")
            // $('#stock_in_supp').val("")
            $('#stock_out_qty').val("")
            $('#stock_out_catatan').val("")
            $('#stock_out_nama_barang').val("")
            // $('#stock_in_harga_masuk').val("")
        }

        $(document).on('click', '#detail_stock_out', function() {
            var targetCell = document.getElementById("detail_stock_out_date");
            targetCell.textContent = $(this).data('stock_out_date');

            targetCell = document.getElementById("detail_stock_out_barang_barcode");
            targetCell.textContent = $(this).data('stock_out_barang_barcode');

            targetCell = document.getElementById("detail_stock_out_nama_barang");
            targetCell.textContent = $(this).data('stock_out_nama_barang');

            targetCell = document.getElementById("detail_stock_out_catatan");
            targetCell.textContent = $(this).data('stock_out_catatan');

            targetCell = document.getElementById("detail_stock_out_qty");
            targetCell.textContent = $(this).data('stock_out_qty');
        })

        $(document).on('click', '#hapus_stock_out', function() {
            if (confirm('Yakin hapus data ini?')) {
                var stock_out_id = $(this).data('stock_out_id');

                // var supp_nama = $(this).data('supp_nama');
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('stock_out/delete') ?>',
                    data: {
                        'stock_out_id': stock_out_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            $('#stock_out_table').DataTable().ajax.reload(null, false).draw(false);
                            alert('Berhasil hapus data stock out');

                            location.href = '<?= site_url('stock_out') ?>'
                        } else {
                            alert('Gagal hapus data stock in');
                        }
                    }
                })
            }
        })
    </script>


    <?= $this->endSection() ?>