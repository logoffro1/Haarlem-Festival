<?php
include '../classes/autoloader.php';

$userController = new userController();
$accountController = new accountController();
$userObj = $accountController->getLoggedInUser();
$user = new cmsUser($userObj->id, $userObj->name, $userObj->email, $userObj->password);
// Todo Make sure session is updated so the new values will be shown
if(isset($_POST['submit']))
{
    $accountController->createUserSession($user);
    $userController->updateUser($user->id);
}

$breadcrumbsArray = array(
    array('text' => 'Profile Page', 'url' => "#"),
);
$breadcrumbs = new breadcrumbs($breadcrumbsArray, 'breadcrumbs--cms');

$head = new head("CMS - Profil Page", "page--cms");
$head->render();

$navigation = new cmsNavigation("");
$navigation->render();

?>

    <div class="cms-container row">
        <?php $breadcrumbs->render() ?>

        <article class="card--cms col-8">
        <header class="card--cms__header">
            <h3 class="card--cms__header__title">Profile Page <?php echo $user->name; ?></h3>
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
