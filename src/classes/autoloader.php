<?php  
/*
* Create autoloader for classes
* @param $class_name - name of class that needs to be imported
*/
spl_autoload_register(function ($class_name) {
    // create path to files
    $component_class = dirname(__DIR__)."/components/$class_name.php";
    $controller_class = dirname(__DIR__)."/controller/$class_name.php";
    $classes_class = dirname(__DIR__)."/classes/$class_name.php";
    $model_class = dirname(__DIR__)."/model/$class_name.php";
    $model_artist_class = dirname(__DIR__)."/model/artist/$class_name.php";
    $service_class = dirname(__DIR__)."/service/$class_name.php";
    $view_class = dirname(__DIR__)."/view/$class_name.php";
    $util_class = dirname(__DIR__)."/util/$class_name.php";
    $cuisine_class = dirname(__DIR__)."/components/cuisine/$class_name.php";
    $model_cuisine_class = dirname(__DIR__)."/model/cuisine/$class_name.php";
    // Check if files exist
    if(file_exists($component_class)){
        include $component_class;
    } else if(file_exists($controller_class)){
        include $controller_class;
    } else if(file_exists($classes_class)){
        include $classes_class;
    } else if(file_exists($model_artist_class)){
        include $model_artist_class;
    } else if(file_exists($model_class)){
        include $model_class;
    } else if(file_exists($service_class)){
        include $service_class;
    } else if(file_exists($util_class)){
        include $util_class;
    } else if(file_exists($view_class)){
        include $view_class;
    } else if(file_exists($cuisine_class)){
        include $cuisine_class;
    } else if(file_exists($model_cuisine_class)){
        include $model_cuisine_class;
    }
});

?>