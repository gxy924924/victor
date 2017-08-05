<?php
//装载string
$string=<<<XML
<?xml version='1.0'?>
<document>
<title>Forty What?</title>
<from>Joe</from>
<to>Jane</to>
<body>
I know that's the anser -- but what's the question?
</body>
</document>
XML;
$xml = simplexml_load_string($string);
foreach($xml->xpath("//title") as $title){
	echo "</br>".$title;
}
print_r($xml);
?>
