<?php
/*
Ruta Reset que permita reiniciar el estado de toda nuestra aplicación
POST /reset
status: 200 OK

Obtener el balance de una cuenta existente
GET /balance?account_id=1234

Si la cuenta no existe devolvemos un error 404 y el balance como 0 porque la cuenta no existe y por lo tanto no tiene fondos
Status: 404 0

Crear una cuenta con una balance inicial
Se trata de un evento de tipo deposito que va destinado a la cuenta con el id 100 y por un monto de 10
POST /event {'type': 'deposit', 'destination':'100', 'amount':10 }
status 201 {'destination': {'id':'100', 'balance':20}}

Obtener el balance de una cuenta existente pasandole el id de una cuenta válida
GET /balance?account_id=100

Retiro de una cuenta no existente:
Al intentar retirar de lo que se supone que es una cuenta con id 200 la cual no existe en nuestra base de datos se retorna un error 404 y balance en 0 porque la cuenta no existe
POST /event {'type': 'whithdraw', 'origin':'200', 'amount':10 }

Retiro de una cuenta existente
POST /event {'type': 'whithdraw', 'origin':'100', 'amount':5 }
201 {'origin': {'id:'100', 'balance': 15}}

Transferir desde una cuenta válida existente
POST /event {'type': 'transfer', 'origin':'100', 'amount':15, 'destination':'300' }
201 {'origin': {'id:'100', 'balance': 0, 'destination': {'id': 300, 'balance': 300}}}

Transferir desde una cuenta no existente
POST /event {'type': 'transfer', 'origin':'200', 'amount':15, 'destination':'300' }
404 0

 */

use Illuminate\Support\Facades\Route;

Route::post('/reset', action:'ResetController@reset');

Route::get('/balance', action:'BalanceController@show');

Route::post('/event', action:'EventController@store');
