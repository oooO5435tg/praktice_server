<div style="display: flex; flex-direction: column; align-items: center">
    <h2>Добавление сотрудников</h2>
    <h3><?= $message ?? ''; ?></h3>
    <form method="post" style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 920px; height: 1010px; background-color: #ceddf5">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label><input type="text" name="surname" class="signup_input" placeholder="Фамилия"></label>
        <label><input type="text" name="name" class="signup_input" placeholder="Имя"></label>
        <label><input type="text" name="patronymic" class="signup_input" placeholder="Отчество"></label>
        <label>
            <select name="gender" class="signup_input">
                <option value="">Пол</option>
                <option value="m">м</option>
                <option value="f">ж</option>
            </select>
        </label>
        <label>
            <select name="id_position" class="signup_input">
                <option value="">Должность</option>
                <?php foreach ($positions as $position) { ?>
                    <option value="<?php echo $position->id_position; ?>">
                        <?php echo $position->title_position; ?>
                    </option>
                <?php } ?>
            </select>
        </label>
        <label>
            <select name="id_department" class="signup_input">
                <option value="">Кафедра</option>
                <?php foreach ($departments as $department) { ?>
                    <option value="<?php echo $department->id_department; ?>">
                        <?php echo $department->title_department; ?>
                    </option>
                <?php } ?>
            </select>
        </label>
        <label><input type="date" name="birthday" class="signup_input" placeholder="Дата рождение"></label>
        <label><input type="text" name="adress" class="signup_input" placeholder="Адрес прописки"></label>
        <button style="width: 540px; height: 60px; background-color: #224d8c; border: none;
        border-radius: 10px; color: #b1caee; font-size: 16px;">Создать</button>
    </form>
</div>
<style>
    .signup_input{
        width: 700px;
        height: 50px;
        border: none;
        border-radius: 10px;
        margin-bottom: 30px;
    }
</style>