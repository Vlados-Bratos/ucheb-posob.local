 <?php

session_start();

require_once 'connect.php';

$login = $_POST['username'];
$password = $_POST['password'];


$check_Students = mysqli_query($connect, "SELECT * FROM Студенты WHERE логин = '$login' AND пароль = '$password'");
if (mysqli_num_rows($check_Students) > 0) {

    $Students = mysqli_fetch_assoc($check_Students);

    $_SESSION['Студенты'] = [
        "id_student" => $Students['id_student'],
        "login" => $Students['login']
    ];
    
        header('Location: ../html/glavn-stud.php');

} else { echo "<script> alert('Ошибка! Неверный логин или пароль'); 
        window.location.replace('../html/lich-cab.php')</script>";
}
?> 













