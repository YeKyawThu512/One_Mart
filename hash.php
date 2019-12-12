<?php

include "dbcon.php";

// Encrypt cookie
function encryptCookie( $value ) {
    $key  = '@#3r$@ft#$70%^&*&^%$!bj!xdcc@$vn^gh*tidufj1903hgf4674@';
    $newvalue = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $key ), $value, MCRYPT_MODE_CBC, md5( md5( $key ) ) ) );
    return( $newvalue );
}

// Decrypt cookie
function decryptCookie( $value ) {
    $key  = '@#3r$@ft#$70%^&*&^%$!bj!xdcc@$vn^gh*tidufj1903hgf4674@';
    $newvalue = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $key ), base64_decode( $value ), MCRYPT_MODE_CBC, md5( md5( $key ) ) ), "\0");
    return( $newvalue );
}

?>