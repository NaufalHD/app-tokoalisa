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

            <h1 class="mt-3">
                Daftar Stock In
            </h1>

            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-tambah-stock-in">
                Tambah Stock In
            </button>

            <br>
            <br>
            <!-- 
            <h1 class="mt-3">
                Daftar Stock In
            </h1> -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <!-- mb is margin bottom -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="stock_in_table" width="100%">
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

            <!-- Modal tambah stock in -->
            <div class="modal fade" id="modal-tambah-stock-in">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Stok Barang</h4>
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
                                        <input type="date" id="stock_in_date" value="<?= date('Y-m-d') ?>" class="form-control">
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
                                        <input type="text" id="nama_barang_ditambah" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Stok Awal</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="stok_awal_barang_ditambah" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Unit</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="unit_barang_ditambah" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Qty</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="number" id="stock_in_qty" value="0" min="0" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Harga Masuk</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="number" id="stock_in_harga_masuk" value="0" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Supplier</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-select" id="supplier_select">
                                            <!-- <option selected>Choose...</option> -->

                                            <option selected value="Supplier" data-supp_id="0" data-supp_nama="-">Pilih supplier</option>

                                            <?php
                                            $no = 0;
                                            foreach ($data_supplier_row as $key => $d) :
                                                $no++;
                                            ?>
                                                <!-- <option value= < ?     ?> -->
                                                <!-- $d->pelanggan_id  -->
                                                <!-- $d->pelanggan_id . ' . ' . $d->pelanggan_nama -->

                                                <option value="<?= $no; ?>" data-supp_id="<?= $d->supp_id; ?>" data-supp_nama="<?= $d->supp_nama;  ?>">
                                                    <?= $d->supp_nama; ?>
                                                </option>

                                                <!-- <option value="1">One</option> -->
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="product_item">Catatan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="stock_in_catatan" rows="3" class="form-control"></textarea>
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
                                <button type="button" id="tambah_stock_in" class="btn btn-flat btn-success">
                                    <!-- <button type="submit" id="tambah_pelanggan" class="btn btn-flat btn-success"> -->
                                    <i class="fas fa-paper-plane"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>

            </div>

            <!-- Modal detail stock in -->
            <div class="modal fade" id="modal-detail-stock-in">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-tittle">Detail Stock In</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered" id="table_detail_stock_in" width="100%">
                                <tr>
                                    <td width="40%" class="fw-semibold">Date</td>
                                    <td id="detail_stock_in_date"> </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Barcode</td>
                                    <td id="detail_stock_in_barang_barcode"> </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Nama Barang</td>
                                    <td id="detail_stock_in_nama_barang"> </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Catatan</td>
                                    <td id="detail_stock_in_catatan"> </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Supplier</td>
                                    <td id="detail_stock_in_supp"> </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Qty</td>
                                    <td id="detail_stock_in_qty"> </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Harga Masuk</td>
                                    <td id="detail_stock_in_harga_masuk"> </td>
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
        // inisialisai data stock in
        $(function() {
            var table = $('#stock_in_table').removeAttr('width').DataTable({
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
                    "url": '<?php echo base_url("/stock_in/getDataStockIn") ?>',
                    "type": "POST",
                    "dataType": "json",
                    async: "true"
                }
            });
        });
        //fitur untuk tambah pelanggan baru
        // Get the modal
        // var modal_1 = document.getElementById("modal-tambah-pelanggan");

        // Get the button that opens the modal
        // var btn_modal_1 = document.getElementById("btn_modal_tambah_pelanggan ");

        // Get the <span> element that closes the modal
        // var span = document.getElementsByClassName("close")[0];

        $(document).on('click', '#select', function() {
            $('#bstock_id').val($(this).data('id'));
            // $('#stok_harga').val($(this).data('harga'));
            $('#barcode').val($(this).data('barcode'));
            $('#stok_awal_barang_ditambah').val($(this).data('stok'));
            $('#nama_barang_ditambah').val($(this).data('nama_barang'));
            $('#unit_barang_ditambah').val($(this).data('unit_barang'));
            $('#modal-item-barang').modal('hide');
            $('#modal-tambah-stock-in').modal('show');
            // get_cart_qty($(this).data('id'))
        })

        $(document).on('click', '#tambah_stock_in', function() {
            var stock_in_date = $('#stock_in_date').val()
            var stock_in_barang_id = $('#bstock_id').val()
            var stock_in_barang_barcode = $('#barcode').val()
            var stock_in_qty = $('#stock_in_qty').val()
            var stock_in_catatan = $('#stock_in_catatan').val()
            var stock_in_nama_barang = $('#nama_barang_ditambah').val()
            var stock_in_harga_masuk = $('#stock_in_harga_masuk').val()
            var stock_in_supp = $('#supplier_select').find(':selected').data('supp_nama')
            // var stock_in_supp_id = $('#supplier_select').find(':selected').data('supp_id')

            // console.log("nama supp: " + supp_nama)
            //kondisi jika nama pelanggan kosong program akan memunculkan alert untuk memasukan nama terlebih dahulu
            // if (user_nama == null || user_nama == '') {
            // alert('Harap memasukan nama user terlebih dahulu')

            if (stock_in_barang_id == null || stock_in_barang_id == 0) {
                alert('Harap pilih barang terlebih dahulu')
            } else if (stock_in_qty < 1) {
                alert('Qty dimasukkan tidak valid')
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('stock_in/save') ?>',
                    data: {
                        'stock_in_date': stock_in_date,
                        'stock_in_barang_id': stock_in_barang_id,
                        'stock_in_barang_barcode': stock_in_barang_barcode,
                        'stock_in_nama_barang': stock_in_nama_barang,
                        'stock_in_supp': stock_in_supp,
                        'stock_in_qty': stock_in_qty,
                        'stock_in_catatan': stock_in_catatan,
                        'stock_in_harga_masuk': stock_in_harga_masuk,
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success) {
                            // dibawah ini working code
                            $('#stock_in_table').DataTable().ajax.reload(null, false).draw(false);
                            alert('Stok baru berhasil ditambahkan')
                            // $('#validation-msg').val(result.messages)
                            $('#validation-msg').html(Object.values(result.messages).join("<br>"))
                            $('#modal-tambah-stock-in').modal('hide')
                            $('#validation-div').hide()
                            location.href = '<?= site_url('stock_in') ?>'
                            clear_input_form()

                            // window.location = "pelanggan";
                        } else {
                            alert('Gagal menambahkan stok barang')

                            // alert('tempA: ')
                            // alert('tempA: ' + JSON.stringify(result.messages))

                            // alert('tempA: ' + JSON.stringify(result.tempA))
                            // dibawah ini works alhamdulillah
                            // alert(JSON.stringify(result.messages))
                            $('#validation-div').show()
                            $('#validation-msg').html(Object.values(result.messages).join("<br>"))
                            // $('#validation-msg').html(Object.values(result.messages))

                            console.log(Object.values(result.messages))

                            // dibawah ini bisa
                            // $('#validation-msg').html("respon eror ni")
                            // $('#user_username').val("sebuah respon eror")
                            // $('#user_username').val(result.messages)
                            // $('#user_username').html(result.messages)
                            // $('#modal-tambah-user').modal('hide')
                        }
                    }
                })
            }
        });

        function clear_input_form() {
            $('#bstock_id').val("")
            $('#stock_in_date').val("")
            $('#stock_in_barang_id').val("")
            $('#stock_in_barang_barcode').val("")
            $('#stock_in_nama_barang').val("")
            $('#stock_in_supp').val("")
            $('#stock_in_qty').val("")
            $('#stock_in_catatan').val("")
            $('#stock_in_nama_barang').val("")
            $('#stock_in_harga_masuk').val("")
        }

        $(document).on('click', '#detail_stock_in', function() {
            var targetCell = document.getElementById("detail_stock_in_date");
            targetCell.textContent = $(this).data('stock_in_date');

            targetCell = document.getElementById("detail_stock_in_barang_barcode");
            targetCell.textContent = $(this).data('stock_in_barang_barcode');

            targetCell = document.getElementById("detail_stock_in_nama_barang");
            targetCell.textContent = $(this).data('stock_in_nama_barang');

            targetCell = document.getElementById("detail_stock_in_catatan");
            targetCell.textContent = $(this).data('stock_in_catatan');

            targetCell = document.getElementById("detail_stock_in_supp");
            targetCell.textContent = $(this).data('stock_in_supp');

            targetCell = document.getElementById("detail_stock_in_qty");
            targetCell.textContent = $(this).data('stock_in_qty');

            targetCell = document.getElementById("detail_stock_in_harga_masuk");
            targetCell.textContent = "Rp. " + $(this).data('stock_in_harga_masuk');
        })

        $(document).on('click', '#hapus_stock_in', function() {
            if (confirm('Yakin hapus data ini?')) {
                var stock_in_id = $(this).data('stock_in_id');

                // var supp_nama = $(this).data('supp_nama');
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('stock_in/delete') ?>',
                    data: {
                        'stock_in_id': stock_in_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            // dibawah ini kode working
                            $('#stock_in_table').DataTable().ajax.reload(null, false).draw(false);
                            alert('Berhasil hapus data stock in');

                            location.href = '<?= site_url('stock_in') ?>'
                            // $('#modal-hapus-pelanggan').modal('hide')
                            // window.location = "pelanggan";

                            // calculate();

                        } else {
                            alert('Gagal hapus data stock in');
                        }
                    }
                })
            }
        })
    </script>


    <?= $this->endSection() ?>