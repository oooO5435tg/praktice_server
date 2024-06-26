<?php

namespace Controller;

use Model\Department;
use Model\Discipline;
use Model\Employer;
use Model\ListDiscipline;
use Model\Position;
use Model\Post;
use Model\User;
use Src\Auth\Auth;
use Src\Request;
use Src\Validator\Validator;
use Src\View;
use imageuploader\ImageUploader;
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
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'title_department' => ['required', 'no_special_chars', 'no_digits'],
            ], [
                'required' => 'Поле :field пусто',
                'no_special_chars' => 'Поле :field не должно содержать спец символов',
                'no_digits' => 'Поле :field не должно содержать цифр'
            ]);

            if($validator->fails()){
                return new View('site.add_department',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            $departments = $request->all();
            $imageUploader = new ImageUploader(); // Создаем экземпляр класса ImageUploader
            $imageName = $imageUploader->upload($departments);

            if (!empty($imageName)) {
                $departments['image'] = $imageName;
            }

            if (Department::create($departments)) {
                app()->route->redirect('/add_department');
            }
        }

        return new View('site.add_department');
    }
    public function addPosition(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'title_position' => ['required', 'no_special_chars', 'no_digits'],
            ], [
                'required' => 'Поле :field пусто',
                'no_special_chars' => 'Поле :field не должно содержать спец символов',
                'no_digits' => 'Поле :field не должно содержать цифр'
            ]);

            if($validator->fails()){
                return new View('site.add_position',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (Position::create($request->all())){
                app()->route->redirect('/add_position');
            }
        }
        return new View('site.add_position');
    }
    public function addDiscipline(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'title_discipline' => ['required', 'no_special_chars'],
            ], [
                'required' => 'Поле :field пусто',
                'no_special_chars' => 'Поле :field не должно содержать спец символов'
            ]);

            if($validator->fails()){
                return new View('site.add_discipline',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (Discipline::create($request->all())){
                app()->route->redirect('/add_discipline');
            }
        }
        return new View('site.add_discipline');
    }

    public function addEmployer(Request $request): string
    {
        $disciplines = Discipline::all();
        $departments = Department::all();
        $positions = Position::all();

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'surname' => ['required', 'no_special_chars', 'no_digits'],
                'name' => ['required', 'no_special_chars', 'no_digits'],
                'patronymic' => ['required', 'no_special_chars', 'no_digits'],
                'gender' => ['required'],
                'id_position' => ['required'],
                'id_department' => ['required'],
                'birthday' => ['required', 'birthday_valid'],
                'adress' => ['required', 'no_special_chars'],
                'selected_disciplines' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
                'no_special_chars' => 'Поле :field не должно содержать спец символов',
                'no_digits' => 'Поле :field не должно содержать цифр',
                'birthday_valid' => 'Сотруднику должно быть не менее 18 лет'
            ]);

            if($validator->fails()){
                return new View('site.add_employer', ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE), 'disciplines' => $disciplines]);
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

        $disciplines = ListDiscipline::whereIn('id_user', $employerIds)
            ->join('disciplines', 'list_disciplines.id_discipline', '=', 'disciplines.id_discipline')
            ->select('list_disciplines.id_user', 'disciplines.title_discipline')
            ->get()
            ->groupBy('id_user');

        return new View('site.disciplines_by_employer', ['employers' => $employers, 'disciplines' => $disciplines]);
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

        $disciplines = ListDiscipline::whereIn('id_user', $employers->pluck('id_user'))
            ->join('disciplines', 'list_disciplines.id_discipline', '=', 'disciplines.id_discipline')
            ->select('list_disciplines.id_user', 'disciplines.title_discipline')
            ->get()
            ->groupBy('id_user');

        return new View('site.disciplines_employer_department', ['employers' => $employers, 'disciplines' => $disciplines]);
    }

    public function search_employer(Request $request): string
    {
        $employers = Employer::all();

        if ($request->method === 'POST') {
            $temp = $request->all();
            $employerID = $temp['employer'];
            $filteredEmployers = Employer::whereRaw("LOWER(surname) LIKE?", ["%{$employerID}%"])
                ->with('position') // Add this line to load the related position model
                ->get();

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
