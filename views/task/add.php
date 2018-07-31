<div class="container">
    <h1>Добавить задачу</h1>
    <ol class="breadcrumb">
        <li><a href="/">Задачи</a></li>
        <li class="active">Добавить задачу</li>
    </ol>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <form action="/add" method="post" class="form-add" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="controls">
                        <label>Имя пользователя:</label>
                        <input type="text" class="form-control form-input input-user" name="user" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <label>E-mail:</label>
                        <input type="email" class="form-control form-input input-email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <label>Задача:</label>
                        <textarea class="form-control form-input input-task" rows="6" name="task" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <label>Изображение:</label>
                        <input type="file" class="form-control-file form-input input-img" name="image" required>
                    </div>
                </div>
                <input type="hidden" name="preview" >
                <p class="form-button"><a id="preview-button" class="btn btn-primary">Предварительный просмотр</a></p>
                <p class="form-button"><button type="submit" name="input-submit" id="submit-button" class="btn btn-primary">Добавить задачу</button></p>
                <p class="errors"></p>
            </form>
        </div>
    </div>
    <div id="preview">
        <table class="table">
            <thead>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Email</th>
                    <th>Текст</th>
                    <th>Изображение</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <tr class="active">
                    <td><span id="preview-user"></span></td>
                    <td><span id="preview-email"></span></td>
                    <td><span id="preview-task"></span></td>
                    <td><img id="preview-image" width="320" height="240" alt=""></td>
                    <td>Не выполнено</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>