<div class="container">
  <h1>Список задач</h1>
  <?php if (!empty($tasks)) : ?>
  <div class="sort">
    <p>
      <label>Сортировать по:</label>
      <select class="select-sort">
        <option value="default" <?php if ($_COOKIE['sort'] == 'default') { echo 'selected'; } ?>>по умолчанию</option>
        <option value="user" <?php if ($_COOKIE['sort'] == 'user') { echo 'selected'; } ?>>имени пользователя</option>
        <option value="email" <?php if ($_COOKIE['sort'] == 'email') { echo 'selected'; } ?>>email</option>
        <option value="status" <?php if ($_COOKIE['sort'] == 'status') { echo 'selected'; } ?>>статусу</option>
      </select>
    </p>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>Номер задачи </th>
        <th>Имя пользователя</th>
        <th>Email</th>
        <th>Текст</th>
        <th>Изображение</th>
        <th>Статус</th>
        <?php if (isset($_SESSION['admin']) and $_SESSION['admin']=='admin') : ?>
        <th>Изменить</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($tasks as $task) : ?>
      <tr <?php if ($task['status'] == '1')  { echo 'class="success"'; }  else { echo 'class="active"'; }; ?> >
        <td><?php echo $task['id']; ?></td>
        <td><?php echo $task['user']; ?></td>
        <td><?php echo $task['email']; ?></td>
        <td><?php echo $task['task']; ?></td>
        <td><img src="/upload/<?php echo $task['image']; ?>" width="320" alt=""></td>
        <td><?php if ($task['status'] == '1')  { echo 'Выполнено'; }  else { echo 'Не выполнено'; }; ?></td>
        <?php if (isset($_SESSION['admin']) and $_SESSION['admin']=='admin') : ?> 
        <td><a href="/edit/<?php echo $task['id']; ?>">редактировать задачу</a></td>
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $pagination; ?>
  <?php else : ?>
  <p>Задачи не найдены.</p>
  <?php endif; ?>
  <p><a href="/add" class="btn btn-primary">Добавить задачу</a></p>
</div>