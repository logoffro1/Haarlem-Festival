<?php 

class notification
{

    public function render()
    { 
        echo "<section class='notification--jazz hidden'>
                        <p id='notification--text'></p>
                </section>";
    }

    public function displayNotification(string $msg,string $type)
    {
        if($type == "jazz")
        {
        echo "<script>
                    document.getElementById('notification--text').innerHTML = '$msg';
                    var notification = document.getElementsByClassName('notification--jazz hidden')[0]; 
                    notification.classList.remove('hidden');
                    notification.classList.add('show');
                    setTimeout(() => {notification.classList.remove('show');
                        notification.classList.add('hide');}, 2000)</script>";
        }
        else if($type == "dance")
        {
            echo "<script>
                        document.getElementById('notification--text').innerHTML = '$msg';
                        var notification = document.getElementsByClassName('notification--jazz hidden')[0]; 
                        notification.classList.remove('hidden');
                        notification.classList.remove('notification--jazz');
                        notification.classList.add('notification--dance');
                        notification.classList.add('show');
                        setTimeout(() => {notification.classList.remove('show');
                            notification.classList.add('hide');}, 2000)</script>";
        }
}}

?>