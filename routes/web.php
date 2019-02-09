<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*---------- RUTAS DE LOGIN ----------------*/
Route::get('/', function () {
  return view('login');
})->name('login');

Route::post('auth', 'LoginController@login')->name('auth');
Route::post('/logout', 'LoginController@logout')->name('logout');

/* Orden trabajo */

Route::resource('/ordentrabajo','OrdenTrabajoController',['except' => ['store']]);
Route::get('ordenT/firma/{id}','OrdenTrabajoController@firma')->name('ordentrabajo.firma');
Route::post('/ordenT/signature','OrdenTrabajoController@firmaSend')->name('ordentrabajo.send');

/* Actas */
Route::resource('/actas','ActasController',['except' => ['store']]);
Route::get('actas/pdf/{id}','ActasController@pdf')->name('actas.pdf');
Route::get('actas/firma/{id}','ActasController@firma')->name('actas.firma');
Route::post('/actas/signature','ActasController@firmaSend')->name('actas.send');

Route::group(['middleware' => 'auth'], function() { //middleware auth
  /* ---- Ruta para llamar al dashboard , modificarla si es necesario ----- */
	Route::get('dashboard', 'LoginController@index')->name('dashboard');
	/* --- Usuarios ---*/
	Route::resource('/users','UserController');
	//* --- Perfil --- */
	Route::get('/perfil', 'UserController@perfil')->name('perfil');
	Route::patch('/perfil', 'UserController@update_perfil')->name('update_perfil');

	/* Empresas */
	Route::resource('/empresas','EmpresasController');

	/* Proveedores */
	Route::resource('/proveedor','ProveedoresController');

	/* Orden De Compra */
	Route::resource('/ordencompra','OrdenCompraController');
	Route::get('/orden/pdf/{id}','OrdenCompraController@pdf')->name('ordencompra.pdf');

	/* Orden Trabajo */
	Route::resource('/ordentrabajo','OrdenTrabajoController');
	Route::get('/ordent/pdf/{id}','OrdenTrabajoController@pdf')->name('ordentrabajo.pdf');
	Route::post('/mail/ordent','OrdenTrabajoController@sendEmail')->name('ordentrabajo.mail');
	/* actas*/
	Route::resource('/actas','ActasController');

	/* Guia Despacho */
	Route::resource('/guiadespacho','GuiaDespachoController');
	Route::post('/guiaDespacho/empresa','GuiaDespachoController@empresa')->name('guiadespacho.empresa');
	Route::get('/guiad/pdf/{id}','GuiaDespachoController@pdf')->name('guiadespacho.pdf');
	
});

	
