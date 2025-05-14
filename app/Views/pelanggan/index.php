<?= $this->extend('layout/template'); ?>
<? //php session_start(); 
?>
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

        <?php
        // $b = 0;
        // if (!$b) {
        //     dd("first");
        // } else {
        //     dd("second");
        // }
        // dd(!$b);
        ?>

        <?php if (session()->islogin) { ?>
            <div class="my-5">
                <h2>Username: <?= session()->get('username'); ?></h2>
                <br><br>
                <h2>pemilik?: <?= session()->get('user_isowner'); ?></h2>
                <br>
                <a href="/logout" class="btn btn-danger mt-3">Logout</a>
            </div>
        <?php } ?>


        <br>
        <!-- <div class="col-6">
            <form>
                <div class="input-group mb-3">
                    <input type="text" name="keyword" class="form-control" placeholder="Masukkan input pencarian disini cuyyy" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Cari Cuy</button>
                </div>
            </form>
        </div> -->
        <!-- <div class="row">
            <div class="col-6">
                <form action="" method="GET">
                    <input type="date" name="input-date-begin" required>
                    <input type="date" name="input-date-end" required>
                    <button class="btn btn-outline-secondary" type="submit" name="submit">DATE Search</button>
                </form>
            </div>
        </div> -->
        <br>

    </div>

    <div class="row">
        <div class="col">
            <!-- <a href="/pelanggan/create" class="btn btn-primary mt-3">Tambah Pelanggan Baru</a> -->
            <!-- <a href="/login" class="btn btn-success mt-3">Login</a> -->
            <a href="<?= base_url(); ?>" class="btn btn-primary mt-3">Home</a>


            <!-- <button id="btn_modal_tambah_pelanggan" class="btn btn-primary mt-3">Open Modal</button> -->

            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-tambah-pelanggan">
                Tambah Pelanggan
            </button>

            <h1 class="mt-3">
                Daftar Pelanggan
            </h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <!-- mb is margin bottom -->

            <!-- <table class="table"> -->
            <!-- <table class="table" width="100%"> -->

            <!-- tempat table thead, tbody ny melalui js dan ajax -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="pelanggan_table" width="100%">
                    <thead>
                        <tr>
                            <th scope="col" width=1em>#</th>
                            <!-- <th scope="col" width=1em>ID</th> -->
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Telp</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>

                    <!-- dibawah ini tbody utk data2 yang sifatnya object, seperti punya mas jul -->

                    <tbody>

                    </tbody>
                </table>
            </div>


            <!-- Modal tambah pelanggan -->
            <div class="modal fade" id="modal-tambah-pelanggan">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Pelanggan Baru</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- <input type="hidden" id="cartid_item"> -->
                            <!-- <form action=""> -->
                            <div class="form-group">
                                <label for="product_item">Nama Pelanggan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="pelanggan_nama" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">No Telp</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="pelanggan_telp" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Alamat</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="pelanggan_alamat" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Catatan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="pelanggan_catatan" rows="3" class="form-control"></textarea>
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
                                <button type="button" id="tambah_pelanggan" class="btn btn-flat btn-success">
                                    <!-- <button type="submit" id="tambah_pelanggan" class="btn btn-flat btn-success"> -->
                                    <i class="fas fa-paper-plane"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>

            </div>

            <!-- Modal edit pelanggan -->
            <div class="modal fade" id="modal-edit-pelanggan">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-tittle">Edit Pelanggan</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="pelanggan_id">
                            <div class="form-group">
                                <label for="nama">Nama Pelanggan</label>
                                <!-- <input type="hidden" id="pelanggan_id"> -->
                                <input type="hidden" id="pelanggan_id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="pelanggan_nama_edit_old" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="pelanggan_nama_edit" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telp">Telp</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="pelanggan_telp_edit" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="pelanggan_alamat_edit" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="pelanggan_catatan_edit" rows="3" class="form-control"></textarea>
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
                                <button type="button" id="edit_pelanggan" class="btn btn-flat btn-success">
                                    <i class="fas fa-paper-plane"></i> Simpan
                                </button>
                            </div>
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
    // inisialisai data pelanggan
    $(function() {
        var table = $('#pelanggan_table').removeAttr('width').DataTable({
            "paging": false,
            "length": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "scrollY": '45vh',
            /*  */
            "scrollX": true,
            "scrollCollapse": false,
            "responsive": true,
            // mengambil data melalui ajax
            "ajax": {
                "url": '<?php echo base_url("/pelanggan/getDataPelanggan") ?>',
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

    // When the user clicks on the button, open the modal
    // btn_modal_1.onclick = function() {
    //     modal_1.style.display = "block";
    // }

    // When the user clicks on <span> (x), close the modal
    // span.onclick = function() {
    //     modal_1.style.display = "none";
    // }

    // // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    //     if (event.target == modal) {
    //         modal_1.style.display = "none";
    //     }
    // }



    $(document).on('click', '#tambah_pelanggan', function() {
        var pelanggan_nama = $('#pelanggan_nama').val()
        console.log(pelanggan_nama)
        var pelanggan_telp = $('#pelanggan_telp').val()
        var pelanggan_alamat = $('#pelanggan_alamat').val()
        var pelanggan_catatan = $('#pelanggan_catatan').val()

        // if ( harga == '' || harga == 0) {
        //     alert('Harga tidak boleh kosong')
        //     $('#harga_item').focus()
        // } else if (qty == '' || qty < 1) {
        //     alert('Qty tidak boleh kosong')
        //     $('#qty_item').focus();
        // } else if (parseInt(qty) > parseInt(stock)) {
        //     alert("Stok tidak mencukupi")
        //     $('#qty_item').focus();
        // } else {

        //kondisi jika nama pelanggan kosong program akan memunculkan alert untuk memasukan nama terlebih dahulu
        // if (pelanggan_nama == null || pelanggan_nama == '') {
        //     alert('Harap memasukan nama pelanggan terlebih dahulu')
        // } else {
        //kondisi jika nama pelanggan sudah diisi oleh user
        $.ajax({
            type: 'POST',
            url: '<?= site_url('pelanggan/save') ?>',
            data: {
                'pelanggan_nama': pelanggan_nama,
                'pelanggan_telp': pelanggan_telp,
                'pelanggan_alamat': pelanggan_alamat,
                'pelanggan_catatan': pelanggan_catatan,
            },
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('#pelanggan_table').DataTable().ajax.reload(null, false).draw(false);
                    alert('Pelanggan baru berhasil ditambahkan')
                    // $('#validation-msg').val(result.messages)
                    $('#validation-msg').html(Object.values(result.messages).join("<br>"))
                    $('#modal-tambah-pelanggan').modal('hide')
                    $('#validation-div').hide()
                    clear_input_form()
                } else {
                    alert('Gagal menambahkan pelanggan')
                    $('#validation-div').show()
                    $('#validation-msg').html(Object.values(result.messages).join("<br>"))
                    console.log(Object.values(result.messages))
                }
            }
        })
        // }

    });

    function clear_input_form() {
        $('#pelanggan_nama').val("");
        $('#pelanggan_telp').val("");
        $('#pelanggan_alamat').val("");
        $('#pelanggan_catatan').val("");
    }

    $(document).on('click', '#update_pelanggan', function() {
        $('#pelanggan_id').val($(this).data('pelanggan_id'));
        $('#pelanggan_nama_edit_old').val($(this).data('pelanggan_nama_old'));
        $('#pelanggan_telp_edit').val($(this).data('pelanggan_telp_old'));
        $('#pelanggan_alamat_edit').val($(this).data('pelanggan_alamat_old'));
        $('#pelanggan_catatan_edit').val($(this).data('pelanggan_catatan_old'));
        // $('#pelanggan_catatan_old').val($(this).data('pelanggan_catatan_old'));

        var k = $(this).data('pelanggan_id');
        // console.log(k);
        console.log('consolelog1: ' + $(this).data('pelanggan_id'));

        // $('#NASIBAKAR').val($(this).data('pelanggan_id'));

        console.log('consolelog2: ' + $('#pelanggan_id').val());
        $('#modal-pelanggan-edit').modal('hide');
    })

    $(document).on('click', '#edit_pelanggan', function() {
        // console.log(k);
        // console.log($(this).data('pelanggan_id'))
        // var pelanggan_id = $('#pelanggan_id').val()

        var pelanggan_id = $('#pelanggan_id').val()
        console.log(pelanggan_id)
        // var pelanggan_nama = 'singkong'
        var pelanggan_nama = $('#pelanggan_nama_edit').val()
        var pelanggan_telp = $('#pelanggan_telp_edit').val()
        var pelanggan_alamat = $('#pelanggan_alamat_edit').val()
        var pelanggan_catatan = $('#pelanggan_catatan_edit').val()

        // if (harga == '' || harga == 0) {
        //     alert('Harga tidak boleh kosong')
        //     $('#harga_item').focus()
        // } else if (qty == '' || qty < 1) {
        //     alert('Qty tidak boleh kosong')
        //     $('#qty_item').focus();
        // } else if (parseInt(qty) > parseInt(stock)) {
        //     alert("Stok tidak mencukupi")
        //     $('#qty_item').focus();
        // } else {
        $.ajax({
            type: 'POST',
            url: '<?= site_url('pelanggan/edit') ?>',
            data: {
                'pelanggan_id': pelanggan_id,
                'pelanggan_nama': pelanggan_nama,
                // 'pelanggan_nama': 'bambu',
                'pelanggan_telp': pelanggan_telp,
                'pelanggan_alamat': pelanggan_alamat,
                'pelanggan_catatan': pelanggan_catatan,
            },
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('#pelanggan_table').DataTable().ajax.reload(null, false).draw(false);
                    // calculate();
                    alert('Data pelanggan berhasil dirubah')
                    $('#modal-edit-pelanggan').modal('hide')
                    $('#edit-validation-msg').html(Object.values(result.messages).join("<br>"))
                    clear_input_form()
                } else {
                    alert('Data pelanggan gagal dirubah')
                    $('#edit-validation-div').show()
                    $('#edit-validation-msg').html(Object.values(result.messages).join("<br>"))


                    // $('#SebuahDivUtkPesanError').val($(this).data());
                    // $('#modal-edit-pelanggan').modal('hide')
                }
            }

        })
        // }
    })

    $(document).on('click', '#hapus_pelanggan', function() {
        if (confirm('Yakin hapus pelanggan ini?')) {
            var pelanggan_id = $(this).data('pelanggan_id');

            var pelanggan_nama = $(this).data('pelanggan_nama');
            // var pelanggan_id = 15;

            // console.log("pelanggan_id = " + pelanggan_id);
            // console.log("konsol");
            $.ajax({
                type: 'POST',
                url: '<?= site_url('pelanggan/delete') ?>',
                data: {
                    // dibawah ini ubahan
                    // 'id_pelanggan': id_pelanggan

                    'pelanggan_id': pelanggan_id
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        // dibawah ini kode working
                        $('#pelanggan_table').DataTable().ajax.reload(null, false).draw(false);
                        alert('Berhasil hapus data pelanggan');
                        // $('#modal-hapus-pelanggan').modal('hide')
                        // window.location = "pelanggan";

                        // calculate();

                    } else {
                        alert('Gagal hapus data pelanggan');
                    }
                }
            })
        }
    })
</script>


<?= $this->endSection() ?>