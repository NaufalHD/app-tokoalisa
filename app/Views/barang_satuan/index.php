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

        <?php if (session()->logged_iadsn) { ?>
            <div class="my-5">
                <h2>Username: <?= session()->get('username'); ?></h2>
                <br><br>
                <h2>Admin?: <?= session()->get('user_isadmin'); ?></h2>
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

            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-tambah-barang-satuan">
                Tambah Satuan Barang
            </button>

            <h1 class="mt-3">
                Daftar Satuan Barang
            </h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <!-- mb is margin bottom -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="barang_satuan_table" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Satuan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <!-- Modal tambah barang satuan  -->
            <div class="modal fade" id="modal-tambah-barang-satuan">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Satuan Barang</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="product_item">Nama Satuan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="bsatuan_nama" class="form-control">
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
                                <button type="button" id="tambah_barang_satuan" class="btn btn-flat btn-success">
                                    <!-- <button type="submit" id="tambah_pelanggan" class="btn btn-flat btn-success"> -->
                                    <i class="fas fa-paper-plane"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>

            <!-- modal edit satuan -->
            <div class="modal fade" id="modal-edit-barang-satuan">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-tittle">Ubah Kategori Barang</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="bsatuan_id">
                            <div class="form-group">
                                <label for="product_item">Nama Kategori</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="bsatuan_nama_edit" class="form-control">
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
                                <button type="button" id="edit_barang_satuan" class="btn btn-flat btn-success">
                                    <i class="fas fa-paper-plane"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- dibawah ini untuk menampilkan pager nya secara dg pengaturan default dari CI nya -->
                <!-- <//?=$pager->links(); ?> -->


                <!-- dibawah ini pager tapi dengan tampilan yang telah dibuat di views\pagers\komik_pagination -->
                <!-- parameter (a, b) . a=nama tabel, b=nama file paginationnya -->
                <!-- <div scope="row">-->
                <!-- <//?= $pager->links('komik', 'komik_pagination'); ?> -->
            </div>

        </div>
    </div>
    <?= $this->endSection(); ?>

    <?= $this->section("pageScript") ?>

    <script>
        // dataTables
        // inisialisai data barang bategori
        $(function() {
            var table = $('#barang_satuan_table').removeAttr('width').DataTable({
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
                    "url": '<?php echo base_url("/barang_satuan/getDataBarangSatuan") ?>',
                    "type": "POST",
                    "dataType": "json",
                    async: "true"
                }
            });
        });

        $(document).on('click', '#tambah_barang_satuan', function() {
            var bsatuan_nama = $('#bsatuan_nama').val()

            if (bsatuan_nama == null) {
                alert('Harap isi nama satuan terlebih dahulu')
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('barang_satuan/save') ?>',
                    data: {
                        'bsatuan_nama': bsatuan_nama,
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success) {
                            // dibawah ini working code
                            $('#barang_satuan_table').DataTable().ajax.reload(null, false).draw(false);
                            alert('Satuan barang baru telah berhasil ditambahkan')
                            // $('#validation-msg').val(result.messages)
                            $('#validation-msg').html(Object.values(result.messages).join("<br>"))
                            $('#modal-tambah-barang-satuan').modal('hide')
                            $('#validation-div').hide()
                            clear_input_form()
                        } else {
                            alert('Gagal menambahkan satuan barang')
                            $('#validation-div').show()
                            $('#validation-msg').html(Object.values(result.messages).join("<br>"))

                            console.log(Object.values(result.messages))
                        }
                    }
                })
            }
        });

        function clear_input_form() {
            $('#bsatuan_nama').val("")
        }

        $(document).on('click', '#update_barang_satuan', function() {
            $('#bsatuan_id').val($(this).data('bsatuan_id'));
            $('#bsatuan_nama_edit').val($(this).data('bsatuan_nama_old'));
            var k = $(this).data('bsatuan_id');
            console.log("bsatuan_id: " + k);
        })

        $(document).on('click', '#edit_barang_satuan', function() {

            var bsatuan_id = $('#bsatuan_id').val()
            console.log(bsatuan_id)
            // var pelanggan_nama = 'singkong'
            var bsatuan_nama = $('#bsatuan_nama_edit').val()

            $.ajax({
                type: 'POST',
                url: '<?= site_url('barang_satuan/edit') ?>',
                data: {
                    'bsatuan_id': bsatuan_id,
                    'bsatuan_nama': bsatuan_nama,
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        $('#barang_satuan_table').DataTable().ajax.reload(null, false).draw(false);
                        alert('Satuan barang berhasil diubah')
                        $('#modal-edit-barang-satuan').modal('hide')
                        $('#edit-validation-msg').html(Object.values(result.messages).join("<br>"))
                        $('#edit-validation-div').hide()
                    } else {
                        alert('satuan barang gagal diubah')
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

        $(document).on('click', '#hapus_barang_satuan', function() {
            if (confirm('Yakin hapus data ini?')) {
                var bsatuan_id = $(this).data('bsatuan_id');

                // var supp_nama = $(this).data('supp_nama');
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('barang_satuan/delete') ?>',
                    data: {
                        'bsatuan_id': bsatuan_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            $('#barang_satuan_table').DataTable().ajax.reload(null, false).draw(false);
                            alert('Berhasil hapus satuan barang');

                        } else {
                            alert('Gagal hapus satuan barang');
                        }
                    }
                })
            }
        })
    </script>


    <?= $this->endSection() ?>