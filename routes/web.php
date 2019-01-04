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

use App\Models\Permission;
use  App\User;
use  App\Models\Profiles;


Config::set('debugbar.enabled', false);

Route::get('/profile/gate','ProfilController@gate');

//Debut test sur le formulaire de recherche
Route::get('/home','TestController@getSearch');
Route::match(['GET', 'POST'], '/home/search','TestController@search')->name('search');

//Fin test sur le formulaire de recherche

Route::get('/', function () {
   return view('admin.admin_login');
});

// test for pagination
Route::match(['GET', 'POST'], '/players_test/','PlayersController@pages')->name('pages');

Route::match(['GET', 'POST'], '/players_testajax','PlayersController@ajax_req')->name('ajax_req');


Auth::routes();


Route::get('/login','AdminController@index')->name('index');

//Pasword Reset Routes
Route::get('/password/reset/{token?}','Auth\ResetPasswordController@showResetForm')->name('reset');
Route::post('/admin/password/email','PasswordController@emailpassword')->name('email');
Route::match(['get', 'post'],'/admin/password/reset','PasswordController@passwordForm')->name('resetPassword');

//Profil controller


Route::post('/admin/connexion','AdminController@connexion')->name('connexion');

Route::group(['middleware'=>['auth','web','timeout']],function(){

    Route::get('/admin/dashboard','AdminController@dashboard')->name('dashboard');
    Route::resource('roles','RoleController');
    Route::get('/admin/settings','AdminController@settings')->name('settings');

	//Roles Routes
   Route::match(['GET', 'POST'], '/admin/add_role','RoleController@create')->name('add_role');
   Route::match(['GET', 'POST'], '/admin/store_role','RoleController@store')->name('store_role');
   Route::match(['GET', 'POST'], '/admin/voir_role','RoleController@index')->name('voir_role');
   Route::match(['GET', 'POST'], '/admin/edit_role/{id}','RoleController@edit')->name('edit_role');
   Route::match(['GET', 'POST'], '/admin/update_role/{id}','RoleController@update')->name('update_role');
   Route::match(['GET', 'POST'], '/admin/banRoles','RoleController@banRoles')->name('banRoles');

   Route::match(['GET', 'POST'], '/admin/delete_role/{id}','RoleController@destroy')->name('delete_role');
   Route::match(['GET', 'POST'], '/admin/habilitation_role/{id}','RoleController@habilitation')->name('habilitation_role');
   Route::match(['GET', 'POST'], '/admin/habilitationval_role/{id}','RoleController@valide_habilitation')->name('habilitation_valide');

    //Users Routes
    Route::match(['GET', 'POST'], '/admin/add_user','UserController@add')->name('add_user');
    Route::match(['GET', 'POST'], '/admin/voir_user','UserController@voir')->name('voir_user');
    Route::match(['GET', 'POST'], '/admin/edit_user/{id}','UserController@edit')->name('edit_user');
    Route::match(['GET', 'POST'], '/admin/delete_user/{id}','UserController@delete')->name('delete_user');
    Route::match(['GET', 'POST'], '/admin/detail_user/{id}','UserController@detail')->name('detail_user');

    //Droits Routes
  //  Route::match(['GET', 'POST'], '/admin/add_droit','DroitController@add')->name('add_droit');

    //Audits Routes
    Route::match(['GET', 'POST'], '/admin/audits','AuditsController@index')->name('audits');

    //Players Routes
    Route::match(['GET', 'POST'], '/admin/players_list','PlayersController@index')->name('players_list');
    Route::match(['GET', 'POST'], '/admin/players_profil/{id}','PlayersController@indexProfil')->name('players_profil');

    // Games per players
     Route::match(['GET', 'POST'], '/admin/tickets_jeux_digit/{id}','PlayersController@indexProfilJDigit')->name('profilJDigit');
     Route::match(['GET', 'POST'], '/admin/tickets_loto/{id}','PlayersController@indexProfilLoto')->name('profilLoto');
     Route::match(['GET', 'POST'], '/admin/tickets_pmualr/{id}','PlayersController@indexProfilAlr')->name('profilAlr');
     Route::match(['GET', 'POST'], '/admin/tickets_pmuplr/{id}','PlayersController@indexProfilPlr')->name('profilPlr');
     Route::match(['GET', 'POST'], '/admin/tickets_sportcash/{id}','PlayersController@indexProfilSportcash')->name('profilSportcash');



    //Tickets pris Routes
    Route::match(['GET', 'POST'], '/admin/jeuxdigitaux','TicketsPrisController@indexJeuxDigitaux')->name('jeuxdigitaux');
    Route::match(['GET', 'POST'], '/admin/lotobonheur','TicketsPrisController@indexLotoBonheur')->name('lotobonheur');
    Route::match(['GET', 'POST'], '/admin/pmualr','TicketsPrisController@indexPmuAlr')->name('pmualr');
    Route::match(['GET', 'POST'], '/admin/pmuplr','TicketsPrisController@indexPmuPlr')->name('pmuplr');
    Route::match(['GET', 'POST'], '/admin/sportcash','TicketsPrisController@indexSportcash')->name('sportcash');


        /**details **/
    Route::match(['GET', 'POST'], '/admin/detailseppl/{id}','TicketsPrisController@detailsEppl')->name('detailseppl');
    Route::match(['GET', 'POST'], '/admin/detailsloto/{id}','TicketsPrisController@detailsLotoBonheur')->name('detailsloto');
    Route::match(['GET', 'POST'], '/admin/detailspmuplr/{id}','TicketsPrisController@detailsPmuPlr')->name('detailspmuplr');
    Route::match(['GET', 'POST'], '/admin/detailssportcash/{id}','TicketsPrisController@detailsSportcash')->name('detailssportcash');
    Route::match(['GET', 'POST'], '/admin/detailspmualr/{id}','TicketsPrisController@detailsPmuAlr')->name('detailspmualr');

      /** winner waiting for payment**/
      Route::match(['GET', 'POST'], '/admin/waitWinEppl','TicketsPrisController@waitWinEppl')->name('waitWinEppl');
      Route::match(['GET', 'POST'], '/admin/waitWinLoto','TicketsPrisController@waitWinLoto')->name('waitWinLoto');
      Route::match(['GET', 'POST'], '/admin/waitWinAlr','TicketsPrisController@waitWinAlr')->name('waitWinAlr');
       Route::match(['GET', 'POST'], '/admin/waitWinPlr','TicketsPrisController@waitWinPlr')->name('waitWinPlr');
        Route::match(['GET', 'POST'], '/admin/waitWinSportcash','TicketsPrisController@waitWinSportcash')->name('waitWinSportcash');

    //En attente de paiement Routes
    Route::match(['GET', 'POST'], '/admin/paiementvalide','AttentePaiementPrisController@indexPaiementVal')->name('paiementvalide');
    Route::match(['GET', 'POST'], '/admin/atlotobonheur','AttentePaiementPrisController@indexLotoBonheur')->name('atlotobonheur');
    Route::match(['GET', 'POST'], '/admin/atpmualr','AttentePaiementPrisController@indexPmuAlr')->name('atpmualr');
    Route::match(['GET', 'POST'], '/admin/atpmuplr','AttentePaiementPrisController@indexPmuPlr')->name('atpmuplr');
    Route::match(['GET', 'POST'], '/admin/atsportcash','AttentePaiementPrisController@indexSportcash')->name('atsportcash');

    //Export Routes players
    Route::match(['GET', 'POST'], '/admin/exportex','ExportExcelController@excel')->name('exportex');
    //Export Routes loto
    Route::match(['GET', 'POST'], '/admin/exportloto','ExportExcelController@loto')->name('exportloto');
    //Export Routes alr
    Route::match(['GET', 'POST'], '/admin/exportalr','ExportExcelController@alr')->name('exportalr');
    //Export Routes plr
    Route::match(['GET', 'POST'], '/admin/exportplr','ExportExcelController@plr')->name('exportplr');
    //Export Routes sportcash
    Route::match(['GET', 'POST'], '/admin/exportsportcash','ExportExcelController@sportcash')->name('exportsportcash');

    //Gagnants jeux Routes
    Route::match(['GET', 'POST'], '/admin/gagnantsjeux','TicketsGagnantsPrisController@indexGagnantsJeux')->name('gagnantsjeux');
    Route::match(['GET', 'POST'], '/admin/galotobonheur','TicketsGagnantsPrisController@indexLotoBonheur')->name('galotobonheur');
    Route::match(['GET', 'POST'], '/admin/gapmualr','TicketsGagnantsPrisController@indexPmuAlr')->name('gapmualr');
    Route::match(['GET', 'POST'], '/admin/gapmuplr','TicketsGagnantsPrisController@indexPmuPlr')->name('gapmuplr');
    Route::match(['GET', 'POST'], '/admin/gasportcash','TicketsGagnantsPrisController@indexSportcash')->name('gasportcash');
    Route::match(['GET', 'POST'], '/admin/infosgagnant','TicketsGagnantsPrisController@indexInfosgagnant')->name('infosgagnant');

    //Sms Routes

        //mail
    Route::match(['GET', 'POST'], '/admin/smscontent','SendSmsController@index')->name('smscontent');
    Route::match(['GET', 'POST'], '/admin/sendsmscontent','SendSmsController@sendcontents')->name('sendsmscontent');
    Route::match(['GET', 'POST'], '/admin/smshistoric','SendSmsController@historic')->name('smshistoric');
    Route::match(['GET', 'POST'], '/admin/smsdetail/{id}','SendSmsController@detail')->name('smsdetail');
    Route::match(['GET', 'POST'], '/admin/sendmessage','SendSmsController@sendmessage')->name('sendmessage');
          //SMS getsms
    Route::match(['GET', 'POST'], '/admin/getsms','SendSmsController@getsms')->name('getsms');
    Route::match(['GET', 'POST'], '/admin/getsmscontent','SendSmsController@getsmscontent')->name('getsmscontent');
    Route::match(['GET', 'POST'], '/admin/getsmshistoric','SendSmsController@getsmshistoric')->name('getsmshistoric');
    Route::match(['GET', 'POST'], '/admin/getsmsdetail/{id}','SendSmsController@getsmsdetail')->name('getsmsdetail');

    //permission roles
    Route::get('service/perm/view', 'PermissionController@view');
    Route::get('service/perm/create', 'PermissionController@create');
    Route::get('service/perm/update', 'PermissionController@update');
    Route::get('service/perm/delete', 'PermissionController@delete');



});

Route::get('/admin/logout','AdminController@logout')->name('logout');





