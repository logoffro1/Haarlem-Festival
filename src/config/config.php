<?php
// Database credentials
$useLocalhost = false;
if($useLocalhost) {
    define ( "DB_HOST", "localhost" );
    define ( "DB_USER", "root" );
    define ( "DB_PASSWORD", "" );
    define ( "DB_DB", "test" );
} else {
    define ( "DB_HOST", "s648539.infhaarlem.nl" );
    define ( "DB_USER", "s648539_guido" );
    define ( "DB_PASSWORD", "qnyMdI6dZR" );
    define ( "DB_DB", "s648539_php" );
}

// Upload folder
define ( "UPLOAD_FOLDER", "/uploads" );
define ( "UPLOAD_PATH", $_SERVER['DOCUMENT_ROOT'].UPLOAD_FOLDER );

// Urls for website
define ('ROOT_URL', 'http://localhost:3000/');
define ('ROOT_URL_PRODUCTION', 'https://emkutuk.com/haarlem-festival/'); // Todo add production url if we need to host it.

// Email used for sending emails
define ('EMAIL', 'graphicabstract@gmail.com');

// Payment
define ('MOLLIE_API', 'test_V6rDKQhKUa5SN8mJkum2sdugqRJxBy');
?>