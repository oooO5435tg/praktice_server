<div style="display: flex; flex-direction: column; align-items: center">
    <h2>Список всех сотрудников</h2>
    <ul>
        <?php foreach ($users as $user): ?>
            <div style="display: flex; justify-content: space-around; width: 1500px">
                <li><?= e($user->name) ?></li>
                <button style="width: 360px; height: 40px; background-color: #D9D9D9; border: none; border-radius: 10px; margin-bottom: 20px">Прикрепить к дисциплине</button>
            </div>
        <?php endforeach; ?>
    </ul>
</div>
<style>
    li{
        list-style-type: none;
    }
</style>