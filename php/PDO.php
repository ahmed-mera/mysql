<?php
$dns  = 'mysql:host=localhost;dbname=test';
$user = 'root';
$pass = '';

try {
    $con = new PDO($dns , $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!-- {
    "editor.smoothScrolling": true,
    "files.autoSaveDelay": 1,
    "php.validate.executablePath": "C:/xampp/php/php.exe",
    "phpmd.command": "C:/xampp/php/phar.phar",
    "files.autoSave": "afterDelay",
    "cSpell.diagnosticLevel": "Hint",
    "window.zoomLevel": 0,
    "cSpell.allowCompoundWords": true,
    "workbench.startupEditor": "newUntitledFile"
} -->