<?php
require_once('vendor/autoload.php');

$stripe = [
    "secret_key" => "sk_test_HFNquqVUu7wgd2Vc8XvLjrCH00TlmafiA8",
    "publishable_key" => "pk_test_7tWsrqqPikUVFzIoEcmWY0PW00G0UCFxDY",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);

?>