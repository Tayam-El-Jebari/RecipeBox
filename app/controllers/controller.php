<?php
class Controller
{
    function displayView($models)
    {
        include __DIR__ . '/../views/header.php';
        //loads each model in models for views to read
        foreach ($models as $key => $value) {
            ${$key} = $value;
        }
        $directory = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];
        require __DIR__ . "/../views/$directory/$view.php";
        include __DIR__ . '/../views/footer.php';
    }
}
