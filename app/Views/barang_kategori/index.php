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

            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-tambah-barang-kategori">
                Tambah Kategori Barang
            </button>

            <h1 class="mt-3">
                Daftar Kategori Barang
            </h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <!-- mb is margin bottom -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="barang_kategori_table" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <!-- Modal tambah barang kategori  -->
            <div class="modal fade" id="modal-tambah-barang-kategori">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Kategori Barang</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="product_item">Nama Kategori</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="bkategori_nama" class="form-control">
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
                                <button type="button" id="tambah_barang_kategori" class="btn btn-flat btn-success">
                                    <!-- <button type="submit" id="tambah_pelanggan" class="btn btn-flat btn-success"> -->
                                    <i class="fas fa-paper-plane"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>

            <!-- modal edit kategori -->
            <div class="modal fade" id="modal-edit-barang-kategori">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-tittle">Ubah Kategori Barang</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="bkategori_id">
                            <div class="form-group">
                                <label for="product_item">Nama Kategori</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="bkategori_nama_edit" class="form-control">
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
                                <button type="button" id="edit_barang_kategori" class="btn btn-flat btn-success">
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
            var table = $('#barang_kategori_table').removeAttr('width').DataTable({
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
                    "url": '<?php echo base_url("/barang_kategori/getDataBarangKategori") ?>',
                    "type": "POST",
                    "dataType": "json",
                    async: "true"
                }
            });
        });

        $(document).on('click', '#tambah_barang_kategori', function() {
            var bkategori_nama = $('#bkategori_nama').val()

            if (bkategori_nama == null) {
                alert('Harap isi nama kategori terlebih dahulu')
            } else {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('barang_kategori/save') ?>',
                    data: {
                        'bkategori_nama': bkategori_nama,
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success) {
                            // dibawah ini working code
                            $('#barang_kategori_table').DataTable().ajax.reload(null, false).draw(false);
                            alert('Kategori barang baru telah berhasil ditambahkan')
                            // $('#validation-msg').val(result.messages)
                            $('#validation-msg').html(Object.values(result.messages).join("<br>"))
                            $('#modal-tambah-barang-kategori').modal('hide')
                            $('#validation-div').hide()
                            // location.href = '<?= site_url('stock_out') ?>'
                            clear_input_form()
                        } else {
                            alert('Gagal menambahkan kategori barang')
                            $('#validation-div').show()
                            $('#validation-msg').html(Object.values(result.messages).join("<br>"))

                            console.log(Object.values(result.messages))
                        }
                    }
                })
            }
        });

        function clear_input_form() {
            $('#bkategori_nama').val("")
        }

        $(document).on('click', '#update_barang_kategori', function() {
            $('#bkategori_id').val($(this).data('bkategori_id'));
            $('#bkategori_nama_edit').val($(this).data('bkategori_nama_old'));
            var k = $(this).data('bkategori_id');
            console.log("bkategori_id: " + k);
        })

        $(document).on('click', '#edit_barang_kategori', function() {

            var bkategori_id = $('#bkategori_id').val()
            console.log(bkategori_id)
            // var pelanggan_nama = 'singkong'
            var bkategori_nama = $('#bkategori_nama_edit').val()

            $.ajax({
                type: 'POST',
                url: '<?= site_url('barang_kategori/edit') ?>',
                data: {
                    'bkategori_id': bkategori_id,
                    'bkategori_nama': bkategori_nama,
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        $('#barang_kategori_table').DataTable().ajax.reload(null, false).draw(false);
                        alert('Kategori barang berhasil diubah')
                        $('#modal-edit-barang-kategori').modal('hide')
                        $('#edit-validation-msg').html(Object.values(result.messages).join("<br>"))
                        $('#edit-validation-div').hide()
                    } else {
                        alert('Kategori barang gagal diubah')
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

        $(document).on('click', '#hapus_barang_kategori', function() {
            if (confirm('Yakin hapus data ini?')) {
                var bkategori_id = $(this).data('bkategori_id');

                // var supp_nama = $(this).data('supp_nama');
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('barang_kategori/delete') ?>',
                    data: {
                        'bkategori_id': bkategori_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            $('#barang_kategori_table').DataTable().ajax.reload(null, false).draw(false);
                            alert('Berhasil hapus kategori barang');

                            // location.href = '<?= site_url('stock_out') ?>'
                        } else {
                            alert('Gagal hapus kategori barang');
                        }
                    }
                })
            }
        })
    </script>


    <?= $this->endSection() ?>