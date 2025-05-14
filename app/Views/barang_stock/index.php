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
                <!-- Daftar Barang Toko Alisa -->
                Daftar Barang
            </h1>

            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-tambah-barang-stock">
                Tambah Barang
            </button>
            <br><br>

            <!-- Daftar Barang Toko Alisa -->
            <!-- <h1 class="mt-3">
            Daftar Barang
            </h1>  -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <!--datatable tabel stok barang -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="barang_stock_table" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Barcode</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <!-- Modal tambah barang stock -->
            <div class="modal fade" id="modal-tambah-barang-stock">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Daftar Barang </h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- <input type="hidden" id="user_id"> -->
                            <!-- <form action=""> -->
                            <div class="form-group">
                                <label for="product_item">Barcode</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="bstock_custom_code" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Nama Barang</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="bstock_nama_barang" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- select input barang kategori -->
                            <div class="form-group">
                                <label for="product_item">Kategori</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-select" id="bstock_kategori_select">
                                            <option selected value="Kategori" data-bstock_kategori="-">Pilih kategori</option>

                                            <?php
                                            $no = 0;
                                            foreach ($data_barang_kategori as $key => $d) :
                                                $no++;
                                            ?>
                                                <option value="<?= $no; ?>" data-bstock_kategori="<?= $d->bkategori_nama; ?>">
                                                    <?= $d->bkategori_nama; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- select input barang satuan -->
                            <div class="form-group">
                                <label for="product_item">Satuan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-select" id="bstock_satuan_select">
                                            <option selected value="Satuan" data-bstock_satuan="-">Pilih satuan</option>

                                            <?php
                                            $no = 0;
                                            foreach ($data_barang_satuan as $key => $d) :
                                                $no++;
                                            ?>
                                                <option value="<?= $no; ?>" data-bstock_satuan="<?= $d->bsatuan_nama; ?>">
                                                    <?= $d->bsatuan_nama; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Harga</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="number" id="bstock_harga" class="form-control" value=0 min=0>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="product_item">Catatan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="bstock_catatan" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group mt-2 border border-danger rounded" id="validation-div" style="display:none;">
                                <div class="col-md-12 m-2">
                                    <div id="validation-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="float-right">
                                <button type="button" id="tambah_barang_stock" class="btn btn-flat btn-success">
                                    <i class="fas fa-paper-plane"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal edit barang stock -->
            <div class="modal fade" id="modal-edit-barang-stock">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Barang </h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="bstock_id">
                            <div class="form-group">
                                <label for="product_item">Barcode</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="bstock_custom_code_edit" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Nama Barang</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="bstock_nama_barang_edit" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- select input barang kategori -->
                            <div class="form-group">
                                <label for="product_item">Kategori</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-select" id="bstock_kategori_select_edit">
                                            <option selected id="kategori_default_edit" data-bstock_kategori_edit="0">Pilih kategori</option>

                                            <?php
                                            $no = 0;
                                            foreach ($data_barang_kategori as $key => $d) :
                                                $no++;
                                            ?>
                                                <option value="<?= $no; ?>" data-bstock_kategori_edit="<?= $d->bkategori_nama; ?>">
                                                    <?= $d->bkategori_nama; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- select input barang satuan -->
                            <div class="form-group">
                                <label for="product_item">Satuan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-select" id="bstock_satuan_select_edit">
                                            <option selected value="Satuan" data-bstock_satuan_edit="-">Pilih satuan</option>

                                            <?php
                                            $no = 0;
                                            foreach ($data_barang_satuan as $key => $d) :
                                                $no++;
                                            ?>
                                                <option value="<?= $no; ?>" data-bstock_satuan_edit="<?= $d->bsatuan_nama; ?>">
                                                    <?= $d->bsatuan_nama; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Harga</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="number" id="bstock_harga_edit" class="form-control" min=0>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Catatan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="bstock_catatan_edit" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-2 border border-danger rounded" id="edit-validation-div" style="display:none;">
                                <div class="col-md-12 m-2">
                                    <div id="edit-validation-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="float-right">
                                <button type="button" id="edit_barang_stock" class="btn btn-flat btn-success">
                                    <i class="fas fa-paper-plane"></i> Simpan
                                </button>
                            </div>
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
        // inisialisai data barang stock
        $(function() {
            var table = $('#barang_stock_table').removeAttr('width').DataTable({
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
                    "url": '<?php echo base_url("/barang_stock/getDataBarangStock") ?>',
                    "type": "POST",
                    "dataType": "json",
                    async: "true"
                }
            });
        });

        $(document).on('click', '#tambah_barang_stock', function() {
            var bstock_custom_code = $('#bstock_custom_code').val()
            var bstock_nama_barang = $('#bstock_nama_barang').val()
            var bstock_kategori = $('#bstock_kategori_select').find(':selected').data('bstock_kategori')
            var bstock_unit = $('#bstock_satuan_select').find(':selected').data('bstock_satuan')
            var bstock_harga = $('#bstock_harga').val()
            var bstock_catatan = $('#bstock_catatan').val()

            if (bstock_harga < 0) {
                alert('Harga tidak valid')
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('barang_stock/save') ?>',
                    data: {
                        'bstock_custom_code': bstock_custom_code,
                        'bstock_nama_barang': bstock_nama_barang,
                        'bstock_kategori': bstock_kategori,
                        'bstock_unit': bstock_unit,
                        'bstock_harga': bstock_harga,
                        'bstock_catatan': bstock_catatan,
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success) {
                            // dibawah ini working code
                            $('#barang_stock_table').DataTable().ajax.reload(null, false).draw(false);
                            alert('Data barang baru berhasil ditambahkan')
                            // $('#validation-msg').val(result.messages)
                            $('#modal-tambah-barang-stock').modal('hide')

                            $('#validation-msg').html(Object.values(result.messages).join("<br>"))
                            $('#validation-div').hide()
                            // location.href = '(print php) site_url('barang_stock') (print php)'
                            clear_input_form()
                        } else {
                            alert('Gagal menambahkan data barang')
                            $('#validation-div').show()
                            $('#validation-msg').html(Object.values(result.messages).join("<br>"))

                            console.log(Object.values(result.messages))
                        }
                    }
                })
            }
        });

        function clear_input_form() {
            $('#bstock_custom_code').val("")
            $('#bstock_nama_barang').val("")
            $('#bstock_harga').val("")
            $('#bstock_catatan').val("")
            $('#bstock_satuan').val("")
            $('#bstock_kategori').val("")
        }

        $(document).on('click', '#update_barang_stock', function() {
            $('#bstock_id').val($(this).data('bstock_id'));
            $('#bstock_custom_code_edit').val($(this).data('bstock_custom_code_old'));
            $('#bstock_nama_barang_edit').val($(this).data('bstock_nama_barang_old'));
            // $('#kategori_default_edit').val($(this).data('bstock_kategori_old'));
            // $('#bstock_satuan_edit').val($(this).data('bstock_satuan_old'));
            $('#bstock_harga_edit').val($(this).data('bstock_harga_old'));
            $('#bstock_catatan_edit').val($(this).data('bstock_catatan_old'));

            var k = $(this).data('bstock_id');
            console.log('bstock_id edited: ' + k);

            // var selectedSatuan = $(this).data('bstock_satuan_old');
            // $('#bstock_satuan_select_edit').val(selectedSatuan).trigger('change');
        })

        $(document).on('click', '#edit_barang_stock', function() {

            var bstock_id = $('#bstock_id').val()
            console.log(bstock_id)

            var k = $(this).data('#bstock_id');
            console.log('bstock_id edited: ' + k);

            var bstock_custom_code = $('#bstock_custom_code_edit').val()
            console.log('code: ' + bstock_custom_code)
            var bstock_nama_barang = $('#bstock_nama_barang_edit').val()
            console.log('code: ' + bstock_nama_barang)
            var bstock_harga = $('#bstock_harga_edit').val()
            console.log('code: ' + bstock_harga)
            var bstock_catatan = $('#bstock_catatan_edit').val()
            console.log('code: ' + bstock_catatan)
            var bstock_kategori = $('#bstock_kategori_select_edit').find(':selected').data('bstock_kategori_edit')
            console.log('code: ' + bstock_kategori)
            var bstock_unit = $('#bstock_satuan_select_edit').find(':selected').data('bstock_satuan_edit')
            console.log('code: ' + bstock_unit)

            $.ajax({
                type: 'POST',
                url: '<?= site_url('barang_stock/edit') ?>',
                data: {
                    'bstock_id': bstock_id,
                    'bstock_custom_code': bstock_custom_code,
                    'bstock_nama_barang': bstock_nama_barang,
                    'bstock_harga': bstock_harga,
                    'bstock_catatan': bstock_catatan,
                    'bstock_kategori': bstock_kategori,
                    'bstock_unit': bstock_unit,
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        $('#barang_stock_table').DataTable().ajax.reload(null, false).draw(false);
                        alert('Data barang berhasil diubah')
                        $('#modal-edit-barang-stock').modal('hide')
                        $('#edit-validation-msg').html(Object.values(result.messages).join("<br>"))
                        $('#edit-validation-div').hide()
                    } else {
                        alert('Data barang gagal diubah')
                        // alert('ini tempC: ' + JSON.stringify(result.tempC))
                        // alert(JSON.stringify(result.tempC))
                        // alert(JSON.stringify(result.tempA))
                        // alert(JSON.stringify(result.tempB))
                        $('#edit-validation-div').show()
                        $('#edit-validation-msg').html(Object.values(result.messages).join("<br>"))
                        // $('#modal-edit-user').modal('hide')
                    }
                }

            })
            // }
        })

        $(document).on('click', '#hapus_barang_stock', function() {
            if (confirm('Yakin hapus data barang ini?')) {
                var bstock_id = $(this).data('bstock_id');
                console.log("del bstock_id: " + bstock_id);
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('barang_stock/delete') ?>',
                    data: {
                        'bstock_id': bstock_id,
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            $('#barang_stock_table').DataTable().ajax.reload(null, false).draw(false);
                            alert('Berhasil hapus data barang');

                            location.href = '<?= site_url('barang_stock') ?>'
                        } else {
                            alert('Gagal hapus data barang');
                        }
                    }
                })
            }
        })
    </script>


    <?= $this->endSection() ?>