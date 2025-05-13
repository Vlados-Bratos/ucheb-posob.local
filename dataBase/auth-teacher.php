 <?php

session_start();

require_once 'connect.php';

$login = $_POST['username'];
$password = $_POST['password'];


$check_Teacher = mysqli_query($connect, "SELECT * FROM Преподаватели WHERE логин = '$login' AND пароль = '$password'");
if (mysqli_num_rows($check_Teacher) > 0) {

    $Teacher = mysqli_fetch_assoc($check_Teacher);

    $_SESSION['Преподаватели'] = [
        "id_teacher" => $Teacher['id_teacher'],
        "login" => $Teacher['login']
    ];
    
        header('Location: ../html/glavn-teacher.php');

} else { echo "<script> alert('Ошибка! Неверный логин или пароль'); 
        window.location.replace('../html/lich-cab-teacher.php')</script>";
}
?> 













