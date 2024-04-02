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

use Src\Validator\Validator;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                return new View('site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (User::create($request->all())) {
                app()->route->redirect('/login');
            }
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
        return new View('site.hello');
    }

    public function addDepartment(Request $request): string
    {
        $title_department = Department::all();
        if ($request->method === 'POST'&& Department::create($request->all())){
            app()->route->redirect('/add_department');
        }
        return new View('site.add_department', ['title_department' => $title_department]);
    }
    public function addPosition(Request $request): string
    {
        $title_position = Position::all();
        if ($request->method === 'POST'&& Position::create($request->all())){
            app()->route->redirect('/add_position');
        }
        return new View('site.add_position', ['title_position' => $title_position]);
    }
    public function addDiscipline(Request $request): string
    {
        $title_discipline = Discipline::all();
        if ($request->method === 'POST'&& Discipline::create($request->all())){
            app()->route->redirect('/add_discipline');
        }
        return new View('site.add_discipline', ['title_discipline' => $title_discipline]);
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
