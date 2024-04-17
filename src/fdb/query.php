<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запрос к базе данных MySQL</title>
</head>
<body>
<h2>Запрос к базе данных MySQL</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="query">SQL Запрос:</label><br>
    <textarea id="query" name="query" rows="4" cols="50"></textarea><br><br>
    <button type="submit" name="submit">Отправить запрос</button>
</form>

<?php
// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из кук
    $server = 'mariadb';
    $username = 'root';
    $password = 'password';
    $dbname = 'qwerty';

    // Подключение к серверу MySQL
    $conn = new mysqli($server, $username, $password, $dbname);

    // Проверка соединения на наличие ошибок
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Получаем SQL запрос из формы
    $sql_query = $_POST["query"];

    // Засекаем время начала выполнения запроса
    $start_time = microtime(true);

    // Выполнение SQL запроса
    $result = $conn->query($sql_query);

    // Рассчитываем время выполнения запроса
    $execution_time = microtime(true) - $start_time;

    if ($result === false) {
        // Вывод ошибки запроса
        echo "Ошибка запроса: " . $conn->error;
    } else {
        // Вывод результатов запроса
        if ($result->num_rows > 0) {
            echo "<h3>Результаты запроса:</h3>";
            echo "<table border='1'><tr>";
            while ($fieldinfo = $result->fetch_field()) {
                echo "<th>{$fieldinfo->name}</th>";
            }
            echo "</tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 результатов";
        }
        // Вывод времени выполнения запроса
        echo "<p>Время выполнения запроса: " . number_format($execution_time, 4) . " секунд</p>";
    }

    // Закрытие соединения с сервером MySQL
    $conn->close();
}

?>
</body>
</html>
