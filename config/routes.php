<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->post('/converter', 'CurrencyConversion\Controller\ConverterController:post');
