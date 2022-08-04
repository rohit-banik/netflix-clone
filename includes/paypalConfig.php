<?php
require_once("PayPal-PHP-SDK/autoload.php");

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AftOWeGQ_FFP6z3cG9cJezMfzrTpT9Xa1dopHZW6Cl0FbaqqUSel6RbS2TTvz_nUuJt8jpQpz-u2eOsj',     // ClientID
        'EOh-d1a867WmyjOMnGUfSnOwzhnqgUh-bPzac-JfQPL1wCfV16rWwX9qd0UotvrCE_kjMdQSANRJ5SYK'      // ClientSecret
    )
);

?>