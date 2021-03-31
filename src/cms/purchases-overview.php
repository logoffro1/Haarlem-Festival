<?php
include '../classes/autoloader.php';

$head = new head("CMS - Dashboard", "page--cms");
$head->render();

$navigation = new cmsNavigation("Purchases");
$navigation->render();

$purchaseController = new purchaseController();
$purchases = $purchaseController->getPurchaseList();

if(isset($_POST['submit'])){
    $purchaseController->changePurchasePaymentStatus();
}

$breadcrumbsArray = array(
    array('text' => 'Purchases', 'url' => "#")
);
$breadcrumbs = new breadcrumbs($breadcrumbsArray, 'breadcrumbs--cms');
?>

    <div class="cms-container">
        <?php
            $breadcrumbs->render();
        ?>
       
        <article class="card--cms col-11">
            <header class="card--cms__header">
                <h3 class="card--cms__header__title">Purchases</h3>
            </header>
           
            <?php
                foreach ($purchases as $purchase) {
                    $purchaseTableList = array();
                    $purchaseArray = array();

                    $mutatedPurchase = $purchase->mutateToArray();
                    unset($mutatedPurchase['tickets']);

                    $mutatedPurchase['purchaseId'] = sprintf("<input class='input--small type='text' readonly name='purchaseId' value='%d'>", $purchase->purchaseId);

                    $inputIsChecked = $purchase->isPayed ? "checked" : '';
                    $mutatedPurchase['isPayed'] = "<input type='checkbox' name='isPayed' $inputIsChecked>";

                    $mutatedPurchase['submit'] = '<input class="button" type="submit" name="submit" value="Update payment status">';

                    $purchaseTableList[] = $mutatedPurchase;
                    $purchaseTable = new table('card--cms__body table--cms', ['purchase ID', 'name', 'email', 'price', 'discount', 'is payed', ''], $purchaseTableList);
            ?>
                    <form action="" method="post">

                        <?php
                            $purchaseTable->render();
                        ?>
                        
                    </form>
            <?php   
                }
            ?>

        </article>
        
    </div>

<?php 
    $footer = new footer();
    $footer->renderEndTag();
?>
