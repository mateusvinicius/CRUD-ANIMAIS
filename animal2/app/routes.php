<?php
/**
 * Created by PhpStorm.
 * User: Mateus
 * Date: 17/01/2018
 * Time: 17:03
 */

//Home


$app->get('/','app\Action\HomeAction:index');
$app->get('/add','app\Action\HomeAction:add');
$app->post('/add','app\Action\HomeAction:store');
$app->get('/{id}/edit','app\Action\HomeAction:edit');
$app->post('/{id}/edit','app\Action\HomeAction:update');

$app->get('/{id}/del','app\Action\HomeAction:del');
$app->get('/{id}/view','app\Action\HomeAction:visualiza');