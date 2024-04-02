<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class DekanatMiddleware
{
    public function handle(Request $request)
    {
        //Если пользователь - не деканат, то редирект на главную страницу
        if (!Auth::checkDekanat()) {
            app()->route->redirect('/hello');
        }
    }
}