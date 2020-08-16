<?

include_once '../config/cfg.php';

spl_autoload_register(function ($class) {
    $path = '..\\app\\' . $class . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

$Router = new Router();





