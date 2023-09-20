$Partner=utf8_encode("XXXXXX");
$PrivateKey=utf8_encode("XXXXXXXX");

// Student information
$Login=utf8_encode("XXXXXXX"); 
$Password=urlencode("XXXXXX"); //16 chars maximum
$FirstName=urlencode("XXXXX");
$LastName=urlencode("XXXXXX");
$Email=urlencode("XXXXXXX@noemail.com");
$InterfaceLanguage=urlencode("en-US");
$Role=urlencode("1");

// the following PHP function calculates the number of seconds since 01/01/1970
$Timer=(string)gmdate("U");
// calculates the MD5 value to be validate in the RST portal using the MD5 PHP native function
$Check=MD5($Login.$Partner.$Timer.$PrivateKey);

// Information concerning the student target language
$Discipline=urlencode("ENGLISH");
$Offer=urlencode("XXXXXXXXXXXXXX");

//Information about Client's organization
$Host=urlencode("64");
$Client=urlencode("76");
$Admingrp=urlencode("312");
$Pedagrp=urlencode("574");

// Redirection after the student working session
$EndingURL = urlencode("http://XXXXXXXXXX.com");

// Final Request
$Redirect="http://XXXXXXXXXXXXX/ApiHandler.ashx?XXX_cmd=403&XXX_role=$Role&XXX_login=$Login&XXX_partner=$Partner&XXX_endingurl=$EndingURL&XXX_timer=$Timer&XXX_method=MD5&XXX_check=$Check&XXX_password=$Password&XXX_pupildiscipline=$Discipline&XXX_interfacelanguage=$InterfaceLanguage&XXX_firstname=$FirstName&XXX_lastname=$LastName&XXX_email=$Email&XXX_host=$Host&XXX_client=$Client&XXX_offername=$Offer&XXX_pedagroup=$Pedagrp&XXX_admingroup=$Admingrp";
?>


