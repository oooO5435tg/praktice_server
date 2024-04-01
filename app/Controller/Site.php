<?php

namespace Controller;

use Model\Department;
use Model\Discipline;
use Model\Position;
use Model\Employer;

use Model\Post;
use Model\User;
use Src\Request;
use Src\View;
use Src\Auth\Auth;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {
            app()->route->redirect('/hello');
        }
        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }

    public function addDepartment(): string
    {
        return new View('site.add_department');
    }
    public function addPosition(): string
    {
        return new View('site.add_position');
    }
    public function addDiscipline(): string
    {
        return new View('site.add_discipline');
    }

    public function addEmployer(Request $request): string
    {
        $employers = Employer::all();
        $departments = Department::all();
        $positions = Position::all();
        $disciplines = Discipline::all();
        if ($request->method === 'POST'&& Employer::create($request->all())){
            app()->route->redirect('/add_employer');
        }
        return new View('site.add_employer', ['employers' => $employers, 'departments' => $departments,
            'positions' => $positions, 'disciplines' => $disciplines]);
    }

    public function disciplinesByEmployer(): string
    {
        return new View('site.disciplines_by_employer');
    }

    public function employerByDepartment(): string
    {
        return new View('site.employers_by_department');
    }

    public function disciplinesByEmployerDepartment(): string
    {
        return new View('site.disciplines_employer_department');
    }
}
