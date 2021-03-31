<?php
    include '../classes/autoloader.php';

    $head = new head("homepage", "");
    $head->render();

    $navigation = new navigation("Home");
    $navigation->render();

    echo "<section class='container section'>
    <article class='row align-items-left'>
        <header class='col-6'>
        <nav class='breadcrumbs'>
        <ul>
            <li class='breadcrumbs__breadcrumb'><a href='../views/danceEvent.php'>Artist Overview</a></li>
            <li class='breadcrumbs__breadcrumb'><a href='#'>Book more, Save more!</a></li>
        </ul>
    </nav>
        <h1 class='title title--page dance'>Book more, Save more!</h1>
        <p>We have an <b>offer avaliable for all events</b> that can be <b>mix and<br>matched</b> with any other event. For example, you can pair Jazz<br>event tickets with Dance event tickets ands ave on both. These are<br> listed as the '<b>Discount</b>' section on your bill. The more tickets you<br>book, the larger the discount!</p>
           </header>
       </article>
        <article class='row align-items-left'>
             <header class='col-6'>
        <h1 class='title title--page dance'>Day tickets</h1>
        <p><b>Day tickets</b> are <b>cheaper</b> than buying different seperate tickets as it<br>would <b>allow you to access all things related to that specific event<br>on that specific day.</b></p>
           </header>
        </article>
   </section>";
?>

<?php
    $footer = new footer();
    $footer->renderFooter();
?>