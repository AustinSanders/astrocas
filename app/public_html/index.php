<?php
     if(!extension_loaded('krb5')) {
             die('KRB5 Extension not installed');
     }

     foreach ($_SERVER as &$i){
       echo $i . "\n";
     }

     if(!empty($_SERVER['HTTP_AUTHORIZATION'])) {
            list($mech, $data) = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);
             if(strtolower($mech) == 'basic') {
                     echo "Client sent basic";
                     die('Unsupported request');
             } else if(strtolower($mech) != 'negotiate') {
                     echo "Couldn't find negotiate";
                     die('Unsupported request');
             }
             $auth = new KRB5NegotiateAuth('/tmp/austin.keytab');
             $reply = '';
             if($reply = $auth->doAuthentication()) {
                     header('HTTP/1.1 200 Success');
                     echo 'Success - authenticated as ' . $auth->getAuthenticatedUser() . '<br>';
             } else {
                     echo 'Failed to authN.';
                     die();
             }
     } else {
             header('HTTP/1.1 401 Unauthorized');
             header('WWW-Authenticate: Negotiate',false);
             echo 'Not authenticated. No HTTP_AUTHORIZATION available.';
             echo 'Check headers sent by the browser and verify that ';
             echo 'apache passes them to PHP';
     }
     ?>
