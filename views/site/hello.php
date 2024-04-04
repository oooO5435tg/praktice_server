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
            <form style="width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center;" method="get" action="<?= app()->route->getUrl('/disciplines_by_employer')?>" id="filterForm">
                <div style="display: flex; flex-direction: column">
                    <?php
                    $employers = \Model\Employer::all();
                    foreach ($employers as $employer) {
                        echo "<div style='display: flex; align-items: center; margin-bottom: (10px);'>
                <input type='checkbox' name='employer_ids[]' value='{$employer->id_user}'>
                <label>". e($employer->surname). "</label>
            </div>";
                    }
                    ?>
                </div>
                <button class="hello-btn" type="submit" id="filterButton" disabled>Смотреть</button>
            </form>
        </div>
        <div style="background-color: #ceddf5; width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center; margin-right: 50px">
            <h3>Сотрудники по кафедре(ам)</h3>
            <form style="width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center;" method="get" action="<?= app()->route->getUrl('/employers_by_department')?>" id="filterForm1">
                <div style="display: flex; flex-direction: column">
                    <?php
                    $departments = \Model\Department::all();
                    foreach ($departments as $department) {
                        echo "<div style='display: flex; align-items: center; margin-bottom: 10px;'>
                <input type='checkbox' name='department_ids[]' value='{$department->id_department}'>
                <label>". e($department->title_department). "</label>
              </div>";
                        if (!empty($department->image)){
                            echo '<img src="/praktice_server/public/img/'. $department->image. '" " style="width: 50px; height: 50px">';
                        }
                    }
                    ?>
                </div>
                <button class="hello-btn" type="submit" id="filterButton1" disabled>Смотреть</button>
            </form>
        </div>
        <div style="background-color: #ceddf5; width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center">
            <h3>Дисциплины, читаемые сотрудниками по кафедре(ам)</h3>
            <form style="width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center;" method="get" action="<?= app()->route->getUrl('/disciplines_employer_department')?>" id="filterForm2">
                <div style="display: flex; flex-direction: column">
                    <?php
                    $departments = \Model\Department::all();
                    foreach ($departments as $department) {
                        echo "<div style='display: flex; align-items: center; margin-bottom: 10px;'>
                    <input type='checkbox' name='department_ids[]' value='{$department->id_department}'>
                    <label>". e($department->title_department). "</label>
                </div>";
                    }
                    ?>
                </div>
                <button class="hello-btn" type="submit" id="filterButton2" disabled>Смотреть</button>
            </form>
        </div>
    </div>
</div>

<style>
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

<script>
    const filterForm = document.getElementById('filterForm');
    const filterButton = document.getElementById('filterButton');
    filterForm.addEventListener('change', (event) => {
        const checkedBoxes = Array.from(filterForm.querySelectorAll('input[type="checkbox"]:checked'));

        if (checkedBoxes.length > 0) {
            filterButton.disabled = false;
        } else {
            filterButton.disabled = true;
        }
    });

    const filterForm1 = document.getElementById('filterForm1');
    const filterButton1 = document.getElementById('filterButton1');
    filterForm1.addEventListener('change', (event) => {
        const checkedBoxes = Array.from(filterForm1.querySelectorAll('input[type="checkbox"]:checked'));

        if (checkedBoxes.length > 0) {
            filterButton1.disabled = false;
        } else {
            filterButton1.disabled = true;
        }
    });

    const filterForm2 = document.getElementById('filterForm2');
    const filterButton2 = document.getElementById('filterButton2');
    filterForm2.addEventListener('change', (event) => {
        const checkedBoxes = Array.from(filterForm2.querySelectorAll('input[type="checkbox"]:checked'));

        if (checkedBoxes.length > 0) {
            filterButton2.disabled = false;
        } else {
            filterButton2.disabled = true;
        }
    });
</script>
