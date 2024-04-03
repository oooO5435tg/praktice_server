<div style="display: flex; flex-direction: column; align-items: center">
    <h2>Дисциплины, читаемые сотрудниками по кафедре(ам) - </h2>
</div>
<div style="display: flex; flex-direction: column; margin: 0 100px">
    <?php if (count($employers)):?>
        <ul>
            <?php foreach ($employers as $employer):?>
                <li><?= $employer->surname?>:
                    <ul>
                        <?php foreach ($disciplines[$employer->id_user] as $discipline):?>
                            <li><?= $discipline->title_discipline?></li>
                        <?php endforeach;?>
                    </ul>
                </li>
            <?php endforeach;?>
        </ul>
    <?php else:?>
        <p>У выбранных(ой) кафедр(ы) нет дисциплин, читаемых сотрудниками.</p>
    <?php endif;?>
</div>