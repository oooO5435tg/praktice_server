<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class AdminMiddleware
{
    public function handle(Request $request)
    {
        //Если пользователь - не админ, то редирект на главную страницу
        if (!Auth::checkAdmin()) {
            app()->route->redirect('/hello');
        }
    }
}