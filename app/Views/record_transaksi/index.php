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
            <a href="<?= base_url(); ?>" class=" btn btn-primary mt-3">Home</a>

            <!-- <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-tambah-stock-in">
                Tambah Stock In
            </button> -->

            <h1 class="mt-3">
                Daftar Record Transaksi
            </h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <div class="row mb-2 justify-content-end">
                <form action="" method="GET">
                    <input type="date" id="start_date_tbl_transaksi">
                    <input type="date" id="end_date_tbl_transaksi">
                    <button class="btn btn-outline-secondary" id="search_range_tbl_transaksi" type="button">Cari Transaksi</button>
                    <button class="btn btn-outline-danger" id="reset_tbl_transaksi" type="button">Reset</button>
                </form>
            </div>
            <!-- mb is margin bottom -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tbl_transaksi_table" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Diskon</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>





        </div>
    </div>
    <?= $this->endSection(); ?>

    <?= $this->section("pageScript") ?>

    <script>
        // dataTables
        // inisialisai data stock in
        $(function() {
            var table = $('#tbl_transaksi_table').removeAttr('width').DataTable({
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
                    "url": '<?php echo base_url("/record_transaksi/getDataTransaksi") ?>',
                    "type": "POST",
                    "dataType": "json",
                    async: "true"
                }
            });
        });

        $(document).on('click', '#search_range_tbl_transaksi', function() {
            // var start_date = new Date($('#start_date_omzet_harian').val())
            // var end_date = new Date($('#end_date_omzet_harian').val())
            var start_date = $('#start_date_tbl_transaksi').val()
            var end_date = $('#end_date_tbl_transaksi').val()
            //kondisi jika nama pelanggan sudah diisi oleh user
            if (end_date < start_date) {
                alert('input tanggal tidak valid')
            } else {
                $.ajax({
                    url: '<?= site_url('record_transaksi/range_getDataTransaksi') ?>',
                    method: 'POST',
                    data: {
                        'start_date': start_date,
                        'end_date': end_date,
                    },
                    dataType: 'json',
                    success: function(response) {
                        // alert(JSON.stringify(data));
                        // Update the DataTable with the new data
                        var data = response.data
                        $('#tbl_transaksi_table').DataTable().clear().rows.add(data).draw();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }


        });

        $(document).on('click', '#reset_tbl_transaksi', function() {
            $.ajax({
                url: '<?= site_url('record_transaksi/getDataTransaksi') ?>',
                method: 'POST',
                data: {},
                dataType: 'json',
                success: function(response) {
                    // Update the DataTable with the new data

                    // $('#omzet_harian_table').DataTable().destroy()
                    var data = response.data
                    $('#tbl_transaksi_table').DataTable().clear().rows.add(data).draw();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        function clear_input_form() {
            // $('#bstock_id').val("")
            // $('#stock_in_date').val("")
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

        $(document).on('click', '#lihat_transaksi', function() {

            var transaksi_id = $(this).data('transaksi_id');

            window.open('<?= site_url('transaksi/cetak_no_print/') ?>' + transaksi_id, '_blank');
            // window.close();

        })

        $(document).on('click', '#print_transaksi', function() {

            var transaksi_id = $(this).data('transaksi_id');

            window.open('<?= site_url('transaksi/cetak/') ?>' + transaksi_id, '_blank');

        })

        $(document).on('click', '#hapus_transaksi', function() {
            if (confirm('Yakin hapus data ini?')) {
                var transaksi_id = $(this).data('transaksi_id');

                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('record_transaksi/delete') ?>',
                    data: {
                        'transaksi_id': transaksi_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            // dibawah ini kode working
                            $('#tbl_transaksi_table').DataTable().ajax.reload(null, false).draw(false);
                            alert('Berhasil hapus data transaksi');


                        } else {
                            alert('Gagal hapus data transaksi');
                            // alert('tempA: ' + JSON.stringify(result.messages));
                            // echo("hallo");
                            // alert(result.tempA);
                            alert('tempA: ' + JSON.stringify(result.tempA));
                            // alert('tempA: ' + tempA);
                        }
                    }
                })
            }
        })
    </script>


    <?= $this->endSection() ?>