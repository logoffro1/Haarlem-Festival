<?php
include_once '../classes/autoloader.php';
$accountController = new accountController();

if(isset($_POST['submit']))    
{
    $accountController->login();
}

if(isset($_POST['reset']))    
{
    $accountController->sentResetPassword();
}

$cmsNotification = new cmsNotification('Error', $accountController->errors);
$cmsNotificationSuccess = new cmsNotification('Confirmation', $accountController->success);

$head = new head("CMS - Login", "page--cms");
$head->render();


?>

<div class="section--login-wrapper">
    <section class="section--login">
        <h1 class="title">Login</h1>
        
        <form action="" method="POST">
            <label for="email">Email</label>
            <input required type="email" name="email" placeholder="e.g. JohnDoe@hotmail.com..."/>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="e.g. JohnDoe123..."/>

            <div class="row align-items-center">
                <input type="submit" name="submit" class="button" value="Login"/>
                <input type="submit" name="reset" class="anchor" value="Reset password"/>
            </div>

            <a href="register.php">Don't have an account yet? Register now</a>
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
