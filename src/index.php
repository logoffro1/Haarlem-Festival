<?php
$useLocalhost = false;
if($useLocalhost) {
    header("Location: /views/homepage.php");
} else {
    header("Location: /haarlem-festival/views/homepage.php");
}
?>