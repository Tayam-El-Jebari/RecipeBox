<?php
class Controller
{
    private $productService;
    private $events;
    function __construct()
    {
        include __DIR__ . '/../views/header.php';
    }
    function displayView($models)
    {
        foreach ($models as $key => $value) {
            ${$key} = $value;
        }
        $events = $this->events;
        $directory = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];
        require __DIR__ . "/../views/$directory/$view.php";
        include __DIR__ . '/../views/footer.php';
    }
}
