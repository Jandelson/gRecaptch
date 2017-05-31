<?php
    require_once "rcaptchvalid.php";
    $secret = "SUA API SECRETA";
    $ReCaptcha = new gRecaptch($secret);
    $response = $ReCaptcha->ValidaRecaptcha(
        $_POST['g-recaptcha-response'],
        $_SERVER['REMOTE_ADDR']
    );

    print $response;
