<div style="display: flex; flex-direction: column; align-items: center">
    <h2>Сотрудники по кафедре(ам) -</h2>
    <div style="display: flex; flex-direction: column; margin: 0 100px">
        <?php if (count($employers)): ?>
            <ul>
                <?php foreach ($employers as $employer): ?>
                    <li>
                        <?= e($employer->surname) . ' ' . e($employer->name) . ' ' . e($employer->patronymic) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>У выбранных(ой) кафедр(ы) нет сотрудников.</p>
        <?php endif; ?>
    </div>
</div>