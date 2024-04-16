<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание и удаление базы данных MySQL</title>
</head>
<body>
<h2>Создание и удаление базы данных MySQL</h2>
<h3>Создание базы данных</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="server">Сервер MySQL:</label>
    <input type="text" id="server" name="server" value="localhost" placeholder="mariadb"><br><br>
    <label for="username">Имя пользователя:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password"><br><br>
    <label for="dbname">Название базы данных:</label>
    <input type="text" id="dbname" name="dbname"><br><br>
    <button type="submit" name="create">Создать базу данных</button>
</form>

<h3>Удаление базы данных</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="delete" value="true">
    <label for="server">Сервер MySQL:</label>
    <input type="text" id="server" name="server" value="localhost"><br><br>
    <label for="username">Имя пользователя:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password"><br><br>
    <label for="dbname">Название базы данных:</label>
    <input type="text" id="dbname" name="dbname"><br><br>
    <button type="submit">Удалить базу данных</button>
</form>

<?php
// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $server = $_POST["server"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $dbname = $_POST["dbname"];

    // Подключение к серверу MySQL
    $conn = new mysqli($server, $username, $password);

    // Проверка соединения на наличие ошибок
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Проверяем, какая кнопка была нажата
    if (isset($_POST["create"])) {
        // Создание новой базы данных
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        if ($conn->query($sql) === TRUE) {
            echo "База данных успешно создана";
        } else {
            echo "Ошибка при создании базы данных: " . $conn->error;
        }
    } elseif (isset($_POST["delete"])) {
        // Удаление базы данных
        $sql = "DROP DATABASE IF EXISTS $dbname";
        if ($conn->query($sql) === TRUE) {
            echo "База данных успешно удалена";
        } else {
            echo "Ошибка при удалении базы данных: " . $conn->error;
        }
    }

    // Закрытие соединения с сервером MySQL
    $conn->close();
}
?>
</body>
</html>
