<?php
set_include_path(APP_PATH);
spl_autoload_extensions('.php');
spl_autoload_register();

Core\Database::connect();

Core\Database::transaction(); //начало транзакций
Core\Route::begin();
Core\Database::commit(); //конец транзакций
?>