<?php

return array(

    //task:
    'task/updatetask/([0-9]+)' => 'task/updatetask/$1',
    'task/update/([0-9]+)' => 'task/update/$1',
    'task/delete/([0-9]+)' => 'task/delete/$1',
    'task/index/([0-9]+)' => 'task/index/$1',


    'director/add_from_file' => 'director/addFromFile',
    'director/create_task' => 'director/createTask',
    'director' => 'director/index',
    // Пользователь:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user/output' => 'user/output',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    '' => 'user/login', // actionIndex в SiteController
    '^(.*)$' => 'user/error',


);
