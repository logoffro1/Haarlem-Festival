<?php
include '../classes/autoloader.php';

$userController = new userController();
$user = $userController->getUser();

if(isset($_POST['submit']))    
{
    $userController->updateUser();
}

if(isset($_GET['delete']))    
{
    $userController->deleteUser();
}


$breadcrumbsArray = array(
    array('text' => 'User Overview', 'url' => "./user-page.php"),
    array('text' => $user->name, 'url' => "#"),
);
$breadcrumbs = new breadcrumbs($breadcrumbsArray, 'breadcrumbs--cms');

$head = new head("CMS - User Details", "page--cms");
$head->render();

$navigation = new cmsNavigation("Users");
$navigation->render();

?>

    <div class="cms-container row">
        <?php $breadcrumbs->render() ?>

        <article class="card--cms col-8">
        <header class="card--cms__header">
            <h3 class="card--cms__header__title">User Detail - <?php echo $user->name; ?></h3>
            <a class="button button--secondary" href="user-detail-page.php?id=<?php echo $user->id ?>&delete=<?php echo $user->id ?>">Delete user</a>
        </header>
        <form class="card--cms__body row" method="post" action="">
            <fieldset class="col-12 col--children-fullwidth">
                <label class="label">Name</label>
                <input required placeholder="John Doe..." type="text" name="name" value="<?php echo $user->name ?? ''; ?>">
            </fieldset>
            <fieldset class="col-12 col--children-fullwidth">
                <label class="label">Email</label>
                <input required placeholder="John@example.com..." type="text" name="email" value="<?php echo $user->email ?? ''; ?>">
            </fieldset>

            <br/>
            <fieldset class="col-12 row justify-content-end">
                <input class="button" type="submit" name="submit" value="Update user info">
            </fieldset>
        </form>
    </article>
    </div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
