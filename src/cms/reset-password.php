<?php
include_once '../classes/autoloader.php';
$accountController = new accountController();

if(isset($_POST['submit']))    
{
    $accountController->changeAccountPassword();
}

$cmsNotification = new cmsNotification('Error', $accountController->errors);
$cmsNotificationSuccess = new cmsNotification('Password Changed', $accountController->success);

$head = new head("CMS - Reset passowrd", "page--cms");
$head->render();
?>

<div class="section--login-wrapper">
    <section class="section--login">
        <h1 class="title">Reset Password</h1>
        
        <form action="" method="POST">
            <label for="email">Password</label>
            <input required type="password" name="new_password" placeholder="e.g. JohnDoe123..."/>

            <input type="submit" name="submit" class="button" value="Reset Password"/>

            <a href="login.php">Go back to login</a>
        </form>
    </section>
    <?php
        $cmsNotification->render();
        $cmsNotificationSuccess->render();
    ?>
</div>

<?php
    $footer = new footer();
    $footer->renderEndTag();
?>