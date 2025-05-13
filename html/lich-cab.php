<?
session_start();
if (empty($_SESSION)) {
?>
  <!DOCTYPE html>
  <html lang="ru">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Авторизация</title>
    <link rel="stylesheet" href="../style/header.css" />
    <link rel="stylesheet" href="../style/lich-cab.css" />
    <link rel="icon" href="../img/logo.png" />
  </head>

  <body>
    <!-- Шапка -->
    <header class="header">
      <img class="logo" src="../img/logo.png" alt="" />
      <div class="title">Личный кабинет</div>
    </header>
    <!-- Автоизация -->
    <form class="block-autoriz" action="../dataBase/auth.php" method="post" enctype="multipart/form-data">
      <h1>Авторизация</h1>
      <!-- логин -->
      <label for="login" name="username" class="label1">Логин
        <input type="text" name="username" id="login" class="input" required placeholder="Логин">
      </label>
      <!-- пароль -->
      <label for="password" name="password" class="label1">Пароль
        <input type="password" name="password" id="password" class="input" required placeholder="Пароль">
      </label>
      <a href="./lich-cab-teacher.php" class="recroll">Я преподаватель</a>
      <!-- кнопка войти -->
      <button type="submit" name="log-account" class="btn">Войти</button> 
    </form>
    
    <footer>
      <h3 class="h3-footer">ГБПОУ СРМК 2024 ©</h3>
    </footer>
  </body>
  </html>
<?
} else {
  header("Location: ../html/glavn-stud.php");
}
?>