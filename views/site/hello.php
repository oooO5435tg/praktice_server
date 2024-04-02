<div style="display: flex; flex-direction: column; align-items: center">
    <h2>Главная</h2>
    <div style="width: 250px; display: flex; justify-content: space-between;
    align-items: center; margin-bottom: 50px">
        <h3>Поиск:</h3>
        <a class="search" href="<?= app()->route->getUrl('/search_employer') ?>">Найти сотрудника</a>
    </div>

    <div style="display: flex">
        <div style="background-color: #ceddf5; width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center; margin-right: 50px">
            <h3>Дисциплины,читаемые сотрудником(ами)</h3>
            <div style="display: flex; flex-direction: column">
                <?php
                $employers = \Model\Employer::all();
                foreach ($employers as $employer) {
                    echo "<div style='display: flex; align-items: center; margin-bottom: 10px;'>
                            <input type='checkbox'>
                            <label>" . e($employer->surname) . "</label>
                          </div>";
                }
                ?>
            </div>
            <div style="display: flex; flex-direction: column">
                <button class="hello-btn">
                    <a href="<?= app()->route->getUrl('/disciplines_by_employer') ?>">Смотреть</a>
                </button>
            </div>
        </div>
        <div style="background-color: #ceddf5; width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center; margin-right: 50px">
            <h3>Сотрудники по кафедре(ам)</h3>
            <div style="display: flex; flex-direction: column">
                <?php
                $departments = \Model\Department::all();
                foreach ($departments as $department) {
                    echo "<div style='display: flex; align-items: center; margin-bottom: 10px;'>
                            <input type='checkbox'>
                            <label>" . e($department->title_department) . "</label>
                          </div>";
                }
                ?>
            </div>
            <button class="hello-btn">
                <a href="<?= app()->route->getUrl('/employers_by_department') ?>">Смотреть</a>
            </button>
        </div>
        <div style="background-color: #ceddf5; width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center">
            <h3>Дисциплины, читаемые сотрудниками по кафедре(ам)</h3>
            <div style="display: flex; flex-direction: column">
                <?php
                $departments = \Model\Department::all();
                foreach ($departments as $department) {
                    echo "<div style='display: flex; align-items: center; margin-bottom: 10px;'>
                            <input type='checkbox'>
                            <label>" . e($department->title_department) . "</label>
                          </div>";
                }
                ?>
            </div>
            <button class="hello-btn">
                <a href="<?= app()->route->getUrl('/disciplines_employer_department') ?>">Смотреть</a>
            </button>
        </div>
    </div>
</div>

<style>
    form{
        width: 1120px;
        height: 400px;
        background-color: #ceddf5;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .hello-btn{
        background-color: #224d8c;
        width: 220px;
        height: 40px;
        border: none;
        border-radius: 10px;
        margin-top: 20px;
    }
    .hello-btn a{
        color: #b1caee;
        font-size: 16px;
        text-decoration: none;
    }
    .search{
        text-decoration: none;
        color: #224d8c;
        font-size: 20px;
    }
    .search:hover{
        text-decoration: underline;
    }
</style>