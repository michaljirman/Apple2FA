<?php


function plist_payload($appleid,$password){


return '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>appleId</key>
	<string>'.$appleid.'</string>
	<key>attempt</key>
	<string>0</string>
	<key>createSession</key>
	<string>true</string>
	<key>guid</key>
	<string>053dc486d503669415d046efc9ba806b63c4ad8f</string>
	<key>kbsync</key>
	<data>
	AAQAAOootgsqCjMBUq/kKt+S2ugAm7eEJklHP2YLT13f3QpPeSN9wiemI7kC+2T0MfhV
	VJD1/UX8LMrk2MOMI9wpaykxfNq1OT9e0Oxtd2L570hbRkCZGucG/bmD/mhAnfLsDwZ3
	6zqPpoNtat7yMMG/k5P6R7/u1we2UXvKw+LZLPfoqmOjNzZgblsHYcdGL+zbMe1Fpzyu
	8kgG2wwG/nw0LkAKtUCZhruyMJIGi85eTEItyA14ZlemvdPYtKGR6McEXzhqqZSYANyF
	4LpQsul7jixI1aXAAqUTY4GsRwJvnWp5IPtV5lhLzf8zf/U3ml3Uly9kwb+/vDGp4r3t
	R3oOXDGK+fYrBypwKfWxSveSzTPlyl+6X719CB+982CwvxohS0VJ9pn3nuxnkJiIGspL
	xHUCFkwXq58Ae8a8G0J/dJuLAHQyEFIU9jQkxnpig4JnWKDE7nr0eVH7AS8AlOvLRDU=
	</data>
	<key>password</key>
	<string>'.$password.'</string>
	<key>passwordSettings</key>
	<dict>
		<key>free</key>
		<string>always</string>
		<key>paid</key>
		<string>always</string>
	</dict>
	<key>rmp</key>
	<string>0</string>
	<key>why</key>
	<string>signIn</string>
</dict>
</plist>';





}