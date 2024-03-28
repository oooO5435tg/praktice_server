<div style="display: flex; flex-direction: column; align-items: center">
    <h2>Добавление сотрудников</h2>
    <h3><?= $message ?? ''; ?></h3>
    <form method="post" style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 920px; height: 1010px; background-color: #D9D9D9">
        <label><input type="text" name="surname" class="signup_input" placeholder="Фамилия"></label>
        <label><input type="text" name="name" class="signup_input" placeholder="Имя"></label>
        <label><input type="text" name="patronymic" class="signup_input" placeholder="Отчество"></label>
        <>
        <label><input type="date" name="birthday" class="signup_input" placeholder="Дата рождение"></label>
        <label><input type="text" name="adress" class="signup_input" placeholder="Адрес прописки"></label>
        <><br>
        <><br>
        <>
        <button style="width: 540px; height: 60px; background-color: #C6C6C6; border: none; border-radius: 10px">Создать</button>
    </form>
</div>
<style>
    .signup_input{
        width: 700px;
        height: 60px;
        border: none;
        border-radius: 10px;
        margin-bottom: 50px;
    }
</style>