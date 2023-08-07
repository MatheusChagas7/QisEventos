<?php 

    //Config SANDBOX or PRODUCTION environment
    $SANDBOX_ENVIRONMENT = true;
    
    $PAGSEGURO_API_URL = 'https://ws.pagseguro.uol.com.br/v2';
    if($SANDBOX_ENVIRONMENT){
        $PAGSEGURO_API_URL = 'https://ws.sandbox.pagseguro.uol.com.br/v2';
    }

    $PAGSEGURO_EMAIL = 'matheus.me.ngo@hotmail.com';
    $PAGSEGURO_TOKEN = 'E1F464F81D524DF88D07E00B37B7994F';
?>