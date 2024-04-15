<?php
print_r("<p> Method: ".$_SERVER["REQUEST_METHOD"] . "</p>");
print_r($_POST);

echo '<br><br>';

if (isset($_POST)) {
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    print('<p>Ваше имя: '. $name .'</p>');
    print('<p>Ваша фамилия: '. $surname . '</p>');
    print("<p>email: $email </p>");
}