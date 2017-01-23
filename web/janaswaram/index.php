<?php
//namespace MicrosoftAzure\Storage\Common;
require 'PHPMailer/PHPMailerAutoload.php';


phpinfo();
// define variables and set to empty values
$nameErr = $proffessionErr = $emailErr = $phonenoErr = $policyErr = $suggestionErr="";
$name = $Profession = $email = $phoneno = $policy = $suggestion= "";
$attachment = "NA";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}




function valid_email($email) 
{
    if(is_array($email) || is_numeric($email) || is_bool($email) || is_float($email) || is_file($email) || is_dir($email) || is_int($email))
        return false;
    else
    {
        $email=trim(strtolower($email));
        if(filter_var($email, FILTER_VALIDATE_EMAIL)===true) return $email;
        else
        {
            $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
            return (preg_match($pattern, $email) === 1) ? $email : false;
        }
    }
}

$allowed = array("image/jpeg", "image/gif", "application/pdf");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    }            
    else if (empty($_POST["Profession"])) {
        $proffessionErr = "Profession is required";
    }            
    else if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    }  
    else if (!valid_email($_POST["email"])) {
        $emailErr = "Invalid email format"; 
    }
    else if (empty($_POST["phoneno"])) {
        $phonenoErr = "Phone Number is required";
    }            
    else if (empty($_POST["policy"])) {
        $policyErr = "Policy is required";
    }
    else if (empty($_POST["suggestion"])) {
        $suggestionErr = "Suggestion is required";
    }
    else {
        $url = 'https://janasenatest.table.core.windows.net:443/Janasena?st=2017-01-16T04%3A42%3A00Z&se=2034-01-17T04%3A42%3A00Z&sp=raud&sv=2015-12-11&tn=janasena&sig=usgASgviZ1Ds2E6jaFG6zXpSLWVIcltlh49%2Bx0uylDM%3D';
        $name = test_input($_POST["name"]);
        $Profession = test_input($_POST["Profession"]);
        $email = test_input($_POST["email"]);
        $phoneno = test_input($_POST["phoneno"]);
        $policy = test_input($_POST["policy"]);
        $suggestion = test_input($_POST["suggestion"]);
          $i = uniqid();
            
        
        $mail = new PHPMailer;
        $mail_us = new PHPMailer;
        
        //------sends email to our email with the inforamtion sent by user ---
      
        $mail_us->setFrom($email, $name );
        
        $mail_us->AddReplyTo( $email, $name );
        
        $mail_us->Sender = $email;
       //$mail_us->addAddress('janaswaram@janasenaparty.org','Janasena Party');
        $mail_us->addAddress('tagore090574@gmail.com','Janasena Party');
        
        $mail_us->Subject = $policy;
        //$mail_us->Body = html_entity_decode($name."<br>".$email."<br>".$phoneno."<br>".$Profession."<br>".$policy."<br>".$suggestion);
        $mail_us->Body = html_entity_decode('<html><head></head><body><table cellspacing="10" style="margin: 0 auto;font-family: sans-serif;font-size:16px;"><tr><td><b>Name</b></td><td>:</td><td>'.$name.'</td></tr><tr><td><b>Profession</b></td><td>:</td><td>'.$Profession.'</td></tr><tr><td><b>Email Address</b></td><td>:</td><td>'.$email.'</td></tr><tr><td><b>Mobile No</b></td><td>:</td><td>'.$phoneno.'</td></tr><tr><td><b>Policy Issues</b></td><td>:</td><td>'.$policy.'</td></tr><tr><td><b>Suggestion/Opinion/Idea</b></td><td>:</td><td>'.$suggestion.'</td></tr></table></body></html>');
        $mail_us->IsHTML(true);
        
        //----- Thank you emai sends to user email----
        $mail->setFrom('janaswaram@janasenaparty.org', 'Janasena Party');
        $mail->AddReplyTo( $email, $name );
        $mail->Sender = 'janaswaram@janasenaparty.org';
        $mail->addAddress($email, $name);
        $mail->Subject = "Janasena Party | Thank you ";
        $mail->Body = html_entity_decode('<!DOCTYPE html><html><head><title></title><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="X-UA-Compatible" content="IE=edge" /><style type="text/css"> body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} img{-ms-interpolation-mode: bicubic;} img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;} table{border-collapse: collapse !important;} body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;} a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; } @media screen and (max-width: 525px) { .wrapper { width: 100% !important; max-width: 100% !important; } .logo img { margin: 0 auto !important; } .mobile-hide { display: none !important; } .img-max { max-width: 100% !important; width: 100% !important; height: auto !important; } .responsive-table { width: 100% !important; } .padding { padding: 10px 5% 15px 5% !important; } .padding-meta { padding: 30px 5% 0px 5% !important; text-align: center; } .padding-copy { padding: 10px 5% 10px 5% !important; text-align: center; } .no-padding { padding: 0 !important; } .section-padding { padding: 50px 15px 50px 15px !important; } .mobile-button-container { margin: 0 auto; width: 100% !important; } .mobile-button { padding: 15px !important; border: 0 !important; font-size: 16px !important; display: block !important; } } div[style*="margin: 16px 0;"] { margin: 0 !important; }</style></head><body style="margin: 0 !important; padding: 0 !important;"><div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Entice the open with some amazing preheader text. Use a little mystery and get those subscribers to read through...</div><table border="0" cellpadding="0" cellspacing="0" width="100%"> <tr> <td bgcolor="#fff" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table"> <tr> <td> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td class="padding" align="center"> <a target="_blank"><img src="http://janasenaparty.org/janaswaram/video-2.png" width="500" height="400" border="0" alt="Insert alt text here" style="display: block; padding: 0; color: #666666; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;" class="img-max"></a> </td> </tr> <tr> <td align="center"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td align="center" style="padding-top: 25px;" class="padding"> <table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container"> <tr> <td align="center" > <p style="text-align: left; font-size: 0.7rem; font-family: arial; color: #333; padding-left: 40px;">Stay connected to Janasena Party<br><br> Follow us on social media</p> <p style="text-align: left; font-size: 1.0rem; color: white; padding-left: 40px;"><a href="https://www.facebook.com/thejanasenaparty/" target="_blank"><img src="https://cdn2.iconfinder.com/data/icons/black-white-social-media/32/facebook_online_social_media-128.png" width="40px"></a><a href="https://m.youtube.com/channel/UCrKevLQTcgUp2kZ-WE0pWZQ" target="_blank"><img src="https://cdn2.iconfinder.com/data/icons/black-white-social-media/32/youtube_online_social_media-128.png" width="40px"></a><a href="https://twitter.com/thejanasena" target="_blank"><img src="https://cdn2.iconfinder.com/data/icons/black-white-social-media/32/online_social_media_twitter-128.png" width="40px"></a> </p> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </td> </tr></table></body></html>');
        $mail->IsHTML(true);
        
        if(!file_exists($_FILES['userfile']['tmp_name']) || !is_uploaded_file($_FILES['userfile']['tmp_name'])) {
            echo 'No upload';
        }else{        
            $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['userfile']['name']));
            
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                
                $curlfile = curl_init();
                $sas= '?st=2017-01-16T04%3A52%3A00Z&se=2034-01-17T04%3A52%3A00Z&sp=rwdl&sv=2015-12-11&sr=c&sig=KX%2BKSY8ebmgMwLAaBAnmMMPH3TYPwbLBi8HdKz%2BKY8w%3D';

                $endpoint = 'https://janasenatest.blob.core.windows.net';
                $container = 'janasena';
                $blob = sha1($_FILES['userfile']['name']);
                $url = $endpoint.'/'.$container.'/'.$blob.$sas;
                $attachment = $url;

                $content = file_get_contents($uploadfile);
                curl_setopt_array($curlfile, array(
             CURLOPT_PORT => "443",
             CURLOPT_URL => $url,
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => "",
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 30,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => "PUT",
             CURLOPT_SSL_VERIFYHOST => 0,
             CURLOPT_SSL_VERIFYPEER => 0,
             CURLOPT_POSTFIELDS => $content,
             CURLOPT_HTTPHEADER => array(
               "cache-control: no-cache",
               "content-type: application/octet-stream",
               "x-ms-blob-type: BlockBlob"
             ),
           ));
                $response = curl_exec($curlfile);
                $err = curl_error($curlfile);

                curl_close($curlfile);


                if ($err) {
                    echo "cURL Error #:" . $err;
                }else{
                  echo "<br>echo1".$response;
                }

                
                $mail_us->addAttachment($uploadfile, $_FILES['userfile']['name']);
              
            }
        }
        
        
        $data = array('Name' => $name,'Profession' => $Profession,'Phone' => $phoneno,'Policy' => $policy,'Attachment'=>$attachment,'Suggestion' => $suggestion,'PartitionKey' => "pk",'RowKey' => $i);
            $data_string = json_encode($data);   
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_PORT => "443",
              CURLOPT_URL => "https://janasenatest.table.core.windows.net:443/Janasena?st=2017-01-16T04%3A42%3A00Z&se=2034-01-17T04%3A42%3A00Z&sp=raud&sv=2015-12-11&tn=janasena&sig=usgASgviZ1Ds2E6jaFG6zXpSLWVIcltlh49%2Bx0uylDM%3D",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_SSL_VERIFYHOST => 0,
              CURLOPT_SSL_VERIFYPEER => 0,
              CURLOPT_POSTFIELDS => $data_string,
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: c913567d-49a0-9968-6cd8-d13a9db42ce4"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                //echo "cURL Error #:" . $err;
            }else{
              //echo "<br>echo 2".$response;
            }
        
        
        //$mail->send();
        //$mail_us->send();
        
        if($mail->send() && $mail_us->send()){
            header('Location: success.php');
            exit;
        }else{
         echo '<script type="text/javascript">$(".loader").hide()</script>';
        }
        
        
        
        
        //}
    }
}

?>
<html>
    <head>
       
        <title>Janaswaram | jansenaparty.org</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Tagore & Ram"> 


    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Cache-control" content="no-cache" />
    <meta http-equiv="Expires" content="0" />


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <link rel="stylesheet" href="css/intlTelInput.css">
        <link rel="stylesheet" href="css/demo.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js" ></script> 
  <!--<link rel="stylesheet" href="css/bootstrap.css">-->
       <!-- Latest compiled and minified CSS -->

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 
        

         <script type="text/javascript" src="js/pramukhime.js"></script>
        <script type='text/javascript' src='js/pramukhindic.js' ></script>

        <script type="text/javascript" src="js/pramukhime-common.js"></script>
        <link type="text/css" href="css/pramukhtypepad.css" rel="Stylesheet" />

         <script src="js/intlTelInput.js"></script>
        
  <style>
  body{
  background: #fefefe;
  margin:0;
  }
  .container{
  background: white;
      -webkit-box-shadow: 1px 1px 10px 5px rgba(160, 160, 160, 0.53);
    -moz-box-shadow: 1px 1px 10px 5px rgba(160, 160, 160, 0.53);
    box-shadow: 1px 1px 10px 5px rgba(160, 160, 160, 0.53);
}
  h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
    font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-weight: 300;
    line-height: 1.1;
    color: inherit;
}
body {
    font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
    
}
  .form-area
  {
      background-color: #FAFAFA;
      padding: 10px 40px 60px;
  }
  .banner{  margin: 0 auto; background:url('banner.png'); background-repeat: no-repeat; background-attachment:absolute; }
  .banner { height: 250px; display:block; padding-top:0px; }
        .form-control:focus {
  border-color: #FF0000;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
}
        .form-control {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #FD2C2B;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }
        .error-text{
          color: red;
        }
 
  .loader{
    position: fixed;
    background: rgba(0,0,0,0.6);
    width:100%;
    height: 100%;
    left:0;
    top:0;
    margin:0 auto;
    z-index : 100;
    display : none;
  }
  .spinner{
    margin: 0 auto;
    width:100px;
    margin-top: 10%;
    height: 100px;
    
  }

  </style>
    </head>
    <body>
    
    <div class="loader">
    <div class="spinner">
      <svg width='48px' height='48px' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="uil-hourglass"><rect x="0" y="0" width="100" height="100" fill="none" class="bk"></rect><g><path fill="none" stroke="#007282" stroke-width="5" stroke-miterlimit="10" d="M58.4,51.7c-0.9-0.9-1.4-2-1.4-2.3s0.5-0.4,1.4-1.4 C70.8,43.8,79.8,30.5,80,15.5H70H30H20c0.2,15,9.2,28.1,21.6,32.3c0.9,0.9,1.4,1.2,1.4,1.5s-0.5,1.6-1.4,2.5 C29.2,56.1,20.2,69.5,20,85.5h10h40h10C79.8,69.5,70.8,55.9,58.4,51.7z" class="glass"></path><clipPath id="uil-hourglass-clip1"><rect x="15" y="20" width="70" height="25" class="clip"><animate attributeName="height" from="25" to="0" dur="1s" repeatCount="indefinite" vlaues="25;0;0" keyTimes="0;0.5;1"></animate><animate attributeName="y" from="20" to="45" dur="1s" repeatCount="indefinite" vlaues="20;45;45" keyTimes="0;0.5;1"></animate></rect></clipPath><clipPath id="uil-hourglass-clip2"><rect x="15" y="55" width="70" height="25" class="clip"><animate attributeName="height" from="0" to="25" dur="1s" repeatCount="indefinite" vlaues="0;25;25" keyTimes="0;0.5;1"></animate><animate attributeName="y" from="80" to="55" dur="1s" repeatCount="indefinite" vlaues="80;55;55" keyTimes="0;0.5;1"></animate></rect></clipPath><path d="M29,23c3.1,11.4,11.3,19.5,21,19.5S67.9,34.4,71,23H29z" clip-path="url(#uil-hourglass-clip1)" fill="#ffab00" class="sand"></path><path d="M71.6,78c-3-11.6-11.5-20-21.5-20s-18.5,8.4-21.5,20H71.6z" clip-path="url(#uil-hourglass-clip2)" fill="#ffab00" class="sand"></path><animateTransform attributeName="transform" type="rotate" from="0 50 50" to="180 50 50" repeatCount="indefinite" dur="1s" values="0 50 50;0 50 50;180 50 50" keyTimes="0;0.7;1"></animateTransform></g></svg>
    </div>
  </div>  
      
        <div class="container">
        <div class="row">
       <img src="img/Layer45.png" style="width:100%" />
        </div>

<!-- 
        <div class="row">
          <div class="col-md-12">
            <div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
 new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,hi,te'}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
          </div>

        </div> -->

       
         <div class="row" style="background: #d81615;color:#fff;">
             <div class="col-md-12">
                    <h4 style="text-align: center" class="top1"><b>Janasena Party stands for strengthening and empowering civil society.</b></h4>
                  <h4 style="text-align: center" class="top2"><b>Introducing Janaswaram, a platform for public participation in policy making.</b></h4>
                <h4 style="text-align: center" class="top3">People with insightful ideas, opinions and suggestions will get a chance to participate in emerging leadership programs & policy workshops.</h4>
                
             </div>
       

</div>
 <div class="row">
          <div class="col-md-12">
             <select id="drpLanguage"
            onchange="javascript:changeLanguage(this.options[this.selectedIndex].value);" 
            name="drpLanguage" title="Choose Language" class="big pull-right">
            <option value='pramukhindic:telugu'>Telugu</option>
            <option value=":english" selected="selected">English</option>
            <option value='pramukhindic:hindi'>Hindi</option>
        </select>
        <p class="pull-right preferedlang">preferred language :</p>
        <ul id="toolbar">
                    <li><a href="javascript:;" onclick="showHelp(this);" id="cmdhelp" title="Typing help"></a></li>
                </ul>
          </div>
        </div>

            <br><br>
        <form method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateform();">
                
        <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label for="name" ><span class="name">Name</span> <span class="error-text"><?php echo " * ".$nameErr;?></span></label>
                <input type="text" name="name" class="form-control" id="name" required>
              </div>
            </div>
       <div class="col-md-6 col-sm-6">
              <div class="form-group">

                <label for="Profession" class=" control-label "><span class="Profession">Profession</span> <span class="error-text"><?php echo " * ".$proffessionErr;?></span></label><br>
                  <select name="Profession" id="Profession" class="form-control" required>
                    <option value="" selected>Select One</option>
                    <option value="Academician">Academician</option>
                    <option value="Student">Student</option>
                    <option value="Self-employed">Self-employed</option>
                    <option value="Housewife">Housewife</option>
                    <option value="Journalist">Journalist</option>
                    <option value="Other">Other</option>
                </select>
              </div>
      </div>
        </div>
       
     <div class="row">
      <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label for="email"><span class="email">Email</span> <span class="error-text"><?php echo " * ".$emailErr;?></span></label>
                <input type="email" name="email" class="form-control" id="email" required>
              </div>
      </div>
      <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label for="phoneno" class="phoneno"><span class="phoneno">Phone Number</span> <span class="error-text"><?php echo " * ".$phonenoErr;?></span></label>
                <input type="text" name="phoneno" class="form-control" maxlength=15 id="phone" required>
              </div>
      </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="policy"><span class="policyissue">Policy Issues</span> <span class="error-text"><?php echo " * ".$policyErr;?></span></label>
                  <select name="policy" class="form-control" required>
                    <option value="" selected>Select One</option>
                    <option value="Land Acquisition">Land Acquisition</option>
                    <option value="Mining - Issues">Mining & Issues</option>
                    <option value="Agriculture">Agriculture</option>
                </select>
              </div>
            </div>
        </div>
        <div class="row">
      <div class="col-md-12">
              <div class="form-group">

                <label for="suggestion" class="sugestion"><span class="suggestion">Suggestion/Opinion/Idea</span> <span class="error-text"><?php echo " * ".$suggestionErr;?></span></label>
                <textarea class="form-control" rows="4" cols="50" required="required" aria-required="true" id="suggestion" name="suggestion"></textarea>
              </div>
      </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="file" ><span class="attachements">Attachments </span></label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" > <span class="attachements_hint">Please attach supporting documents or videos</span> <input class="form-control" name="userfile" type="file" accept=
        "application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
        text/plain, application/pdf,audio/*,video/*,image/* ">
                  </div>
                </div>
            </div>
      <div class="row">
            
      <div class="col-md-12" style="text-align:center;">     
<div class="g-recaptcha" data-sitekey="6LcZQhIUAAAAANQ7XJPTY3hBIcNYOwKZ7OhHus8f" data-theme="light"></div>          
</div>
</div>
      <div class="row">
            
      <div class="col-md-12" style="text-align:center;">     
      <input type="submit" class="btn btn-danger btn-lg" value="Submit">
      </div>
      <br><br>
        </div>
    </form>
            
          
        </div>

     <script>
    $("#phone").intlTelInput({
    allowExtensions: false,
      // allowDropdown: false,
      // autoHideDialCode: false,
        autoPlaceholder: "off",
        autoHideDialCode: false,
    autoPlaceholder: false,
    nationalMode: false,
      // dropdownContainer: "body",
      // excludeCountries: ["IN"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
       initialCountry: "IN",
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
       placeholderNumberType: "MOBILE",
       preferredCountries: ['IN','US','UK'],
      // separateDialCode: true,
      utilsScript: "js/utils.js"
    });
  </script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script>
  function validateform(){
var captcha_response = grecaptcha.getResponse();
if(captcha_response.length == 0)
{
    // Captcha is not Passed
    alert('Please verify google captcha')
    return false;
}
else
{
    // Captcha is Passed
    $(".loader").css("display","block");
    return true;
    
}
}
  </script>
    </body>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-90631816-1', 'auto');
  ga('send', 'pageview');

</script>

<script language="javascript" type="text/javascript">
        pramukhIME.addLanguage(PramukhIndic);

      pramukhIME.enable('suggestion');
      pramukhIME.enable('name');

      //pramukhIME.disable(document.getElementById('phoneno'))
      pramukhIME.onLanguageChange(scriptChangeCallback);
      var lang = (getCookie('pramukhime_language',':english')).split(':');
      pramukhIME.setLanguage(lang[1], lang[0]);
     // var ul = document.getElementById('pi_tips');

      var elem, len = ul.childNodes.length, i;
      for (i = 0; i < len; i++) {
          elem = ul.childNodes[i];
          if (elem.tagName && elem.tagName.toLowerCase() == 'li') {
              tips.push(elem.innerHTML);
          }
      }
      for (i = len - 1; i > 1; i--) {
          ul.removeChild(ul.childNodes[i]);
      }
     // ul.childNodes[i].className = 'tip'; // replace small tip text with large

      //showNextTip(); // call for first time
     // setTimeout('turnOffTip()', 90000); // show tips for 1.5 minutes
           // document.getElementById('suggestion').focus();
            //document.getElementById('name').focus();
            //document.getElementById('Profession').focus();
            //document.getElementById('email').focus();
            //document.getElementById('phone').focus();
            //document.getElementById('phone').focus();



            // set width and height of dialog
            var w = window, d = document, e = d.documentElement, g = d.getElementsByTagName('body')[0], x = w.innerWidth || e.clientWidth || g.clientWidth, y = w.innerHeight || e.clientHeight || g.clientHeight;
            var elem = document.getElementById('dialog');
            elem.style.top = ((y - 550) / 2) + 'px';
            elem.style.left = ((x - 700) / 2) + 'px';



    </script>
</html>