<?php
	require_once("payload.php");


	echo "\033[1;33m###############################################\n";
	echo "###############################################\n";
	echo "######### Apple 2FA Token Extractor ###########\n";
	echo "###############################################\n";
	echo "###############################################\n\033[0m";

	echo "Apple ID: ";
	$handle = fopen ("php://stdin","r");
	$AppleID = trim(fgets($handle));


	echo "Password: ";
	$handle = fopen ("php://stdin","r");
	$Password = trim(fgets($handle));


	echo "\nSending 2FA request...\n";

	init($AppleID,$Password);

	echo "2FA Code: ";
	$handle = fopen ("php://stdin","r");
	$Code = trim(fgets($handle));


	$Result =  authenticate($AppleID,$Password,$Code);


	echo GetInfo($Result);



	function init($appleid,$password){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://p29-buy.itunes.apple.com/WebObjects/MZFinance.woa/wa/authenticate");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, plist_payload($appleid,$password));
		curl_setopt($ch, CURLOPT_POST, 1);

		$headers = array();
		$headers[] = "X-Apple-AMD-M: t6cxFF5hlIcZE3F78DWiONx6I++mJJj7l2j2bOH9MWcoj2OtGA5DOYQwqyAqNFLTpmSeJTHWRj3Qvxjj";
		$headers[] = "X-Apple-ActionSignature: Am0/KICzJye9R2FN//xOBsRWaAjEToKdsJYiYtN/zHGBAAABUAMAAABKAAAAgFHZhTIj4CbS3FEZmggKQU59Mf+dmC3XsTXS5EqNB7p3KqjOqqE3Xr0e7K8pr0dCSY6p4umLNx135fhmI/Z3Zs3NHIgiU/ARjcw9Pn8PLIGXR53fabbferL8bxCgBzu9soEeHmxKvUj+L29y2wt4eFKBpJL7Y/YHmtoZ12npqjJsAAAAGvbPmbtDvnJV+rE4aLfneZn9BqN9FVddiQ0FAAAAnwFLkVW7tTWwiey7PXVH5e9hOyEk9gAAAIYCBcl/aeJx+yKkVZ2+OEaw2z9ZJiy/zT+h7esjhlTlSK2UBDID+xxZ/c+ryxMh3bJOmbfCcLsqMDNru/PV5h5YvXXHhtYazdHKaT07En0uNxfam1gfs/MY5YlR5WSuiA5G5MfQ7iVkY6afWrsXSrFmGnsF4+Fxagc630y7OmcMGsORUtXtlQAAAAAAAAEEOScZAA==";
		$headers[] = "Accept-Language: en";
		$headers[] = "X-Apple-Connection-Type: WiFi";
		$headers[] = "X-Apple-Store-Front: 143441-1,30";
		$headers[] = "X-Apple-Client-Versions: GameCenter/2.0";
		$headers[] = "X-Apple-AMD: AAAABAAAABCM95Ta1rjl3qCqzwAlfuht";
		$headers[] = "Cookie: xp_ci=3z1qCh6Pz3u3z4POzCtFzihZJ1e5l; xp_abc=17Eg4xa2; mzf_in=292607; itspod=29; ns-mzf-inst=39-83-443-101-73-8125-292607-29-nk11; itst=0; xp_ab=1#isj11bm+1820+17Eg4xa2; itre=0";
		$headers[] = "X-Apple-Partner: origin.0";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
			if (curl_errno($ch)) {
    		echo 'Error:' . curl_error($ch);
		}

		$HTTPCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($HTTPCode == 307)die("\nAccount does not have 2FA.\n");

		
		curl_close ($ch);



	 	if (strpos($result, "incorrect") !== false)die("\nYour Apple ID or password was entered incorrectly.\n");

		return $result;
	}



	function authenticate($appleid,$password,$code){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://setup.icloud.com/setup/authenticate/$APPLE_ID$");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, '');
		curl_setopt($ch, CURLOPT_POST, 1);

		$headers = array();
		$headers[] = "Authorization:Basic ".base64_encode($appleid.":".$password.$code);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);

			if (curl_errno($ch)) {
    			echo 'Error:' . curl_error($ch);
			}

		curl_close ($ch);
		return $result;
}




	function GetInfo($data){
		$plist = simplexml_load_string($data);
	 	$dsid = '/plist[@version="1.0"]/dict/dict[1]/string/text()';       
	 	$dsid = $plist->xpath($dsid);
	 	$token = '/plist[@version="1.0"]/dict/dict[2]/string/text()';       
	 	$token = $plist->xpath($token);

		$DSID = (string)$dsid[0];
		$Token = (string)$token[0];
		return $DSID.":".$Token."\n";
	}



?>