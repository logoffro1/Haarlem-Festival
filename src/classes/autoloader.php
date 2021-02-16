<?php  
/*
* Create autoloader for classes
* @param $class_name - name of class that needs to be imported
*/
spl_autoload_register(function ($class_name) {
    // create path to files
    $component_class = "./components/$class_name.php";
    $controller_class = "./controller/$class_name.php";
    $classes_class = "./classes/$class_name.php";
    $model_class = "./model/$class_name.php";
    $view_class = "./view/$class_name.php";

    // Check if files exist
    if(file_exists($component_class)){
        include $component_class;
    } else if(file_exists($controller_class)){
        include $controller_class;
    } else if(file_exists($classes_class)){
        include $classes_class;
    } else if(file_exists($model_class)){
        include $model_class;
    } else if(file_exists($view_class)){
        include $view_class;
    }
});

?>