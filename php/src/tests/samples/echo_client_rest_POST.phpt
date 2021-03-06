--TEST--
Test for echo_client_rest_POST sample
--FILE--
<?php

$reqPayloadString = <<<XML
    <ns1:echoString xmlns:ns1="http://php.axis2.org/samples">
        <text>Hello World!</text>
    </ns1:echoString>
XML;

try {

    $client = new WSClient(
        array("to"=>"http://localhost/samples/echo_service_with_rest.php/echoString",
	      "useSOAP"=>FALSE,
              "HTTPMethod"=>"POST"));

				
    $resMessage = $client->request($reqPayloadString);
    
    printf("Response = %s <br>", htmlspecialchars($resMessage->str));

} catch (Exception $e) {

	if ($e instanceof WSFault) {
		printf("HTTP Status Code: %s\n", $e->httpStatusCode);
	} else {
		printf("Message = %s\n",$e->getMessage());
	}

}
?>

--EXPECT--
Response = &lt;ns1:echoString xmlns:ns1=&quot;http://php.axis2.org/samples&quot;&gt;
        &lt;text&gt;Hello World!&lt;/text&gt;
    &lt;/ns1:echoString&gt; <br>
