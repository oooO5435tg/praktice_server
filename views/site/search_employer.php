<div>
    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF()?>"/>
        <label>Введите фамилию<input type="text" name="employer"  required></label>
        <button>Найти</button>
    </form>
    <div>
        <h2>Результат:</h2>
        <ul>
            <?php if (isset($message)):?>
                <li><p><?= $message?></p></li>
            <?php else:?>
            <?php if (empty($filteredEmployers)):?>
                <li><p>Ничего не найдено.</p></li>
            <?php else:?>
                <?php foreach ($filteredEmployers as $employer):?>
                    <li>
                        <p>Фамилия: <?= $employer->surname?></p>
                        <p>Имя: <?= $employer->name?></p>
                        <p>Отчестсво: <?= $employer->patronymic?></p>
                        <p>Пол: <?= $employer->gender?></p>
                        <p>Дата рождения: <?= $employer->birthday?></p>
                        <p>Адрес: <?= $employer->adress?></p>
                        <p>Должность: <?= $employer->position->title_position?></p>
                    </li>
                <?php endforeach;?>
            <?php endif;?>
        </ul>
        <?php endif;?>
    </div>
</div>