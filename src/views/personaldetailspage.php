<?php
    include '../classes/autoloader.php';

    $head = new head("homepage", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();

    session_start();
    $errors = array();
    $fnameErr = $lnameErr = $emailErr = $phonenoErr = $dobErr = "";
    $fname = $lname = $email = $phoneno = $dob = "";
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["fname"]))
        {
            $fnameErr = "First Name is required";
            $errors[] = $fnameErr;
        }
        else
        {
            $fname = test_input($_POST["fname"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$fname))
            {
                $fnameErr = "Only letters and white space allowed";
                $errors[] = $fnameErr;
            }
            $_SESSION['fname'] = $_POST['fname'];
        }
        if (empty($_POST["lname"]))
        {
            $lnameErr = "Last Name is required";
            $errors[] = $lnameErr;
        }
        else
        {
            $lname = test_input($_POST["lname"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$lname))
            {
                $lnameErr = "Only letters and white space allowed";
                $errors[] = $lnameErr;
            }
            $_SESSION['lname'] = $_POST['lname'];
        }

        if (empty($_POST["email"]))
        {
            $emailErr = "Email is required";
            $errors[] = $emailErr;
        }
        else
        {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $emailErr = "Invalid email format";
                $errors[] = $emailErr;
            }
            $_SESSION['email'] = $_POST['email'];
        }
        if (empty($errors)){
            header("location:../views/thankyoupage.php");
        }
    }

?>
<?php
    $steps = new steps(2);
?>
    <style>
    .vl {
      border-left: 1px solid #1C294D;
      height: 630px;
    }
    .error {color: #FF0000;}
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
            <?php $steps->render(); ?>

        </article>
        </section>

    <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>


    <section class='container-fluid section' style='padding-top:0px; padding-bottom:0px;'>
    <!--FIRST HEADER-->
    <article class='row'>
         <header class='col-4' style='padding:0px !important; margin-right:10px !important;'>

    <article class='row align-items-left'>
         <header class='col-5' >
    <p style='font-size:26px'><b>Personal Details</b></p>
    </header>
    <p>Fields marked with an asterisk (*) indicate mandatory fields</p>
    </article>

    <article class='row'>
    <header class='col-5'>
    <label for='fname' style='margin-bottom:-25px;'>First name*:</label><br>
    <input type='text' id='fname' name='fname' placeholder='e.g. John...'><br>
    <span class="error"><?php echo $fnameErr;?></span>
    <br><br>
    </header>
    <header class='col-6'>
    <label for='lname' style='margin-bottom:-25px;'>Last name*:</label><br>
    <input type='text' id='lname' name='lname' placeholder='e.g. Doe...'><br>
    <span class="error"><?php echo $lnameErr;?></span>
    </header>
    </article>


    <article class='row'>
    <header class='col-5'>
    <label for='dob' style='margin-bottom:-25px;'>Date of Birth:</label><br>
    <input type='text' id='dob' name='dob' placeholder='DD/MM/YYYY'><br>
    <span class="error"><?php echo $dobErr;?></span>
    <br><br>
    </header>
    </article>

    <article class='row'>
    <header class='col-5'>
    <label for='email' style='margin-bottom:-25px;'>Email address*:</label><br>
    <input type='text' id='email' name='email' style='width:475px;' placeholder='e.g. example@test.com'><br>
    <span class="error"><?php echo $emailErr;?></span>
    <br><br>
    </header>
    </article>

    <article class='row'>
    <header class='col-5'>
      <label for='phoneno' style='margin-bottom:-25px;'>Phone number:</label><br>
      <input type='text' id='phoneno' name='phoneno' placeholder='e.g. 00 123 456789'><br>
      <span class="error"><?php echo $phonenoErr;?></span>
      <br><br>
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
                <input type='submit' name='submit' value='Fill in payment details' style='width:150px; height:80px; padding:0px; white-space:normal; background-color:#1C294D; color:white;' id='fillindetailsbtn' />
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

    </form>

<?php
    $footer = new footer();
    $footer->renderFooter();
?>