<?php
print_r("<p> Method: ".$_SERVER["REQUEST_METHOD"] . "</p>");
print_r($_POST);

echo '<br><br>';

if (isset($_GET)) {
    extracted();
}