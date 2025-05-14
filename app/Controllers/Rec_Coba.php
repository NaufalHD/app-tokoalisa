// aaaaaaaaaaaaaaaaaaaaaaaaaa
// $query = $this->TblpenjualandetailModel->getBstockQty($transaksi_id)->get();
$a = $this->TblpenjualandetailModel->getBstockQty($transaksi_id)->get();
$query = $a->get();
// $query = $this->TblpenjualandetailModel->getBstockQty($transaksi_id);
$results = $query->getResult();
foreach ($results as $row) {
$bstock_id = $row->bstock_id;
$qty = $row->qty;

// Use $bstock_id and $qty as needed
// $temp_variable_3 = $this->StokBarangModel->where('bstock_id', $bstock_id)->first();
// $old_stock_qty = $temp_variable_3->bstock_ready_stock;
$old_stock_qty = $this->StokBarangModel->select("bstock_ready_stock")->where("bstock_id", $bstock_id)->first();
$new_stock_qty = $old_stock_qty + $qty;
$this->StokBarangModel->where('bstock_id', $bstock_id)->set('bstock_ready_stock', $new_stock_qty)->update();
}

$query = $this->TblpenjualandetailModel->getBstockQty($transaksi_id);
$results = $query;
foreach ($results as $row) {
$bstock_id = $row->bstock_id;
$qty = $row->qty;

$old_stock_qty = $this->StokBarangModel->select("bstock_ready_stock")->where("bstock_id", $bstock_id)->first();
$new_stock_qty = $old_stock_qty + $qty;
$this->StokBarangModel->where('bstock_id', $bstock_id)->set('bstock_ready_stock', $new_stock_qty)->update();
}