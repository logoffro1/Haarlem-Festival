<?php
    include '../classes/autoloader.php';

    $head = new head("homepage", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();

    session_start();

    if(isset($_POST['submit'])){

        if(isset($_POST['fname']))
        {
            $_SESSION['fname'] = $_POST['fname'];
        }
        if(isset($_POST['lname']))
        {
            $_SESSION['lname'] = $_POST['lname'];
        }
        if(isset($_POST['email']))
        {
            $_SESSION['email'] = $_POST['email'];
        }
        if(isset($_POST['phoneno']))
        {
            $_SESSION['phoneno'] = $_POST['phoneno'];
        }
        if(isset($_POST['dob']))
        {
            $_SESSION['dob'] = $_POST['dob'];
        }

        header("location:../views/thankyoupage.php");
        exit();
    }
    $steps = new steps(2);
    echo "
    <style>
    .vl {
      border-left: 1px solid #1C294D;
      height: 500px;
    }
    </style>

    <section class='container-fluid section' style='padding-top:0px; padding-bottom:50px; margin-top:100px !important;'>
     <article class='row align-items-left'>
         <header class='col-6' style='margin-left:0px; padding-left:0px;'>
         <nav class='breadcrumbs' style='margin-left:10px;'>
         <ul>
             <li class='breadcrumbs__breadcrumb'><a href='#'>Cart overview</a></li>
             <li class='breadcrumbs__breadcrumb'><a href='#'>Personal details</a></li>
         </ul>
     </nav>
         <h1 class='title title--page dance' style='margin-left:10px;'>Payment</h1>
            </header>
            ";
            $steps->render();

        echo"</article>
        </section>

    <form action='' method='post'>


    <section class='container-fluid section' style='padding-top:0px; padding-bottom:0px;'>
    <!--FIRST HEADER-->
    <article class='row'>
         <header class='col-4' style='padding:0px !important; margin-right:10px !important;'>

    <article class='row align-items-left'>
         <header class='col-5' >
    <p style='font-size:26px'><b>Personal Details</b></p>
    </header>
    </article>

    <article class='row'>
    <header class='col-5'>
    <label for='fname' style='margin-bottom:-25px;'>First name:</label><br>
    <input type='text' id='fname' name='fname' placeholder='e.g. John...'><br>
    </header>
    <header class='col-6'>
    <label for='lname' style='margin-bottom:-25px;'>Last name:</label><br>
    <input type='text' id='lname' name='lname' placeholder='e.g. Doe...'>
    </header>
    </article>


    <article class='row'>
    <header class='col-5'>
    <label for='dob' style='margin-bottom:-25px;'>Date of Birth:</label><br>
    <input type='text' id='dob' name='dob' placeholder='DD/MM/YYYY'>
    </header>
    </article>

    <article class='row'>
    <header class='col-5'>
    <label for='email' style='margin-bottom:-25px;'>Email address:</label><br>
    <input type='text' id='email' name='email' style='width:475px;' placeholder='e.g. example@test.com'>
    </header>
    </article>

    <article class='row'>
    <header class='col-5'>
      <label for='phoneno' style='margin-bottom:-25px;'>Phone number (optional):</label><br>
      <input type='text' id='phoneno' name='phoneno' placeholder='e.g. 00 123 456789'>
    </header>
    </article>

        </header>
    <!--FIRST HEADER CLOSE ABOVE-->




        <!--SECOND HEADER-->
         <header class='col-4 vl' style='margin:0px !important; padding-left:50px;'>

                <article class='row align-items-left'>
                <header class='col-5' >
                    <p style='font-size:26px'><b>Total Price</b></p>
                </header>
                </article>

                <article class='row align-items-left'>
                     <header class='col-5' >
                     <p>Tickets:</p>
                </header>
                                 <header class='col-5' >
                     <p>$10.00</p>
                </header>
                </article>

                            <article class='row align-items-left'>
                     <header class='col-5' >
                     <p><u>Book more, Save more! (Discount)</u></p>
                </header>
                                 <header class='col-5' >
                     <p>-$10.00</p>
                </header>
                </article>

                <article class='row align-items-left'>
                <header class='col-5' >
                <hr style='border:solid 1px #1C294D; width:175%;'></hr>
                </header>
                </article>

                <article class='row align-items-left'>
                <header class='col-5' >
                <p style='font-size:26px;'><b>Total:</b></p>
                </header>
                                             <header class='col-5' >
                     <p>$0.00</p>
                </header>
                </article>

                <article class='row align-items-left'>
                <header class='col-5' >
                <button style='width:150px; height:80px;'>Go back</button>
                </header>
                <header class='col-5'>
                <input type='submit' name='submit' class='button' value='Fill in payment details' style='width:150px; height:80px; padding:0px; white-space:normal;' id='fillindetailsbtn' />
                </header>
                </article>


         </header>
         <!--SECOND HEADER CLOSE ABOVE-->



         <!--THIRD HEADER-->

         <header class='col-3' style='padding:0px !imporant; margin:0px !important;'>
         <article class='row align-items-left'>
                <header class='col-5' >
                    <img src='../assets/images/dance/paymentdetailsimage.png'>
                </header>
                </article>
         </header>
         <!--THIRD HEADER CLOSE ABOVE-->

    </article>
    </section>

    </form> ";
	//$personaldetails = new personaldetails();
	//$personaldetails->render();
?>

<?php
    $footer = new footer();
    $footer->renderFooter();
?>