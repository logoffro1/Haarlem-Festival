<?php
    include '../classes/autoloader.php';
	include '../components/cart/cartSession.php';

    $head = new head("Thank You", "");
    $head->render();
    
	$helper = new helper();
    $purchaseController = new purchaseController();
    $pdfController = new pdfController();
    $mailController = new mailController();
    $navigation = new navigation("");

	$_SESSION['cart']->render();
    $navigation->render();

	$steps = new steps(4);


	// Check the amount of items in cart, if it is 0, redirect back to the cart page
	if($_SESSION['cart']->getCountFromCart() == 0 && !isset($_GET['order_id']))
	{
		$helper->redirect("/views/cart.php");
	}

	$orderId = (int)$_GET['order_id'];

	$orderCart = $purchaseController->getPurchase($orderId);
	$orderIsPayed = isset($orderCart) && $orderCart->isPayed;

	if($orderIsPayed){
		// Create invoice based on bought tickets from session
		$pdf = $pdfController->createPdf($orderId, $orderCart->name);
	
		// Send to email with pdf, based on the email from the meta data
		$mailController->sendMail(
			$orderCart->email, 
			"Haarlem Festival Tickets", 
			"This is your generated invoice for the Haarlem Festival events.",
			$orderCart->name,
			$pdf,
		);
	}
?>
    <section class='container section page--cart'>
		<section class='row align-items-end page--cart__header'>
            <h1 style='margin-left:0px; padding-left:0px;' class='col-4 title title--page page--cart__title dance'>Payment</h1> 
			<?php
    			$steps->render();
			?>
        </section>
    </section>
    
	<?php
		if($orderIsPayed) {
			echo "<h1 class='title title--page dance' style='margin-left:25%;'>Thank you for your purchase!</h1>";
		} else {
			echo "<h1 class='title title--page dance' style='margin-left:30%;'>Something went wrong.</h1>";
		}
	?>

    <section class='container section' style='padding:0px; margin-left:auto; margin-right:auto; width:100em; text-align:center;'>
    	<article class='row'>
    		<header class='col-12'>
    			<p style='margin:auto;'>
				<?php
					if($orderIsPayed) {
						echo "We hope you enjoy the events are the festival!";
					} else {
						echo "We could not add your order.";
					}
				?>
				
				</p>
    		</header>
    	</article>
    	<article class='row'>
    		<header class='col-12'>
				<?php
					if($orderIsPayed) {
						echo"<p> A copy of your receipt has been sent to your e-mail address.</p>";
					}
				?>
    		</header>
    	</article>
    	<article class='row'>
    		<header class='col-12'>
    			<a href='../views/homepage.php'>
    				<button style='margin-top:25px;margin-bottom:25px;'>Return to home</button>
    			</a>
    		</header>
    	</article>
    	<article class='row'>
    		<header class='col-12'>
				<?php
					if($orderIsPayed) {
						echo"<p>Let your friends know you are attending</p>";
					}
				?>
    		</header>
    	</article>
		<?php
		if($orderIsPayed) {
		?>
    	<article class='row'>
    		<header class='col-12'>
    			<p>Share on</p>
    		</header>
    	</article>
    	<article class='row' style='margin-left:730px;'>
    		<header class='col-1'>
    			<img src='../assets/images/dance/instagram.png' style='margin-bottom:25px;'>
    		</header>
    		<header class='col-1'>
    			<img src='../assets/images/dance/facebook.png' style='margin-bottom:25px;'>
    		</header>
    	</article>
		<?php
		}
		?>
    </section>

<?php
	//unset session so if the page is refreshed it doesnt spam emails
    unset($_SESSION['email']);
    unset($_SESSION['fname']);
    unset($_SESSION['lname']);
    unset($_SESSION['dob']);
    unset($_SESSION['phoneno']);
    unset($_SESSION['cart']);

    $footer = new footer();
    $footer->renderFooter();
?>