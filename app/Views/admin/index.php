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
            <!-- <a href="/admin/create" class="btn btn-primary mt-3">Tambah User</a> -->
            <!-- <a href="/login" class="btn btn-success mt-3">Login</a> -->
            <a href="<?= base_url(); ?>" class="btn btn-primary mt-3">Home</a>
            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-tambah-user">
                Tambah User
            </button>

            <h1 class="mt-3">
                Daftar User
            </h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <!-- mb is margin bottom -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="user_table" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Telepon</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <!-- Modal tambah user -->
            <div class="modal fade" id="modal-tambah-user">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah User Baru</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- <input type="hidden" id="user_id"> -->
                            <!-- <form action=""> -->
                            <div class="form-group">
                                <label for="product_item">Username</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="user_username" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Password</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="user_password" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Nama</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="user_nama" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Alamat</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="user_alamat" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Telp</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="user_telp" class="form-control">
                                    </div>
                                    <!-- <div class="col-md-12">
                                            <textarea id="pelanggan_catatan" rows="3" class="form-control"></textarea>
                                        </div> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Tipe User</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input id="Pengguna" name="user_isadmin" type="radio" class="form-check-input" checked required value="0">
                                            <label class="form-check-label" for="0">Pegawai</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="Admin" name="user_isadmin" type="radio" class="form-check-input" required value="1">
                                            <label class="form-check-label" for="1">Admin</label>
                                        </div>
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
                                <button type="button" id="tambah_user" class="btn btn-flat btn-success">
                                    <!-- <button type="submit" id="tambah_pelanggan" class="btn btn-flat btn-success"> -->
                                    <i class="fas fa-paper-plane"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>

            </div>

            <!-- Modal edit user -->
            <div class="modal fade" id="modal-edit-user">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-tittle">Edit User</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="user_id">
                            <div class="form-group">
                                <label for="product_item">Username</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="user_username_edit" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Password</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="user_password_edit" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Nama</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="user_nama_edit" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Alamat</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="user_alamat_edit" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Telp</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="user_telp_edit" class="form-control">
                                    </div>
                                    <!-- <div class="col-md-12">
                                            <textarea id="pelanggan_catatan" rows="3" class="form-control"></textarea>
                                        </div> -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Tipe User</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input id="Pengguna" name="user_isadmin_edit" type="radio" class="form-check-input" required value="0">
                                            <label class="form-check-label" for="0">Pegawai</label>
                                        </div>
                                        <div class="form-check">
                                            <input id="Admin" name="user_isadmin_edit" type="radio" class="form-check-input" required value="1">
                                            <label class="form-check-label" for="1">Admin</label>
                                        </div>
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
                                <button type="button" id="edit_user" class="btn btn-flat btn-success">
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
</div>
<?= $this->endSection(); ?>

<?= $this->section("pageScript") ?>



<script>
    // dataTables
    // inisialisai data user
    $(function() {
        var table = $('#user_table').removeAttr('width').DataTable({
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
                "url": '<?php echo base_url("/admin/getDataUser") ?>',
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



    $(document).on('click', '#tambah_user', function() {
        var user_username = $('#user_username').val()
        var user_password = $('#user_password').val()
        var user_nama = $('#user_nama').val()
        var user_telp = $('#user_telp').val()
        var user_alamat = $('#user_alamat').val()
        var user_isadmin = $('input[name = "user_isadmin"]:checked').val()

        // var user_isowner = $('#user_isowner').val()

        // var user_isowner = (input[name = "user_isowner"])
        // var user_isowner = $('input[name = "user_isowner"]')
        // var user_isowner = $(user_isowner)

        console.log("username: " + user_username)
        console.log("user_isadmin: " + user_isadmin)
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
        // if (user_nama == null || user_nama == '') {
        // alert('Harap memasukan nama user terlebih dahulu')
        if (1 == 2) {
            // alert('Harap memasukan nama user terlebih dahulu')
        } else {
            //kondisi jika nama pelanggan sudah diisi oleh user
            $.ajax({
                type: 'POST',
                url: '<?= site_url('admin/save') ?>',
                data: {
                    'user_username': user_username,
                    'user_password': user_password,
                    'user_nama': user_nama,
                    'user_telp': user_telp,
                    'user_alamat': user_alamat,
                    'user_isadmin': user_isadmin,
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        // dibawah ini working code
                        $('#user_table').DataTable().ajax.reload(null, false).draw(false);
                        alert('User baru berhasil ditambahkan')
                        // $('#validation-msg').val(result.messages)
                        $('#validation-msg').html(Object.values(result.messages).join("<br>"))
                        $('#modal-tambah-user').modal('hide')
                        $('#validation-div').hide()
                        clear_input_form()

                        // window.location = "pelanggan";
                    } else {
                        alert('Gagal menambahkan user')


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
        }

    });

    function clear_input_form() {
        $('#user_username').val("")
        $('#user_password').val("")
        $('#user_nama').val("")
        $('#user_telp').val("")
        $('#user_alamat').val("")
    }

    $(document).on('click', '#update_user', function() {
        $('#user_id').val($(this).data('user_id'));
        $('#user_username_edit').val($(this).data('user_username_old'));
        $('#user_password_edit').val($(this).data('user_password_old'));
        $('#user_nama_edit').val($(this).data('user_nama_old'));
        $('#user_telp_edit').val($(this).data('user_telp_old'));
        $('#user_alamat_edit').val($(this).data('user_alamat_old'));

        var k = $(this).data('user_id');
        console.log('user_id edited: ' + k);

        // $('#NASIBAKAR').val($(this).data('pelanggan_id'));

        // console.log('consolelog2: ' + $('#pelanggan_id').val());
        // $('#modal-user-edit').modal('hide');
    })

    $(document).on('click', '#edit_user', function() {

        var user_id = $('#user_id').val()
        // var user_id = $(this).data('user_id')
        console.log(user_id)
        // var pelanggan_nama = 'singkong'
        var user_username = $('#user_username_edit').val()
        var user_password = $('#user_password_edit').val()
        var user_nama = $('#user_nama_edit').val()
        var user_telp = $('#user_telp_edit').val()
        var user_alamat = $('#user_alamat_edit').val()
        var user_isadmin = $('input[name = "user_isadmin_edit"]:checked').val()

        $.ajax({
            type: 'POST',
            url: '<?= site_url('admin/edit') ?>',
            data: {
                'user_id': user_id,
                'user_username': user_username,
                'user_password': user_password,
                'user_nama': user_nama,
                'user_telp': user_telp,
                'user_alamat': user_alamat,
                'user_isadmin': user_isadmin,
            },
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('#user_table').DataTable().ajax.reload(null, false).draw(false);
                    // calculate();
                    alert('Data user berhasil diubah')
                    $('#modal-edit-user').modal('hide')
                    $('#edit-validation-msg').html(Object.values(result.messages).join("<br>"))
                    $('#edit-validation-div').hide()
                } else {
                    alert('Data user gagal diubah')
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

    $(document).on('click', '#hapus_user', function() {
        if (confirm('Yakin hapus user ini?')) {
            var user_id = $(this).data('user_id');

            var user_nama = $(this).data('user_nama');
            $.ajax({
                type: 'POST',
                url: '<?= site_url('admin/delete') ?>',
                data: {
                    'user_id': user_id
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        // dibawah ini kode working
                        $('#user_table').DataTable().ajax.reload(null, false).draw(false);
                        alert('Berhasil hapus data user');
                        // $('#modal-hapus-pelanggan').modal('hide')
                        // window.location = "pelanggan";

                        // calculate();

                    } else {
                        alert('Gagal hapus data user');
                    }
                }
            })
        }
    })
</script>


<?= $this->endSection() ?>