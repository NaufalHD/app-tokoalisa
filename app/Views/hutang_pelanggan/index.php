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
                <h2>pemilik?: <?= session()->get('user_isowner'); ?></h2>
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
            <!-- <a href="/hutang_pelanggan/create" class="btn btn-primary mt-3">Tambah Hutang Pelanggan</a> -->
            <!-- <a href="/login" class="btn btn-success mt-3">Login</a> -->
            <a href="<?= base_url(); ?>" class="btn btn-primary mt-3">Home</a>
            <!-- <a href="/hutang_pelanggan/bayar_hutang_total" class="btn btn-primary mt-3">Bayar Hutang Total</a> -->
            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-bayar-hutang-total">
                Bayar Hutang Total
            </button>
            <!-- <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-tambah-hutang-pelanggan">
                Tambah Hutang Pelanggan
            </button> -->

            <h1 class="mt-3">
                Daftar Hutang Pelanggan
            </h1>

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <!-- mb is margin bottom -->

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="hutang_pelanggan_table" width="100%">
                    <thead>
                        <tr>
                            <!-- <th scope="col" width=1em>#</th> -->
                            <!-- <th scope="col" width=1em>ID Hutang</th> -->
                            <!-- <th scope="col">#</th> -->
                            <th scope="col">ID Hutang</th>
                            <th scope="col">Date</th>
                            <th scope="col">ID Transaksi</th>
                            <th scope="col">Nominal</th>
                            <th scope="col">Status Lunas</th>
                            <th scope="col">ID Pelanggan</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- dibawah ini untuk menampilkan pager nya secara dg pengaturan default dari CI nya -->
            <!-- <//?=$pager->links(); ?> -->


            <!-- dibawah ini pager tapi dengan tampilan yang telah dibuat di views\pagers\komik_pagination -->
            <!-- parameter (a, b) . a=nama tabel, b=nama file paginationnya -->
            <!-- <div scope="row">
                <//?= $pager->links('komik', 'komik_pagination'); ?>
            </div> -->

            <!-- Modal tambah pelanggan -->
            <div class="modal fade" id="modal-tambah-hutang-pelanggan">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Hutang Baru</h4>
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
                        </div>
                        <div class="modal-footer">
                            <div class="float-right">
                                <button type="button" id="tambah_hutang_pelanggan" class="btn btn-flat btn-success">
                                    <!-- <button type="submit" id="tambah_pelanggan" class="btn btn-flat btn-success"> -->
                                    <i class="fas fa-paper-plane"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>

            </div>

            <!-- Modal edit hutang pelanggan -->
            <div class="modal fade" id="modal-edit-hutang-pelanggan">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-tittle">Edit Hutang Pelanggan</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="hutang_idpelanggan">
                            <div class="form-group">
                                <label for="nama">ID Hutang</label>
                                <!-- <input type="hidden" id="pelanggan_id"> -->
                                <input type="hidden" id="hutang_id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="hutang_id_edit" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telp">ID Transaksi</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="hutang_transaksi_id_edit" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Tanggal</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="date" id="hutang_date_edit" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Nama Pelanggan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="hutang_nama_pelanggan_edit" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">ID Pelanggan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="hutang_idpelanggan_edit" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telp">Nominal</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="number" id="hutang_nominal_edit" class="form-control" min=0>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="hutang_catatan_edit" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-2" id="edit-validation-div" style="display:none;">
                                <div class="row border border-danger rounded">
                                    <div class="col-md-12 ">
                                        <div id="edit-validation-msg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="float-right">
                                <button type="button" id="edit_hutang_pelanggan" class="btn btn-flat btn-success">
                                    <i class="fas fa-paper-plane"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal bayar hutang total -->
            <div class="modal fade" id="modal-bayar-hutang-total">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Bayar Hutang Total</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group my-4">
                                <table width="100%">
                                    <tr>
                                        <div class="form-group input-group">
                                            <!-- <input type="hidden" id="pelanggan_id_bayar_total"> -->
                                            <div class="d-grid gap-2 col-6 mx-auto">
                                                <button type="button" class="btn btn-outline-info btn-lg" style="color: black;" data-bs-toggle="modal" data-bs-target="#modal-daftar-pelanggan">Pilih Pelanggan</button>
                                            </div>
                                        </div>
                                    </tr>
                                </table>
                            </div>
                            <div class="form-group">
                                <label for="product_item">ID Pelanggan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="pelanggan_id_bayar" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Nama Pelanggan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="pelanggan_nama_bayar" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Alamat Pelanggan</label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" id="pelanggan_alamat_bayar" class="form-control" readonly>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_item">Total Hutang</label>
                                <div class="row" align="right">
                                    <div class="col-md-12">
                                        <!-- <input type="number" id="pelanggan_alamat" class="form-control" readonly> -->
                                        <h4><b><span id="nominal_hutang_total_bayar" style="font-size: 25pt">0</span></b></h4>
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
                                <button type="button" id="lunasi_hutang_total" class="btn btn-flat btn-success">
                                    <!-- <button type="submit" id="tambah_pelanggan" class="btn btn-flat btn-success"> -->
                                    <i class="fas fa-paper-plane"></i> Bayar Lunas
                                </button>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>

            </div>

            <!-- modal daftar pelanggan -->
            <div class="modal fade" id="modal-daftar-pelanggan">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-tittle">Pilih Pelanggan</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </div>
                        <div class="modal-body table-responsive">
                            <table class="table table-bordered table-striped" id="table1" width="100%">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Nama</td>
                                        <td>Telp</td>
                                        <td>Alamat</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pelanggan as $data) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data->pelanggan_nama ?></td>
                                            <td><?= $data->pelanggan_telp ?></td>
                                            <td><?= $data->pelanggan_alamat ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-info" id="select" data-pelanggan_id="<?= $data->pelanggan_id ?>" data-pelanggan_nama="<?= $data->pelanggan_nama ?>" data-pelanggan_telp="<?= $data->pelanggan_telp ?>" data-id="<?= $data->pelanggan_id ?>" data-pelanggan_alamat="<?= $data->pelanggan_alamat ?>">
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
</div>
<?= $this->endSection(); ?>

<?= $this->section("pageScript") ?>

<script>
    // dataTables
    // inisialisasi data hutang Pelanggan
    $(function() {
        var table = $('#hutang_pelanggan_table').removeAttr('width').DataTable({
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
            // "autoWidth": true,
            "scrollY": '45vh',
            /*  */
            "scrollX": true, //enable horizontal scrolling if needed
            "scrollCollapse": false,
            "responsive": true,
            // mengambil data melalui ajax
            "ajax": {
                "url": '<?php echo base_url("/hutang_pelanggan/getDataHutangPelanggan") ?>',
                "type": "POST",
                "dataType": "json",
                async: "true"
            },

            // Column definitions with render function
            "columnDefs": [{
                    "targets": [4], // Index of the "is_lunas" column
                    "render": function(data, type, row, meta) {
                        if (data === "1") {
                            return '<span class="badge text-bg-success">Lunas</span>';
                        }
                        // Return the original data if the condition is not met
                        // return data;
                        return '<span class="badge text-bg-secondary">Belum<br>Lunas</span>';
                    }
                },
                {
                    "targets": [2], // Index of the other column
                    "render": function(data, type, row, meta) {
                        if (data == null) {
                            // Return the original 
                            // return data;
                            return '-';
                        }
                        // return '<a href="#">Your Link</a>';
                        return '<a href="#" id="transaksi_link" class="link-class" data-transaksi_id="' + data + '">' + data + '</a>';
                    }
                },
            ],
            "drawCallback": function(settings) {
                $('#hutang_pelanggan_table td:nth-child(5)').css('text-align', 'center');
                $('#hutang_pelanggan_table td:nth-child(3)').css('text-align', 'center');

            },
            "order": [
                [1, 'desc']
            ],

        });
        $('#hutang_pelanggan_table td:nth-child(5)').css('text-align', 'center');
    });

    $(document).on('click', '#select', function() {
        // $('#pelanggan_id_bayar_total').val($(this).data('pelanggan_id'));
        $('#pelanggan_id_bayar').val($(this).data('pelanggan_id'));
        $('#pelanggan_nama_bayar').val($(this).data('pelanggan_nama'));
        $('#pelanggan_telp_bayar').val($(this).data('pelanggan_telp'));
        $('#pelanggan_alamat_bayar').val($(this).data('pelanggan_alamat'));
        $('#modal-daftar-pelanggan').modal('hide');
        $('#modal-bayar-hutang-total').modal('show');

        sum_nominal_hutang_total_bayar($(this).data('pelanggan_id'));
        // console.log("hello");
        console.log($(this).data('pelanggan_id'));
    })

    function sum_nominal_hutang_total_bayar(pelanggan_id) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('hutang_pelanggan/sum_nominal_hutang_total_bayar') ?>',
            data: {
                'pelanggan_id': pelanggan_id
            },
            dataType: 'json',
            success: function(result) {
                // $('#nominal_hutang_total_bayar').val(result.data);
                $('#nominal_hutang_total_bayar').text(result.data);
                // alert(result.data);
            }
        })
    }

    $(document).on('click', '#lunasi_hutang_total', function() {
        if (confirm('Apakah uang yang dibayarkan sudah sesuai nominal total?')) {
            // pakai cara dibawah ini bisa juga, untuk ngambil value dari sebuah elemen
            var temp_variable_1 = document.getElementById("pelanggan_id_bayar");
            var pelanggan_id_bayar = temp_variable_1.value;
            // console.log(pelanggan_id_bayar);

            bayar_hutang_total(pelanggan_id_bayar);
            // console.log(pelanggan_id_bayar);
            // console.log(1523);
        }
    })

    function bayar_hutang_total(pelanggan_id) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('hutang_pelanggan/bayar_hutang_total') ?>',
            data: {
                'pelanggan_id': pelanggan_id
            },
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    $('#hutang_pelanggan_table').DataTable().ajax.reload(null, false).draw(false);
                    alert('Berhasil bayar lunas hutang pelanggan');
                    clear_input_form_hutang_total();
                    $('#modal-bayar-hutang-total').modal('hide');
                } else {
                    alert('Gagal bayar hutang pelanggan');
                }

            }
        })
    }

    $(document).on('click', '#TEST_tambah_hutang_pelanggan', function() {

        $.ajax({
            type: 'POST',
            url: '<?= site_url('hutang_pelanggan/b') ?>',
            data: {},
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    alert('BRA')
                    alert('tempA: ' + JSON.stringify(result.tempA))
                    alert('tempB: ' + JSON.stringify(result.tempB))
                    window.open('<?= site_url('transaksi/cetak/') ?>' + result.transaksi_id, '_blank')
                } else {
                    alert('BRA')
                    alert('tempA: ' + JSON.stringify(result.tempA))
                    alert('tempB: ' + JSON.stringify(result.tempB))
                }
            }
        })


    });

    $(document).on('click', '#edit_hutang_pelanggan', function() {

        var hutang_id = $('#hutang_id').val()
        console.log(hutang_id)
        // var pelanggan_nama = 'singkong'
        var hutang_date = $('#hutang_date_edit').val()
        var hutang_nominal = $('#hutang_nominal_edit').val()
        var hutang_catatan = $('#hutang_catatan_edit').val()
        var hutang_transaksi_id = $('#hutang_transaksi_id_edit').val()
        if (hutang_nominal < 0) {
            alert('Nominal tidak valid')
        } else {
            $.ajax({
                type: 'POST',
                url: '<?= site_url('hutang_pelanggan/edit') ?>',
                data: {
                    'hutang_id': hutang_id,
                    'hutang_date': hutang_date,
                    'hutang_nominal': hutang_nominal,
                    'hutang_catatan': hutang_catatan,
                    'hutang_transaksi_id': hutang_transaksi_id,
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        $('#hutang_pelanggan_table').DataTable().ajax.reload(null, false).draw(false);
                        if (hutang_nominal == 0) {
                            alert('Hutang pelanggan telah lunas')
                        } else {
                            alert('Data hutang pelanggan berhasil diubah')
                        }
                        $('#modal-edit-hutang-pelanggan').modal('hide')
                        $('#edit-validation-msg').html(Object.values(result.messages).join("<br>"))
                        $('#edit-validation-div').hide()
                    } else {
                        alert('Data hutang pelanggan gagal diubah')
                        $('#edit-validation-div').show()
                        $('#edit-validation-msg').html(Object.values(result.messages).join("<br>"))
                    }
                }

            })
        }


        // }
    })

    $(document).on('click', '#update_hutang_pelanggan', function() {
        $('#hutang_id').val($(this).data('hutang_id'));
        $('#hutang_id_edit').val($(this).data('hutang_id_edit'));
        $('#hutang_date_edit').val($(this).data('hutang_date_edit'));
        $('#hutang_nominal_edit').val($(this).data('hutang_nominal_edit'));
        $('#hutang_catatan_edit').val($(this).data('hutang_catatan_edit'));
        $('#hutang_nama_pelanggan_edit').val($(this).data('hutang_nama_pelanggan_edit'));
        $('#hutang_idpelanggan_edit').val($(this).data('hutang_idpelanggan_edit'));
        $('#hutang_transaksi_id_edit').val($(this).data('hutang_transaksi_id_edit'));

        var k = $(this).data('hutang_id');
        console.log('hutang_id edited: ' + k);
    })

    $(document).on('click', '#hapus_hutang_pelanggan', function() {
        if (confirm('Yakin hapus hutang pelanggan ini?')) {
            var hutang_id = $(this).data('hutang_id');

            // var pelanggan_nama = $(this).data('pelanggan_nama');
            // var pelanggan_id = 15;

            // console.log("pelanggan_id = " + pelanggan_id);
            // console.log("konsol");
            $.ajax({
                type: 'POST',
                url: '<?= site_url('hutang_pelanggan/delete') ?>',
                data: {
                    // dibawah ini ubahan
                    // 'id_pelanggan': id_pelanggan

                    'hutang_id': hutang_id
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        // dibawah ini kode working
                        $('#hutang_pelanggan_table').DataTable().ajax.reload(null, false).draw(false);
                        alert('Berhasil hapus data hutang pelanggan');
                        // $('#modal-hapus-pelanggan').modal('hide')
                        // window.location = "pelanggan";

                    } else {
                        alert('Gagal hapus data hutang pelanggan');
                    }
                }
            })
        }
    })

    function clear_input_form_hutang_total() {
        $('#pelanggan_id_bayar').val("");
        $('#pelanggan_nama_bayar').val("");
        $('#pelanggan_telp_bayar').val("");
        $('#pelanggan_alamat_bayar').val("");
        $('#nominal_hutang_total_bayar').text(0);
    }

    $(document).on('click', '#transaksi_link', function() {
        var transaksi_id = $(this).data('transaksi_id');

        window.open('<?= site_url('transaksi/cetak_no_print/') ?>' + transaksi_id, '_blank');
    })
</script>


<?= $this->endSection() ?>