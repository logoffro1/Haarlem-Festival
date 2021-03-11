<?php
include '../classes/autoloader.php';

$userController = new userController();
$userList = $userController->getUsers();

$mutatedUserList = array(); 

foreach($userList as $user){
    $userArray = $user->mutateToArray();
    unset($userArray['password']);
    $userArray[] = "<a class='align--flex-end' href='user-detail-page.php?id=$user->id'>edit</a>";
    
    $mutatedUserList[] = $userArray;
};

$breadcrumbsArray = array(
    array('text' => 'User Overview', 'url' => "#")
);
$breadcrumbs = new breadcrumbs($breadcrumbsArray, 'breadcrumbs--cms');

$head = new head("CMS - User", "page--cms");
$head->render();

$navigation = new cmsNavigation("Users");
$navigation->render();

$table = new table('card--cms__body table--cms', array('name', 'email', ''), $mutatedUserList);
?>

    <div class="cms-container row">
        <?php $breadcrumbs->render() ?>

        <article class="card--cms col-8">
            <header class="card--cms__header">
                <h3 class="card--cms__header__title">Users</h3>
            </header>

            <?php $table->render(); ?>
        </article>
    </div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
