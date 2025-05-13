<!-- <?php
// session_start();
// Удаляем все переменные сессии

// Уничтожаем сессию
// session_destroy();
// Перенаправляем пользователя на страницу входа или на главную страницу

 ?>
 <?php

// Инициализируем сессию
// При установке пользовательского названия сессии перед вызовом функции session_start()
// не забудьте вызывать session_name("something")!
session_start();
session_unset();
// Удаляем все переменные сессии
$_SESSION = array();

// Если нужно убить сессию, также удаляем сессионный блок данных cookie.
// Замечание: Это уничтожит сессию, а не только данные сессии!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 400,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Наконец, уничтожаем сессию
session_destroy();
header("Location: ../index.php"); // Замените 'login.php' на нужную вам страницу
exit;

?>