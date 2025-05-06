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
                Daftar Supplier
            </h1>

            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-tambah-supplier">
                Tambah Supplier
            </button>
            <br><br>

            <!-- <h1 class="mt-3">
                Daftar Supplier
            </h1> -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <!-- mb is margin bottom -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="supplier_table" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">ID</th>
                            <th scope="col">Produk</th>
                            <th scope="col">Telp</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <!-- Modal tambah supplier -->
            <div class="modal fade" id="modal-tambah-supplier">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Supplier Baru</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- <input type="hidden" id="user_id"> -->
                            <!-- <form action=""> -->
                            <div class="form-group">
                                <label for="product_item">Nama Supplier</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="supp_nama" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Produk</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="supp_namaproduk" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Telp</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="supp_telp" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Alamat</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="supp_alamat" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Catatan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="supp_catatan" rows="3" class="form-control"></textarea>
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
                                <button type="button" id="tambah_supplier" class="btn btn-flat btn-success">
                                    <!-- <button type="submit" id="tambah_pelanggan" class="btn btn-flat btn-success"> -->
                                    <i class="fas fa-paper-plane"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>

            </div>

            <!-- Modal edit supplier -->
            <div class="modal fade" id="modal-edit-supplier">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-tittle">Edit User</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="product_item">ID</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="supp_id" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Nama Supplier</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="supp_nama_edit" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Produk</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="supp_namaproduk_edit" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Telp</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="supp_telp_edit" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Alamat</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="supp_alamat_edit" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Catatan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="supp_catatan_edit" rows="3" class="form-control"></textarea>
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
                                <button type="button" id="edit_supplier" class="btn btn-flat btn-success">
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
        // inisialisai data supplier
        $(function() {
            var table = $('#supplier_table').removeAttr('width').DataTable({
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
                    "url": '<?php echo base_url("/supplier_contact/getDataSupplier") ?>',
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

        $(document).on('click', '#tambah_supplier', function() {
            var supp_nama = $('#supp_nama').val()
            var supp_namaproduk = $('#supp_namaproduk').val()
            var supp_telp = $('#supp_telp').val()
            var supp_alamat = $('#supp_alamat').val()
            var supp_catatan = $('#supp_catatan').val()

            console.log("nama supp: " + supp_nama)
            //kondisi jika nama pelanggan kosong program akan memunculkan alert untuk memasukan nama terlebih dahulu
            // if (user_nama == null || user_nama == '') {
            // alert('Harap memasukan nama user terlebih dahulu')

            //kondisi jika nama pelanggan sudah diisi oleh user
            $.ajax({
                type: 'POST',
                url: '<?= site_url('supplier_contact/save') ?>',
                data: {
                    'supp_nama': supp_nama,
                    'supp_namaproduk': supp_namaproduk,
                    'supp_telp': supp_telp,
                    'supp_alamat': supp_alamat,
                    'supp_catatan': supp_catatan,
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        // dibawah ini working code
                        $('#supplier_table').DataTable().ajax.reload(null, false).draw(false);
                        alert('Data supplier baru berhasil ditambahkan')
                        // $('#validation-msg').val(result.messages)
                        $('#validation-msg').html(Object.values(result.messages).join("<br>"))
                        $('#modal-tambah-supplier').modal('hide')
                        $('#validation-div').hide()
                        clear_input_form()

                        // window.location = "pelanggan";
                    } else {
                        alert('Gagal menambahkan supplier')
                        // dibawah ini works alhamdulillah
                        // alert(JSON.stringify(result.messages))
                        $('#validation-div').show()
                        $('#validation-msg').html(Object.values(result.messages).join("<br>"))

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
        });

        function clear_input_form() {
            $('#supp_nama').val("")
            $('#supp_namaproduk').val("")
            $('#supp_telp').val("")
            $('#supp_alamat').val("")
            $('#supp_catatan').val("")
        }

        $(document).on('click', '#update_supplier', function() {
            $('#supp_id').val($(this).data('supp_id'));
            $('#supp_nama_edit').val($(this).data('supp_nama_old'));
            $('#supp_namaproduk_edit').val($(this).data('supp_namaproduk_old'));
            $('#supp_telp_edit').val($(this).data('supp_telp_old'));
            $('#supp_alamat_edit').val($(this).data('supp_alamat_old'));
            $('#supp_catatan_edit').val($(this).data('supp_catatan_old'));

            var k = $(this).data('supp_id');
            console.log('supp_id edited: ' + k);

            // $('#NASIBAKAR').val($(this).data('pelanggan_id'));

            // console.log('consolelog2: ' + $('#pelanggan_id').val());
            // $('#modal-user-edit').modal('hide');
        })

        $(document).on('click', '#edit_supplier', function() {

            var supp_id = $('#supp_id').val()
            var supp_nama = $('#supp_nama_edit').val()
            var supp_namaproduk = $('#supp_namaproduk_edit').val()
            var supp_telp = $('#supp_telp_edit').val()
            var supp_alamat = $('#supp_alamat_edit').val()
            var supp_catatan = $('#supp_catatan_edit').val()

            console.log(supp_id)

            $.ajax({
                type: 'POST',
                url: '<?= site_url('supplier_contact/edit') ?>',
                data: {
                    'supp_id': supp_id,
                    'supp_nama': supp_nama,
                    'supp_namaproduk': supp_namaproduk,
                    'supp_telp': supp_telp,
                    'supp_alamat': supp_alamat,
                    'supp_catatan': supp_catatan,
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        $('#supplier_table').DataTable().ajax.reload(null, false).draw(false);
                        // calculate();
                        alert('Data supplier berhasil diubah')
                        $('#modal-edit-supplier').modal('hide')
                        $('#edit-validation-msg').html(Object.values(result.messages).join("<br>"))
                        $('#edit-validation-div').hide()
                    } else {
                        alert('Data supplier gagal diubah')
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

        $(document).on('click', '#hapus_supplier', function() {
            if (confirm('Yakin hapus supplier ini?')) {
                var supp_id = $(this).data('supp_id');

                var supp_nama = $(this).data('supp_nama');
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('supplier_contact/delete') ?>',
                    data: {
                        'supp_id': supp_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            // dibawah ini kode working
                            $('#supplier_table').DataTable().ajax.reload(null, false).draw(false);
                            alert('Berhasil hapus data supplier');
                            // $('#modal-hapus-pelanggan').modal('hide')
                            // window.location = "pelanggan";

                            // calculate();

                        } else {
                            alert('Gagal hapus data supplier');
                        }
                    }
                })
            }
        })
    </script>


    <?= $this->endSection() ?>