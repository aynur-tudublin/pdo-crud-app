/*** I could only use ddev on my local laptop to test it. The other 
tools didn't work on my old MacBook.
* ddev ssh             # I open a shell inside the web container
and run php install.php      # executes data/init.sql

it's because my web root is public/, the browser can't reach files outside public/
***/

<?php
require __DIR__ . "/config.php";

try {
    $conn = new PDO($dsn, $username, $password, $options);
    $sql = file_get_contents(__DIR__ . "/data/init.sql");
    $conn->exec($sql);
    echo "Database and table 'users' created successfully.";
} catch (PDOException $error) {
    echo "<pre>" . $sql . "\n\n" . $error->getMessage() . "</pre>";
}
