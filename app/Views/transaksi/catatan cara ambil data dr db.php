<!-- 2 / DUA cara untuk mengambil data dari db -->

<!-- ambil data dari db, dalam bentuk array -->
<!-- CARAKU yng belajar sendiri dari sandhika galih -->

<!-- modelnya: -->
return $this->findAll();

<!-- controller:  -->
$result = $this->StokBarangModel->getStokBarang();
return $result;

<!-- ngambil di view nya -->
<tbody>
    <?php foreach ($data_row as $d) : ?>
        <tr>
            <td><?= $d['stok_id']; ?></td>
            <td><?= $d['stok_jumlah']; ?></td>
            <td><?= $d['stok_namabarang']; ?></td>
            <td><?= $d['stok_satuan']; ?></td>
            <td><?= $d['stok_harga']; ?></td>
            <td><?= $d['stok_deskripsi']; ?></td>
            <td>
                <form action="/stok_barang/edit/<?= $d['stok_id']; ?>" method="get" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="post">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </td>
            <td>
                <form action="/stok_barang/<?= $d['stok_id']; ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="delete">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?')">Delete</button>
                </form>
            </td>
        </tr>

    <?php endforeach; ?>
</tbody>


<!-- CArA KEDUA, diajarin dari mas juli. dalam bentuk object -->
<!-- controller: -->
public function getForInputGroup_Pelanggan()
{
$result = $this->PelangganModel->select()->get()->getResult();

return $result;
}

<!-- model: -->
kosong

<!-- cara ngolahnya di view -->
<select class="form-select" id="inputGroupSelect01">
    <option selected>Choose...</option>
    <?php foreach ($data_pelanggan_row as $key => $d) : ?>
        <option value=<?= $d->pelanggan_id; ?>>
            <?= $d->pelanggan_nama; ?>
        </option>

        <!-- dibawah ini -->
        <!-- $d->pelanggan_id -->

        <!-- <option value="1">One</option> -->
    <?php endforeach; ?>
</select>