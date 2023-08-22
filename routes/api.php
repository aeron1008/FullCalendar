<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\StripeWebhook;
use Laravel\Cashier\Http\Controllers\WebhookController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Zaposlenici
    Route::apiResource('zaposlenicis', 'ZaposleniciApiController');

    // Pacjenti
    Route::apiResource('pacjentis', 'PacjentiApiController');

    // Termini
    Route::apiResource('terminus', 'TerminiApiController');

});

Route::post('stripe/webhooks', [WebhookController::class,'handleWebhook']);
