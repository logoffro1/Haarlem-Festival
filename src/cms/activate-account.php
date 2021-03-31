<?php
include_once '../classes/autoloader.php';

$accountController = new accountController();
$isActivated = false;

if(isset($_GET['email']))
{
    $isActivated = $accountController->activateAccount();
}


$head = new head("CMS - Register", "page--cms");
$head->render();
?>

<div class="section--login-wrapper">
    <section class="section--login">
        <h1 class="title">Account is activated</h1>
        <p>
            <a href="login.php">Return to login</a>
        </p>
    </section>
    <?php
        if($isActivated){
            $cmsNotification = new cmsNotification('Activated', array("Account is activated"));
            $cmsNotification->render(); 
        }
    ?>
</div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>