<?php 

class jazzNotification
{

    public function render()
    { 
        echo "<section class='notification--jazz hidden'>
                        <p id='notification--textJazz'>ASD</p>
                </section>";
    }

    public function displayNotification(string $msg)
    {
        echo "<script>
                    document.getElementById('notification--textJazz').innerHTML = '$msg';
                    document.getElementsByClassName('notification--jazz hidden')[0].classList.remove('hidden');
                    document.getElementsByClassName('notification--jazz')[0].classList.add('show');
                    setTimeout(() => {document.getElementsByClassName('notification--jazz show')[0].classList.remove('show');
                        document.getElementsByClassName('notification--jazz')[0].classList.add('hide');}, 2000)</script>";
    }
}

?>