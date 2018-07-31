<div class="container">
  <h1>Редактировать задачу <?php echo $task['id']; ?></h1>
  <ol class="breadcrumb">
    <li><a href="/">Задачи</a></li>
    <li class="active">Редактировать задачу</li>
  </ol>
  <div class="row">
    <div class="col-lg-8 mb-4">
      <form action="/edit/<?php echo $task['id']; ?>" method="post" class="form-edit">
        <div class="form-group">
          <div class="controls">
            <label>Задача:</label>
            <textarea class="form-control form-input input-task" rows="6" name="task" required><?php echo $task['task']; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="controls">
            <label>Статус:</label>
            <select name="status">
              <option value="0" <?php if ($task['status']=='0') { echo 'selected'; } ?>>Не выполнена</option>
              <option value="1" <?php if ($task['status']=='1') { echo 'selected'; } ?>>Выполнена</option>
            </select>
          </div>
        </div>
        <p class="form-button"><button type="submit" class="btn btn-primary">Сохранить задачу</button></p>
        <p class="errors"></p>
      </form>
    </div>
  </div>
</div>