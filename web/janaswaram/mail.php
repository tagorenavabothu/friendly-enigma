<?php 
$mg_api = 'key-3ax6xnjp29jd6fds4gc373sgvjxteol0';
$mg_version = 'api.mailgun.net/v2/';
$mg_domain = "janasenaparty.org";
$mg_from_email = "tagore090574@gmail.com";
$mg_reply_to_email = "tagore090574@gmail.org";

$mg_message_url = "https://".$mg_version.$mg_domain."/messages";


$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

curl_setopt ($ch, CURLOPT_MAXREDIRS, 3);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_VERBOSE, 0);
curl_setopt ($ch, CURLOPT_HEADER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);

curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $mg_api);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_POST, true); 
//curl_setopt($curl, CURLOPT_POSTFIELDS, $params); 
curl_setopt($ch, CURLOPT_HEADER, false); 

//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_URL, $mg_message_url);
curl_setopt($ch, CURLOPT_POSTFIELDS,                
        array(  'from'      => 'aaaa <' . 'aaa@aaa.com' . '>',
                'to'        => 'tagore090574@gmail.com',
                'h:Reply-To'=>  ' <' . $mg_reply_to_email . '>',
                'subject'   => 'aaaaa'.time(),
                'html'      => 'aaaaaa',
                'attachment'[1] => 'aaa.rar'
            ));
$result = curl_exec($ch);
curl_close($ch);
$res = json_decode($result,TRUE);
print_r($res);
?>