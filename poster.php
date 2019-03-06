<html>
 <head>
  <title>Create Lead</title>
 </head>
 <body>
 <?php 
 
 $firstname=$_POST['first_name'];
 $lastname=$_POST['last_name'];
 $phone=$_POST['phone'];
 $email=$_POST['email'];
 $comments=$_POST['comments'];
 $address=$_POST['address'];

$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_SSL_VERIFYPEER => 0,
CURLOPT_POST => 1,
CURLOPT_HEADER => 0,
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => 'https://bitrix.cloudxchange.co.nz/rest/21/naal6u4zolm5d3id/crm.lead.add.json',


CURLOPT_POSTFIELDS => http_build_query(array(
    'fields' => array(
    "TITLE" => $firstname.' '.$lastname,
    "NAME" => $firstname,
    "LAST_NAME" => $lastname,
    "STATUS_ID" => "NEW",
    "OPENED" => "Y",
    "COMMENTS" => $comments,
    "ADDRESS" => $address,
    "ASSIGNED_BY_ID" => 1,
    "PHONE" => array(array("VALUE" =>$phone, "VALUE_TYPE" => "WORK" )),
    "EMAIL" => array(array("VALUE" => $email, "VALUE_TYPE" => "WORK" )),
    ),
    'params' => array("REGISTER_SONET_EVENT" => "Y")
    )),
));
$result = curl_exec($curl);
curl_close($curl);
$result = json_decode($result, 1);
if (array_key_exists('error', $result)) {echo "Error saving lead: ".$result['error_description']."<br/>";  } else{
    echo("Success");
}
 ?>
 </body>
</html>