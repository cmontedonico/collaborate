<?php
   /* require_once('MAPI.class.php');  // same directory as store-address.php

    // grab an API Key from http://admin.mailchimp.com/account/api/
    $api = new MCAPI('852d786e2cdd2b741993614bd1f7e89d-us13');

    
    $merge_vars = Array( 
        'EMAIL' => $_GET['email'],
        'CMPNY' => $_GET['CMPNY'], 
        'CONTADOR' => $_GET['CONTADOR'],
        'CNAME' => $_GET['CNAME'],
        'PHONE' => $_GET['PHONE']
    );

    // grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
    // Click the "settings" link for the list - the Unique Id is at the bottom of that page. 
    $list_id = "305977";

    if($api->listSubscribe($list_id, $_GET['email'], $merge_vars , $_GET['emailtype']) === true) {
        // It worked! 
        echo 'Success!&nbsp; Check your inbox or spam folder for a message containing a confirmation link.';
    }else{
        // An error ocurred, return error message   
        echo '<b>Error:</b>&nbsp; ' . $api->errorMessage;
    }
*/

// Your ID and token
$list_id = "aa59fa6509";
$apikey = 'ef86aba4178244b88de8f2389923d102-us13';

// The data to send to the API
$postData = json_encode([ 
        'email_address' => $_GET['EMAIL'],
        'status' => "subscribed",
        'merge_fields' => [
        'CNAME'=>$_GET['CNAME'],
        'PHONE'=>$_GET['PHONE'],
        'DSPCHO' => $_GET['DSPCHO'],
        'MMERGE9'=>$_GET['MMERGE9'],
        'MMERGE12'=>$_GET['MMERGE12'],
        'MMERGE13'=>$_GET['MMERGE13'],
        'MMERGE10'=>$_GET['MMERGE10'],
        'MMERGE11'=>$_GET['MMERGE11'],
        'MMERGE14'=>$_GET['MMERGE14'],
        'MMERGE15'=>$_GET['MMERGE15'],
        'MMERGE7'=>$_GET['MMERGE7'],
        'MMERGE16'=>$_GET['MMERGE16'],
        'USOURCE'=>$_GET['USOURCE'],
        'UMEDIUM'=>$_GET['UMEDIUM']
]
    ]);
// Setup cURL

$ch = curl_init('https://us13.api.mailchimp.com/3.0/lists/'.$list_id.'/members/');
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_USERPWD => 'Sebastian Sanchez:' . $apikey,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => $postData
));

// Send the request
$response = curl_exec($ch);


$resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($resultStatus == 200) {
        // everything went better than expected
        echo ("exito");
} else {
        // the request did not complete as expected. common errors are 4xx
        // (not found, bad request, etc.) and 5xx (usually concerning
        // errors/exceptions in the remote script execution)

echo('Request failed: HTTP status code: ' . $resultStatus);
echo $response;
    }

?>