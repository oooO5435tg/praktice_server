<?php

namespace Controller;

use Model\Department;
use Model\Discipline;
use Model\Position;
use Model\Employer;
use Model\ListDiscipline;

use Model\Post;
use Model\User;
use Src\Request;
use Src\View;
use Src\Auth\Auth;

use Src\Validator\Validator;


use Illuminate\Support\Facades\DB;



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

//    public function addEmployer(Request $request): string
//    {
//        $disciplines = Discipline::all();
//        $departments = Department::all();
//        $positions = Position::all();
//        if ($request->method === 'POST') {
//
//            $validator = new Validator($request->all(), [
//                'surname' => ['required'],
//                'name' => ['required'],
//                'patronymic' => ['required'],
//                'gender' => ['required'],
//                'id_position' => ['required'],
//                'id_department' => ['required'],
//                'birthday' => ['required'],
//                'adress' => ['required'],
//            ], [
//                'required' => 'Поле :field пусто',
//            ]);
//
//            if($validator->fails()){
//                return new View('site.add_employer',
//                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
//            }
//
//            if ($_FILES['image']){
//                $image = $_FILES['image'];
//                $root = app()->settings->getRootPath();
//                $path = $_SERVER['DOCUMENT_ROOT'] . $root . '/public/img';
//                $name = mt_rand(0, 1000) . $image['name'];
//
//                move_uploaded_file($image['tmp_name'], $path . $name);
//
//                $employer_data = $request->all();
//                $employer_data['image'] = $name;
//
//                if (Employer::create($employer_data)) {
//                    app()->route->redirect('/add_employer');
//                }
//            } else {
//                if (Employer::create($request->all())) {
//                    app()->route->redirect('/add_employer');
//                }
//            }
//        }
//        return new View('site.add_employer', ['disciplines' => $disciplines,
//            'departments' => $departments, 'positions' => $positions]);
//    }

    public function addEmployer(Request $request): string
    {
        $disciplines = Discipline::all();
        $departments = Department::all();
        $positions = Position::all();

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'surname' => ['required'],
                'name' => ['required'],
                'patronymic' => ['required'],
                'gender' => ['required'],
                'id_position' => ['required'],
                'id_department' => ['required'],
                'birthday' => ['required'],
                'adress' => ['required'],
                'selected_disciplines' => ['required', 'array'], // Добавляем валидацию для выбранных дисциплин
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if($validator->fails()){
                return new View('site.add_employer', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            // Создание сотрудника
            $employer = Employer::create($request->all());

            // Привязка выбранных дисциплин к сотруднику
            $employer->disciplines()->attach($request->selected_disciplines);

            // Перенаправление после успешного создания
            app()->route->redirect('/add_employer');
        }

        return new View('site.add_employer', ['disciplines' => $disciplines, 'departments' => $departments, 'positions' => $positions]);
    }



    public function disciplinesByEmployer(Request $request): string
    {
        $employerIds = $request->get('employer_ids', []);
        $employers = Employer::whereIn('id_user', $employerIds)->get();

        return new View('site.disciplines_by_employer', ['employers' => $employers]);
    }

    public function employerByDepartment(Request $request): string
    {
        $departmentIds = $request->get('department_ids', []);
        $employers = Employer::whereIn('id_department', $departmentIds)->get();

        return new View('site.employers_by_department', ['employers' => $employers]);
    }

    public function disciplinesByEmployerDepartment(Request $request): string
    {
        $departmentIds = $request->get('department_ids', []);
        $employers = Employer::whereIn('id_department', $departmentIds)->get();

        return new View('site.disciplines_employer_department', ['employers' => $employers]);
    }

    public function search_employer(Request $request): string
    {
        $employers = Employer::all();

        if ($request->method === 'POST') {
            $temp = $request->all();
            $employerID = $temp['employer'];
            $filteredEmployers = Employer::whereRaw("LOWER(surname) LIKE ?", ["%{$employerID}%"])->get();

            if (count($filteredEmployers) === 0) {
                return new View('site.search_employer', ['message' => 'Ничего не найдено.']);
            }

            $employer = $filteredEmployers->first();
            $disciplines = $employer->disciplines;

            return new View('site.search_employer', ['filteredEmployers' => $filteredEmployers, 'disciplines' => $disciplines]);
        }

        return new View('site.search_employer', ['employers' => $employers]);
    }
}
