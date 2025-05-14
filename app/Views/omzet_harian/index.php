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

            <!-- <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-tambah-user">
                Open Modal
            </button> -->

            <h1 class="mt-3">
                Daftar Omzet Harian
            </h1>
            <div class="row mb-2 justify-content-end">
                <form action="" method="GET">
                    <input type="date" id="start_date_omzet_harian">
                    <input type="date" id="end_date_omzet_harian">
                    <button class="btn btn-outline-secondary" id="search_range_omzet_harian" type="button">Cari Omzet</button>
                    <button class="btn btn-outline-danger" id="reset_omzet_harian" type="button">Reset</button>
                </form>
            </div>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <!-- mb is margin bottom -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="omzet_harian_table" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Nominal</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <!-- Modal tambah user -->
            <!-- <div class="modal fade" id="modal-tambah-user">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah User Baru</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
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
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Tipe User</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input id="Pengguna" name="user_isadmin" type="radio" class="form-check-input" checked required value="0">
                                            <label class="form-check-label" for="0">Pengguna</label>
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
                                    <i class="fas fa-paper-plane"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div> -->

            <!-- Modal edit omzet -->
            <div class="modal fade" id="modal-edit-omzet-harian">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-tittle">Edit Omzet Harian</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="omzet_id">
                            <div class="form-group">
                                <label for="product_item">Date</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="date" id="omzet_date_edit" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Nominal</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="number" id="omzet_nominal_edit" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Catatan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="omzet_catatan_edit" class="form-control">
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
                                <button type="button" id="edit_omzet_harian" class="btn btn-flat btn-success">
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
        var table = $('#omzet_harian_table').removeAttr('width').DataTable({
            "paging": true,
            "length": false,
            // "length": true,
            "searching": true,
            "ordering": true,
            // "lengthChange": true,
            // "lengthMenu": [2, 3, 5, 75, 100],
            "info": false,
            // "pageLength": 2,
            "pageLength": 50,
            "autoWidth": false,
            "scrollY": '45vh',
            /*  */
            "scrollX": true,
            "scrollCollapse": false,
            "responsive": true,
            // mengambil data melalui ajax
            "ajax": {
                "url": '<?php echo base_url("/omzet_harian/getDataOmzetHarian") ?>',
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

    $(document).on('click', '#search_range_omzet_harian', function() {
        // var start_date = new Date($('#start_date_omzet_harian').val())
        // var end_date = new Date($('#end_date_omzet_harian').val())
        var start_date = $('#start_date_omzet_harian').val()
        var end_date = $('#end_date_omzet_harian').val()
        //kondisi jika nama pelanggan sudah diisi oleh user
        if (end_date < start_date) {
            alert('input tanggal tidak valid')
        } else {
            $.ajax({
                url: '<?= site_url('omzet_harian/range_getDataOmzetHarian') ?>',
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
                    $('#omzet_harian_table').DataTable().clear().rows.add(data).draw();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }


    });

    $(document).on('click', '#reset_omzet_harian', function() {
        $.ajax({
            url: '<?= site_url('omzet_harian/getDataOmzetHarian') ?>',
            method: 'POST',
            data: {},
            dataType: 'json',
            success: function(response) {
                // Update the DataTable with the new data

                // $('#omzet_harian_table').DataTable().destroy()
                var data = response.data
                $('#omzet_harian_table').DataTable().clear().rows.add(data).draw();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

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
        $('#omzet_nominal_edit').val("")
        $('#omzet_catatan_edit').val("")
        // $('#user_nama').val("")
        // $('#user_telp').val("")
        // $('#user_alamat').val("")
    }

    $(document).on('click', '#update_omzet_harian', function() {
        $('#omzet_id').val($(this).data('omzet_id'));
        $('#omzet_date_edit').val($(this).data('omzet_date_old'));
        $('#omzet_nominal_edit').val($(this).data('omzet_nominal_old'));
        $('#omzet_catatan_edit').val($(this).data('omzet_catatan_old'));

        var k = $(this).data('omzet_id');
        console.log('omzet_id edited: ' + k);

        // $('#NASIBAKAR').val($(this).data('pelanggan_id'));

        // console.log('consolelog2: ' + $('#pelanggan_id').val());
        // $('#modal-user-edit').modal('hide');
    })

    $(document).on('click', '#edit_omzet_harian', function() {

        var omzet_id = $('#omzet_id').val()
        // var user_id = $(this).data('user_id')
        console.log(omzet_id)
        // var pelanggan_nama = 'singkong'
        var omzet_nominal = $('#omzet_nominal_edit').val()
        var omzet_catatan = $('#omzet_catatan_edit').val()
        // var user_nama = $('#user_nama_edit').val()
        // var user_telp = $('#user_telp_edit').val()
        // var user_alamat = $('#user_alamat_edit').val()
        // var user_isadmin = $('input[name = "user_isadmin_edit"]:checked').val()

        $.ajax({
            type: 'POST',
            url: '<?= site_url('omzet_harian/edit') ?>',
            data: {
                'omzet_id': omzet_id,
                'omzet_nominal': omzet_nominal,
                'omzet_catatan': omzet_catatan,
            },
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('#omzet_harian_table').DataTable().ajax.reload(null, false).draw(false);
                    // calculate();
                    alert('Data omzet harian berhasil diubah')
                    $('#modal-edit-omzet-harian').modal('hide')
                    $('#edit-validation-msg').html(Object.values(result.messages).join("<br>"))
                    $('#edit-validation-div').hide()
                } else {
                    alert('Data omzet gagal diubah')
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