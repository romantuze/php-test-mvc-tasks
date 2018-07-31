<!DOCTYPE html>
<html lang="ru">
  <head>
    <title><?php echo $title; ?> <?php if (isset($this->route['page'])) echo '- Страница '.$this->route['page']; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="/template/css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Todo App</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">Задачи</a></li>
            <li><a href="/add">Добавить задачу</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION['admin']) and $_SESSION['admin']=='admin') : ?>
            <li><a href="/admin/logout">Выйти из панели управления</a></li>
            <?php else: ?>
            <li><a href="/admin/login">Панель управления</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
    <?php echo $content; ?>
    <script src="/template/js/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="/template/js/forms.js"></script>
    <script src="/template/js/preview.js"></script>
  </body>
</html>