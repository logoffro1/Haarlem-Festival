<?php
    include '../classes/autoloader.php';
    session_start();

    $head = new head("homepage", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();

	$controller = new thankyoupagecontroller();
    $steps = new steps(4);
	$controller->sendMail($_SESSION['email'],"Thank you for your purchase!","We look forward to seeing you at our festival ".$_SESSION['fname']." ".$_SESSION['lname'],$_SESSION['fname']);
?>
    <section class='container section' style='padding:0px;'>
    	<article class='row align-items-left'>
    		<header class='col-6'>
    			<p>Payment Information > Thank you</p>
    			<h1 class='title title--page dance'>Payment</h1>
    		</header>
			<?php
    			$steps->render();
			?>
    	</article>
    </section>
    <h1 class='title title--page dance' style='margin-left:510px;'>Thank you for your purchase!</h1>
    <section class='container section'
    	style='padding:0px; margin-left:auto; margin-right:auto; width:100em; text-align:center;'>
    	<article class='row'>
    		<header class='col-12'>
    			<p style='margin:auto;'> We hope you enjoy the events are the festival!</p>
    		</header>
    	</article>
    	<article class='row'>
    		<header class='col-12'>
    			<p> A copy of your receipt has been sent to your e-mail address.</p>
    		</header>
    	</article>
    	<article class='row'>
    		<header class='col-12'>
    			<a href='../index.php'>
    				<button style='margin-top:25px;margin-bottom:25px;'>Return to home</button>
    			</a>
    		</header>
    	</article>
    	<article class='row'>
    		<header class='col-12'>
    			<p> Let your friends know you are attending</p>
    		</header>
    	</article>
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
    </section>

<?php
	$controller->sendDataToDB($_SESSION['fname'],$_SESSION['lname'],$_SESSION['email']);
	//unset session so if the page is refreshed it doesnt spam emails
    unset($_SESSION['email']);
    unset($_SESSION['fname']);
    unset($_SESSION['lname']);
    unset($_SESSION['dob']);
    unset($_SESSION['phoneno']);

    $footer = new footer();
    $footer->renderFooter();
?>