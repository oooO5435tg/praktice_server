<div>
    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label>Введите фамилию<input type="text" name="employer"></label>
        <button>Найти</button>
    </form>
    <div>
        <h2>Результат:</h2>
            <ul>
                <?php if (isset($message)): ?>
                    <li><p><?= $message ?></p></li>
                <?php else: ?>
                <?php if (empty($filteredEmployers)): ?>
                    <li><p>Ничего не найдено.</p></li>
                <?php else: ?>
                    <?php foreach ($filteredEmployers as $employer): ?>
                        <li>
                            <p>Фамилия: <?= $employer->surname?></p>
                            <p>Имя: <?= $employer->name?></p>
                            <p>Отчестсво: <?= $employer->patronymic?></p>
                            <p>Пол: <?= $employer->gender?></p>
                            <p>Дата рождения: <?= $employer->birthday?></p>
                            <p>Адрес: <?= $employer->adress?></p>
                            <p>Должность: <?= $employer->id_position?></p>
                            <p>Кафедра: <?= $employer->id_department?></p>
                            <p>Дисциплины: </p>
                            <?php if (!empty($disciplines)): ?>
                                <ul>
                                    <?php foreach ($disciplines as $discipline): ?>
                                        <li><?= $discipline->id_discipline ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>Нет дисциплин.</p>
                            <?php endif; ?>


                            <?php
                                if (!empty($employers)):
                                    foreach ($employers as $employer) {
                                        if (!empty($employer->image)):
                                            echo '<img src="public/img/' . $employer->image . '">';
                                        endif;
                                    }
                                endif;

                                var_dump(['image']);
                                var_dump(['path']);
                            ?>

                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>