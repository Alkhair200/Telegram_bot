<?php

use Illuminate\Support\Facades\Route;

define('PAGINATION_COUNT' , 6);
define('PAGINATION_COUNTBU' , 3);

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth' ] , function(){
    
    route::resource('states', App\Http\Controllers\StatesController::class)->except(['show']);
    route::resource('local', App\Http\Controllers\LocalController::class)->except(['show']);
    route::resource('adminUnit', App\Http\Controllers\AdministrativUnitController::class)->except(['show']);
    route::resource('work', App\Http\Controllers\WorkController::class)->except(['show']);
    route::resource('causeLawsuit', App\Http\Controllers\CauseLawsuitController::class)->except(['show']);
    route::resource('proseText', App\Http\Controllers\ProseTextController::class)->except(['show']);
    route::resource('contractSubject', App\Http\Controllers\ContractSubjectController::class)->except(['show']);
    route::resource('consultSubject', App\Http\Controllers\SubjectConsultController::class)->except(['show']);
    route::resource('users', App\Http\Controllers\UserController::class)->except(['show']);
    route::resource('lawyers', App\Http\Controllers\LawyersController::class)->except(['show']);
    route::resource('claimants', App\Http\Controllers\ClaimantsController::class)->except(['show']);
    route::resource('customers', App\Http\Controllers\CustomerController::class)->except(['show']);
    route::resource('customersTo', App\Http\Controllers\CustomerToController::class)->except(['show']);
    route::resource('judges', App\Http\Controllers\JudgesController::class)->except(['show']);
    route::resource('courts', App\Http\Controllers\CourtsController::class)->except(['show']);
    route::resource('clients', App\Http\Controllers\ClientsController::class)->except(['show']);
    route::resource('clientsTo', App\Http\Controllers\ClientsToController::class)->except(['show']);
    route::resource('witness', App\Http\Controllers\WitnessController::class)->except(['show']);
    route::resource('prosecution', App\Http\Controllers\ProsecutionController::class)->except(['show']);
    
    route::resource('sessions', App\Http\Controllers\SessionsController::class)->except(['show']);
    route::post('SessionbyMonth', [App\Http\Controllers\SessionsController::class ,'byMonth'])->name('SessionbyMonth');
    route::post('SessionByDay', [App\Http\Controllers\SessionsController::class ,'byDay'])->name('SessionByDay');
    route::get('printSession/{id}', [App\Http\Controllers\SessionsController::class ,'print'])->name('printSession');
    
    
    route::resource('sessionWitness', App\Http\Controllers\sessionsWitnessController::class)->except(['show']);
    route::resource('appeal', App\Http\Controllers\AppealController::class)->except(['show']);
    route::post('appealByMonth', [App\Http\Controllers\AppealController::class ,'byMonth'])->name('appealByMonth');
    route::get('printAppeal/{id}', [App\Http\Controllers\AppealController::class ,'print'])->name('printAppeal');

    
    route::resource('consults', App\Http\Controllers\ConsultsController::class)->except(['show']);
    route::post('consultByMonth', [App\Http\Controllers\ConsultsController::class ,'byMonth'])->name('consultByMonth');
    route::post('consultByMonth', [App\Http\Controllers\ConsultsController::class ,'byMonth'])->name('consultByMonth');
    route::post('consultByText', [App\Http\Controllers\ConsultsController::class ,'consultByText'])->name('consultByText');
    route::get('printConsult/{id}', [App\Http\Controllers\ConsultsController::class ,'print'])->name('printConsult');
    
    
    route::resource('contract', App\Http\Controllers\ContractController::class)->except(['show']);
    route::post('contractByMonth', [App\Http\Controllers\ContractController::class ,'byMonth'])->name('contractByMonth');
    route::post('contractType', [App\Http\Controllers\ContractController::class ,'contractType'])->name('contractType');
    route::post('contractByType', [App\Http\Controllers\ContractController::class ,'contractByType'])->name('contractByType');
    route::get('printContract/{id}', [App\Http\Controllers\ContractController::class ,'print'])->name('printContract');

    

    route::resource('authorization', App\Http\Controllers\AuthorizationController::class)->except(['show']);
    route::post('authorizationByMonth', [App\Http\Controllers\AuthorizationController::class ,'byMonth'])->name('authorizationByMonth');
    route::post('authorizationType', [App\Http\Controllers\AuthorizationController::class ,'byType'])->name('authorizationType');
    route::post('authorizationByType', [App\Http\Controllers\AuthorizationController::class ,'authorizationByType'])->name('authorizationByType');
    route::get('printauthorization/{id}', [App\Http\Controllers\AuthorizationController::class ,'print'])->name('printauthorization');
    
    
    route::resource('address', App\Http\Controllers\AddressController::class)->except(['show']);
    route::resource('messages', App\Http\Controllers\MessagesController::class)->except(['show']);
    route::resource('subjectAuthorization', App\Http\Controllers\SubjectAuthorizationController::class)->except(['show']);
    
    
    route::post('byMonth', [App\Http\Controllers\ProsecutionController::class , 'byMonth'])->name('byMonth');
    route::post('byAllMonth', [App\Http\Controllers\ProsecutionController::class , 'byAllMonth'])->name('byAllMonth');
    route::post('byBroseType', [App\Http\Controllers\ProsecutionController::class , 'byBroseType'])->name('byBroseType');
    route::post('getByCustomer', [App\Http\Controllers\ProsecutionController::class , 'getByCustomer'])->name('getByCustomer');
    route::post('getBySubject', [App\Http\Controllers\ProsecutionController::class , 'getBySubject'])->name('getBySubject');
    route::post('getBySubjectByTotal', [App\Http\Controllers\ProsecutionController::class , 'getBySubjectByTotal'])->name('getBySubjectByTotal');
    route::get('print/{id}', [App\Http\Controllers\ProsecutionController::class , 'print'])->name('print');
    route::get('printCustomer/{id}', [App\Http\Controllers\ProsecutionController::class , 'printCustomer'])->name('printCustomer');
    
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
