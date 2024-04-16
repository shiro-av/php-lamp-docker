<?php
if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>f1</title>
    </head>
    <body>
    <form action="index.php" method="post">
        <label for="name">Ваше имя:</label>
        <input name="name" id="name" type="text">
        <label for="surname">Ваша фамилия:</label>
        <input name="surname" id="surname" type="text">
        <label for="email">email</label>
        <input type="text" name="email" id="email">
        <button type="submit">Submit</button>
    </form>

    </body>
    </html>
<?php
}
/**
 * @return void
 */
function extracted()
{
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    print('<p>Ваше имя: ' . $name . '</p>');
    print('<p>Ваша фамилия: ' . $surname . '</p>');
    print("<p>email: $email </p>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extracted();
}