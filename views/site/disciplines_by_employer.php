<div style="display: flex; flex-direction: column; align-items: center">
    <h2>Дисциплины, читаемые сотрудником(ами) - </h2>
</div>
<div style="display: flex; flex-direction: column; margin: 0 100px">
    <?php if (count($employers)): ?>
        <ul>
            <?php foreach ($employers as $employer): ?>
                <li><?= $employer->surname ?>:
                    <ul>
                        <?php foreach ($employer->disciplines as $discipline): ?>
                            <li><?= $discipline->id_discipline ?></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
    <p>У выбранных(ого) сотрудников(а) нет дисциплин.</p>
    <?php endif; ?>
</div>