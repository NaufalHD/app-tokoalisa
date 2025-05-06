<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.

// $routes->setAutoRoute(true);
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// dibawah ini adalah penggunaan filter yang telah dibikin cuy dari sumber
// medanincode.com . MASIHH GAGAL
// $routes->get('/', 'Home::index', ['filter' => 'authfilter']);

$routes->get('/', 'Home::index');

$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/logout', 'Logout::process');

$routes->get('/admin', 'Admin::index');
$routes->post('/admin/getDataUser', 'Admin::getDataUser');
$routes->post('/admin/create', 'Admin::create');
$routes->post('/admin/update/(:segment)', 'Admin::update/$1');
$routes->post('/admin/save', 'Admin::save');
// $routes->post('/admin/edit/(:segment)', 'Admin::edit/$1');
$routes->post('/admin/edit/', 'Admin::edit');
// $routes->delete('/admin/(:segment)', 'Admin::delete/$1');
$routes->post('/admin/delete', 'Admin::delete');

// $routes->get('/omzet_harian', 'OmzetHarian::index');
// $routes->get('/omzet_harian/create', 'OmzetHarian::create');
// $routes->post('/omzet_harian/update/(:segment)', 'OmzetHarian::update/$1');
// $routes->post('/omzet_harian/save', 'OmzetHarian::save');
// $routes->get('/omzet_harian/edit/(:segment)', 'OmzetHarian::edit/$1');
// $routes->delete('/omzet_harian/(:segment)', 'OmzetHarian::delete/$1');

$routes->get('/omzet_harian', 'OmzetHarian::index');
$routes->post('/omzet_harian/getDataOmzetHarian', 'OmzetHarian::getDataOmzetHarian');
$routes->post('/omzet_harian/range_getDataOmzetHarian', 'OmzetHarian::range_getDataOmzetHarian');
$routes->post('/omzet_harian/edit', 'OmzetHarian::edit');
// $routes->post('/barang_kategori/save', 'OmzetHarian::save');
// $routes->post('/barang_kategori/delete', 'OmzetHarian::delete');

$routes->get('/hutang_pelanggan', 'HutangPelanggan::index');
// $routes->get('/hutang_pelanggan/create', 'HutangPelanggan::create');
// $routes->post('/hutang_pelanggan/update/(:segment)', 'HutangPelanggan::update/$1');
$routes->post('/hutang_pelanggan/save', 'HutangPelanggan::save');
// $routes->get('/hutang_pelanggan/edit/(:segment)', 'HutangPelanggan::edit/$1');
// $routes->delete('/hutang_pelanggan/(:segment)', 'HutangPelanggan::delete/$1');
$routes->post('/hutang_pelanggan/getDataHutangPelanggan', 'HutangPelanggan::getDataHutangPelanggan');
$routes->post('/hutang_pelanggan/create', 'HutangPelanggan::create');
$routes->post('/hutang_pelanggan/delete', 'HutangPelanggan::delete');
$routes->post('/hutang_pelanggan/edit', 'HutangPelanggan::edit');
$routes->post('/hutang_pelanggan/bayar_hutang_total', 'HutangPelanggan::bayar_hutang_total');
$routes->post('/hutang_pelanggan/sum_nominal_hutang_total_bayar', 'HutangPelanggan::sum_nominal_hutang_total_bayar');
$routes->post('/hutang_pelanggan/b', 'HutangPelanggan::b');


$routes->get('/barang_habis', 'BarangHabis::index');
$routes->get('/barang_habis/create', 'BarangHabis::create');
$routes->post('/barang_habis/update/(:segment)', 'BarangHabis::update/$1');
$routes->post('/barang_habis/save', 'BarangHabis::save');
$routes->get('/barang_habis/edit/(:segment)', 'BarangHabis::edit/$1');
$routes->delete('/barang_habis/(:segment)', 'BarangHabis::delete/$1');

// $routes->get('/supplier_contact/getname', 'SupplierContact::autocompletesupp');


// $routes->get('/supplier_contact', 'SupplierContact::autocompletesupp');
// dd(2);

$routes->get('/coba_autocomplete', 'SupplierContact::tampilview');
$routes->get('/coba_autocomplete/fungsi', 'SupplierContact::autocompletesupp');

$routes->get('/record_transaksi', 'RecordTransaksi::index');
$routes->post('/record_transaksi/getDataTransaksi', 'RecordTransaksi::getDataTransaksi');
$routes->post('/record_transaksi/edit', 'RecordTransaksi::edit');
$routes->post('/record_transaksi/save', 'RecordTransaksi::save');
$routes->post('/record_transaksi/delete', 'RecordTransaksi::delete');
$routes->post('/record_transaksi/range_getDataTransaksi', 'RecordTransaksi::range_getDataTransaksi');
// $routes->get('/transaksi/cetak/(:segment)', 'Transaksi::cetak/$1');

$routes->get('/barang_stock', 'StokBarang::index');
$routes->post('/barang_stock/getDataBarangStock', 'StokBarang::getDataBarangStock');
$routes->post('/barang_stock/edit', 'StokBarang::edit');
$routes->post('/barang_stock/save', 'StokBarang::save');
$routes->post('/barang_stock/delete', 'StokBarang::delete');

$routes->get('/barang_kategori', 'BarangKategori::index');
$routes->post('/barang_kategori/getDataBarangKategori', 'BarangKategori::getDataBarangKategori');
$routes->post('/barang_kategori/edit', 'BarangKategori::edit');
$routes->post('/barang_kategori/save', 'BarangKategori::save');
$routes->post('/barang_kategori/delete', 'BarangKategori::delete');

$routes->get('/barang_satuan', 'BarangSatuan::index');
$routes->post('/barang_satuan/getDataBarangSatuan', 'BarangSatuan::getDataBarangSatuan');
$routes->post('/barang_satuan/edit', 'BarangSatuan::edit');
$routes->post('/barang_satuan/save', 'BarangSatuan::save');
$routes->post('/barang_satuan/delete', 'BarangSatuan::delete');

$routes->get('/stock_out', 'StockOut::index');
$routes->post('/stock_out/getDataStockOut', 'StockOut::getDataStockOut');
$routes->post('/stock_out/save', 'StockOut::save');
$routes->post('/stock_out/delete', 'StockOut::delete');

$routes->get('/stock_in', 'StockIn::index');
$routes->post('/stock_in/getDataStockIn', 'StockIn::getDataStockIn');
$routes->post('/stock_in/save', 'StockIn::save');
$routes->post('/stock_in/delete', 'StockIn::delete');

$routes->get('/supplier_contact', 'SupplierContact::index');
$routes->post('/supplier_contact/getDataSupplier', 'SupplierContact::getDataSupplier');
$routes->post('/supplier_contact/create', 'SupplierContact::create');
$routes->post('/supplier_contact/save', 'SupplierContact::save');
$routes->post('/supplier_contact/edit/', 'SupplierContact::edit');
$routes->post('/supplier_contact/delete', 'SupplierContact::delete');

$routes->get('/pelanggan', 'Pelanggan::index');
$routes->post('/pelanggan/getDataPelanggan', 'Pelanggan::getDataPelanggan');
$routes->post('/pelanggan/create', 'Pelanggan::create');
// $routes->post('/pelanggan/update/(:segment)', 'Pelanggan::update/$1');
$routes->post('/pelanggan/save', 'Pelanggan::save');
// $routes->get('/pelanggan/edit/(:segment)', 'Pelanggan::edit/$1');
// $routes->delete('/pelanggan/(:segment)', 'Pelanggan::delete/$1');
// $routes->get('/pelanggan/(:segment)', 'Pelanggan::delete/$1');
// $routes->post('/pelanggan/(:segment)', 'Pelanggan::delete/$1');
$routes->post('/pelanggan/delete', 'Pelanggan::delete');
$routes->post('/pelanggan/edit', 'Pelanggan::edit');

$routes->get('/nota_pembelian', 'NotaPembelian::index');
$routes->get('/nota_pembelian/create', 'NotaPembelian::create');
$routes->post('/nota_pembelian/update/(:segment)', 'NotaPembelian::update/$1');
$routes->post('/nota_pembelian/save', 'NotaPembelian::save');
$routes->get('/nota_pembelian/edit/(:segment)', 'NotaPembelian::edit/$1');
$routes->delete('/nota_pembelian/(:segment)', 'NotaPembelian::delete/$1');

$routes->get('/item_notapembelian/create/(:num)', 'ItemNotaPembelian::create/$1');
$routes->post('/item_notapembelian/update/(:segment)', 'ItemNotaPembelian::update/$1');
$routes->post('/item_notapembelian/save/(:segment)', 'ItemNotaPembelian::save/$1');
$routes->get('/item_notapembelian/edit/(:segment)', 'ItemNotaPembelian::edit/$1');
$routes->get('/item_notapembelian/(:num)', 'ItemNotaPembelian::detail_nota_item/$1');
// ada ubahan di delete dibawah
$routes->delete('/item_notapembelian/delete/(:segment)', 'ItemNotaPembelian::delete/$1');

$routes->get('/stok_barang', 'StokBarang::index');
$routes->get('/stok_barang/create', 'StokBarang::create');
$routes->post('/stok_barang/update/(:segment)', 'StokBarang::update/$1');
$routes->post('/stok_barang/save', 'StokBarang::save');
$routes->get('/stok_barang/edit/(:segment)', 'StokBarang::edit/$1');
$routes->delete('/stok_barang/(:segment)', 'StokBarang::delete/$1');

$routes->get('/transaksi', 'Transaksi::index');
$routes->post('/transaksi/getCartData', 'Transaksi::getCartData');
$routes->post('/transaksi/getCart', 'Transaksi::getCart');
$routes->post('/transaksi/addCart', 'Transaksi::addCart');
$routes->post('/transaksi/cart_delete', 'Transaksi::cart_delete');
$routes->post('/transaksi/edit_cart', 'Transaksi::edit_cart');
$routes->post('/transaksi/getSubTotal', 'Transaksi::getSubTotal');
$routes->post('/transaksi/prosesPembayaran', 'Transaksi::prosesPembayaran');
$routes->get('/transaksi/cetak/(:segment)', 'Transaksi::cetak/$1');
$routes->get('/transaksi/cetak_no_print/(:segment)', 'Transaksi::cetak_no_print/$1');

// getCart() getCartData() getSubTotal() addCart() cart_delete() edit_cart() prosesPembayaran() 
// cetak($id)




// $routes->get('/chutama', 'Home::chutama');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
