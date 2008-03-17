--TEST--
SOAP 1.1 one-way message
--FILE--
<?php
/*
 * Copyright 2005,2006 WSO2, Inc. http://wso2.com
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


$reqPayloadString = <<<XML
<notify xmlns="http://example.org/echo">test</notify>
XML;

try {
   
	$reqMessage = new WSMessage($reqPayloadString, 
        array("to" => "http://131.107.72.15/WSAddressingCR_Service_WCF/WSAddressing10.svc/Soap11",
              "action" => "http://example.org/action/notify"
			  ));
	
	$client = new WSClient(array("useSOAP" => "1.1",
                                 "useWSA" => TRUE /*,
								 "proxyHost" => "10.100.1.145",
			                     "proxyPort" => "9090"*/
			                     ));

	$client->send($reqMessage);
	printf("Message Sent...\n");
	
   } catch (Exception $e) {
	if ($e instanceof WSFault) {
		printf("Soap Fault: %s\n", $e->Code);
	} 
}
?>
--EXPECT--
Message Sent...
