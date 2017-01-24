<?php 


function send_mail($email,$subject,$msg) {
 $api_key="key-8b9ec8621dc641919463d10a9848c2a9";/* Api Key got from https://mailgun.com/cp/my_account */
 $domain ="janasenaparty.org";/* Domain Name you given to Mailgun */
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
 curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/'.$domain.'/messages');
 curl_setopt($ch, CURLOPT_POSTFIELDS, array(
  'from' => 'Open <tagore090574@gmail.com>',
  'to' => $email,
  'subject' => $subject,
  'html' => $msg
 ));
 $result = curl_exec($ch);
 curl_close($ch);
 return $result;
}





/*$mg_api = 'key-8b9ec8621dc641919463d10a9848c2a9';
$mg_version = 'api.mailgun.net/v2/';
$mg_domain = "www.janasenaparty.org";
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
print_r($res);*/
?>