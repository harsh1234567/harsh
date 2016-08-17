<?php
function tallyrequest($cname,$mif,$mit) {
ini_set('max_execution_time', 400); 
 
$requestXML = '<ENVELOPE>
 	<HEADER>
    		<VERSION>1</VERSION>
    		<TALLYREQUEST>Export</TALLYREQUEST>
    		<TYPE>Collection</TYPE>
    		<ID>All Sales Vchs</ID>
 	</HEADER>
	<BODY>
		<DESC>
		<STATICVARIABLES>
<SVCURRENTCOMPANY>';
$requestXML=$requestXML.$cname;
$requestXML=$requestXML.'</SVCURRENTCOMPANY>
</STATICVARIABLES>
			<TDL>
				<TDLMESSAGE>
					<COLLECTION NAME="All Sales Vchs" ISMODIFY="No">
						<TYPE>Vouchers : Voucher Type</TYPE>
						<CHILDOF>$$VchTypeSales</CHILDOF>
						<BELONGSTO>Yes</BELONGSTO>
						<FETCH> SVCURRENTCOMPANY,MasterId,PartyLedgerName,VoucherNumber,Date,  VOUCHERTYPENAME,BASICBUYERNAME,BASICDATETIMEOFINVOICE,LedgerEntries.*</FETCH>
						<COMPUTE> TotalReading : $Other1 </COMPUTE>
						<FILTER>MasterIDFilter</FILTER>
					</COLLECTION>
				<SYSTEM TYPE="Formulae" NAME="MasterIDFilter" ISMODIFY="No">$masterid between ';
				$requestXML=$requestXML.$mif .' and '.$mit.' </SYSTEM>
				</TDLMESSAGE>
			</TDL>
		</DESC>
	</BODY>
</ENVELOPE>';
//echo "<xmp>".$requestXML."</xmp>";
	 $server = 'LOCALHOST:9000';
	 //$server = '172.16.1.145:9000';
	 //$server = '103.245.8.29:9000';
 //$headers = array( "Content-type: text/xml","Content-length:".strlen($requestXML) ,"Connection: close");
  $headers = array( "Content-length:".strlen($requestXML) ,"Connection: close");
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $server);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 400);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXML);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$data = curl_exec($ch);
if(curl_errno($ch)){
    print curl_error($ch);
    echo "  something went wrong..... try later";
}else{
    $z= $data;
     ///$z= "<xmp>".$data."</xmp>";
	 $z=str_replace("&#","",$z);
	 $z=str_replace("UDF:_UDF_","UDF",$z);
	 $z=str_replace(".LIST","",$z);
     return $z;
	 echo $z= "<xmp>".$data."</xmp>"; 
}
curl_close($ch);
}


?>


 