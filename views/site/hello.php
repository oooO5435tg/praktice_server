<h2><?= $message ?? ''; ?></h2>
<div style="display: flex; flex-direction: column; align-items: center">
    <h2>Главная</h2>
    <div style="display: flex">
        <div style="background-color: #D9D9D9; width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center; margin-right: 50px">
            <h3>Дисциплины,читаемые сотрудником</h3>
            <div style="display: flex">
                <input type="checkbox">
                <p>...</p>
            </div>
            <div style="display: flex; flex-direction: column">
                <a>Еще</a>
                <button class="hello-btn">Смотреть</button>
            </div>
        </div>
        <div style="background-color: #D9D9D9; width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center; margin-right: 50px">
            <h3>Дисциплины,читаемые сотрудником</h3>
            <div style="display: flex">
                <input type="checkbox">
                <p>...</p>
            </div>
            <div style="display: flex; flex-direction: column">
                <a>Еще</a>
                <button class="hello-btn">Смотреть</button>
            </div>
        </div>
        <div style="background-color: #D9D9D9; width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center">
            <h3>Дисциплины,читаемые сотрудником</h3>
            <div style="display: flex">
                <input type="checkbox">
                <p>...</p>
            </div>
            <div style="display: flex; flex-direction: column">
                <a>Еще</a>
                <button class="hello-btn">Смотреть</button>
            </div>
        </div>
    </div>
</div>

<style>
    form{
        width: 1120px;
        height: 400px;
        background-color: #D9D9D9;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .hello-btn{
        background-color: #F6F6F6;
        width: 220px;
        height: 40px;
        border: none;
        border-radius: 10px;
        margin-top: 20px;
    }
</style>