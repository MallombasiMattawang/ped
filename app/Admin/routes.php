<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    
    $router->get('/', 'HomeController@index')->name('home');
     // Allow roles `administrator` and `fo` access the routes under group.
    
    // Allow roles `administrator` and `fo` access the routes under group.
    Route::group([
        'middleware' => 'admin.permission:allow,administrator,hd-ped,witel,mitra',
    ], function ($router) {
        $router->resource('mst-projects', MstProjectController::class);
        $router->resource('mst-saps', MstSapController::class); 
       
    });
    $router->resource('mst-witels', MstWitelController::class);
   
    $router->resource('grid-assign', GridAssignController::class);
    $router->resource('ref-list-activities', RefListActivityController::class);
    $router->resource('ref-bobots', RefBobotController::class);
    $router->resource('mst-waspang-uts', MstWaspangUtController::class);
    $router->resource('tran-supervisis', TranSupervisiController::class);
    $router->resource('tran-inventory', TranInventoryController::class);
    $router->resource('tran-administrasi', TranAdministrasiController::class);
    $router->resource('user-project', UserProjectController::class);
   
    //$router->resource('log-actuals', LogActualController::class);
    $router->resource('log-actuals', TranLogActivityController::class);

    $router->resource('mst-projects2', MstProjectFormController::class);

    $router->get('import-project', 'MstProjectController@importProject');
    $router->get('import-sap', 'MstSapController@importSap');

    $router->get('api/witel', 'MstProjectController@witel');
    $router->get('api/progress-usulan', 'HomeController@progressUsulan');
    $router->get('api/progress-sap', 'HomeController@progressSap');
    $router->get('api/progress-dev', 'HomeController@progressDev');
    $router->get('api/progress-konstruksi', 'HomeController@progressKonstruksi');
    $router->get('api/progress-administrasi', 'HomeController@progressAdministrasi');
    $router->get('api/progress-golive', 'HomeController@progressGolive');
    $router->get('api/get_plan{id?}', 'HomeController@get_plan');
    $router->get('api/get_approval{id?}', 'HomeController@get_approval');
    $router->get('api/get_inventory{id?}', 'HomeController@get_inventory');
    $router->get('acc-form{id?}', 'AccProjectController@accForm');
    
    $router->get('baseline-generate{id?}', 'TranSupervisiController@baseLineActivity');
    $router->post('add-baseline', 'TranSupervisiController@baseLineActivityAdd');
    $router->post('update-baseline', 'TranSupervisiController@baseLineActivityUpdate');
    $router->post('plan-baseline', 'TranSupervisiController@baseLineActivityPlan');
    $router->post('acc-project', 'TranSupervisiController@accProcject');
    $router->post('plan-project', 'TranSupervisiController@submitPlan');
    $router->post('assign-project', 'TranSupervisiController@assignPlan');

    $router->get('plan-generate{id?}', 'TranSupervisiController@planActivity');
    $router->post('plan-submit', 'TranSupervisiController@submitPlan');

    $router->post('save-date-plan', 'TranSupervisiController@addPlanActivity');


    $router->get('add-plan{id?}/{activity?}', 'TranSupervisiController@addPlan');
    
    $router->get('actual-generate{id?}', 'TranSupervisiController@actualActivity');    
    $router->get('add-actual{id?}/{activity?}', 'TranSupervisiController@addActual');
    $router->get('add-administrasi{id?}', 'TranSupervisiController@addAdministrasi');
    $router->get('add-bast{id?}/{activity?}', 'TranAdministrasiController@addBast');
    $router->get('add-approve{id?}', 'TranSupervisiController@addApprove');
    $router->post('save-approve', 'TranSupervisiController@saveApprove');

    $router->get('administrasi-generate{id?}', 'TranAdministrasiController@administrasiGenerate');
    
    $router->get('add-document{id?}', 'TranAdministrasiController@addDocument');
    $router->post('save-administrasi', 'TranAdministrasiController@SaveApproveAdministrasi');
    $router->post('save-ttd', 'TranAdministrasiController@SaveTtdAdministrasi');
    $router->post('save-ttd-bast', 'TranAdministrasiController@SaveTtdBastAdministrasi');

    $router->get('add-waspang', 'TranSupervisiController@addWaspang');
    $router->get('add-ut', 'TranSupervisiController@addUt');

    $router->get('log-generate{id?}', 'TranLogActivityController@logActivity');    

    $router->get('widgets/tab', 'HomeController@tab');
    


});