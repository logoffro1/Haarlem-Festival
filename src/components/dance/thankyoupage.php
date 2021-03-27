<?php
include '../classes/autoloader.php';
class thankyoupage
{
	public function render()
    {
		echo "		<section class='container-fluid section' style='padding:0px;'>
		<article class='row align-items-left'>
			<header class='col-6'>
					   <p>Payment Information > Thank you</p>
			<h1 class='title title--page dance'>Payment</h1>
			   </header>
			   <img src='../assets/images/dance/paymentprogress2.png' style='width:50%; height:50%;'>
		   </article>
		   </section>
		   <h1 class='title title--page dance' style='margin-left:510px;'>Thank you for your purchase!</h1>
	   <section class='container section' style='padding:0px; margin-left:auto; margin-right:auto; width:100em; text-align:center;'>
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
	   <button style='margin-top:25px;margin-bottom:25px;'>Return to home</button>
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
	   ";
	}
}
?>