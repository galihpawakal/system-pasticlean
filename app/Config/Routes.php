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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->resource('user');
$routes->resource('authpermission');
$routes->resource('authgroup');
$routes->resource('authgrouppermission');
$routes->resource('authgroupuser');
$routes->resource('usertoken');
$routes->resource('client');
$routes->resource('clientregion1');
$routes->resource('clientregion2');
$routes->resource('clientregion3');
$routes->resource('pengelola');
$routes->resource('pengelolaregion1');
$routes->resource('pengelolaregion2');
$routes->resource('pengelolaregion3');
$routes->resource('userclient');
$routes->resource('userpengelola');
$routes->resource('atmkategori');
$routes->resource('atmsubkategori');
$routes->resource('atmring');
$routes->resource('atmkunjungan');
$routes->resource('atmlokasi');
$routes->resource('atmtid');
$routes->resource('checklist');
$routes->resource('snapshoot');
$routes->resource('kunjungan');
$routes->resource('kunjunganchecklist');
$routes->resource('kunjungansnapshoot');
$routes->resource('kunjunganattach');
$routes->resource('atmproblem');
$routes->resource('atmaudit');
$routes->resource('atmproblemattach');
$routes->resource('atmauditattach');
$routes->resource('atmproblemnoted');
$routes->resource('atmauditnoted');
$routes->resource('usertracking');
$routes->resource('atmchecker');
$routes->resource('checklistchecker');
$routes->resource('snapshootchecker');
$routes->resource('checkerreport');
$routes->resource('checkerreportcheklist');
$routes->resource('checkerreportsnapshoot');
$routes->resource('checkerreportattach');
$routes->resource('grouping');
$routes->resource('schedule');
$routes->resource('price');
$routes->resource('roomproblem');
$routes->resource('roomproblemattach');
$routes->resource('roomproblemnoted');
$routes->resource('ticket');
$routes->resource('ticketdetail');
$routes->resource('ticketpart');
$routes->resource('ticketattach');
$routes->resource('ticketnoted');
$routes->resource('ticketsnapshoot');

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
