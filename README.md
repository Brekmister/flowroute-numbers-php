# flowroute-numbers-php

**Flowroute-numbers-php** is a php API Wrapper that provides methods for interacting with **v1** (version 1) of the[Flowroute](https://www.flowroute.com) API. These methods can be used to accomplish the following:

* Search for purchasable phone numbers
* Purchase phone numbers
* View your owned phone numbers and their related details
* Create new inbound routes
* Update the primary and failover route on a phone number

### Documentation 
The full documentation for the v2 Flowroute API is available [here](https://developer.flowroute.com/v2.0/docs).

##Before you begin

The following are required before you can deploy the SDK.

### Have your API credentials

You will need your Flowroute API credentials (Access Key and Secret Key). These can be found on the **Preferences > API Control** page of the [Flowroute](https://manage.flowroute.com/accounts/preferences/api/) portal. If you do not have API credentials, contact <mailto:support@flowroute.com>.

### Know your Flowroute phone number

To create and send a message, you will need your Flowroute phone number, which should be enabled for SMS. If you do not know your phone number, or if you need to verify whether or not it is enabled for SMS, you can find it on the [DIDs](https://manage.flowroute.com/accounts/dids/) page of the Flowroute portal.

###Download Composer

Composer is used to manage the dependencies for the PHP SDK. The Composer installation file, **composer.phar**, can be downloaded from Composer's web site [here](https://getcomposer.org/download). Download, but do not install it; only after first installing the libraries will you install Composer.

## Install the libraries

> **Note:** You must be connected to the Internet in order to install the required libraries.

1. Open a terminal session. 

2. If needed, create a parent directory where you want to install the SDK.
 
3. Change directories to the newly created directory, and from the command line run:

 	`git clone https://github.com/flowroute/flowroute-numbers-php.git`
 	
 	The `git clone` command clones the **flowroute-numbers-php** respository as a sub directory within the parent folder.
 	
4.	Change directories to the newly created **flowroute-numbers-php** directory.

##Install Composer

1.	Move the downloaded **composer.phar** file to the **flowroute-numbers-php** directory.

	>**Note:** **composer.phar** must be in the **flowroute-numbers-php** directory in order to install correctly. Composer requires a **composer.json** file, which is included in the imported SDK to help manage dependencies.

2. 	From a terminal window, run:

		php composer.phar install

 	Composer sets up the required file structure.
  
## Create a PHP file to import the Controllers and Models

The following describes importing the SDK and setting up your API credentials. Importing the SDK allows you to instantiate the [Controllers](#controllers), which contain the methods used to perform tasks with the SDK. In order to do this, create and run a PHP file. 

1. Using a code text editor — for example, *Sublime Text* — create a new file and add the following lines to import the Controllers and Methods:

		<?php
		require_once('vendor/autoload.php');
	
		use FlowrouteNumbersLib\Controllers\InboundRoutesController;
		use FlowrouteNumbersLib\Controllers\PurchasablePhoneNumbersController;
		use FlowrouteNumbersLib\Controllers\TelephoneNumbersController;
		
		$irc = new InboundRoutesController();
		$pnc = new PurchasablePhoneNumbersController();
		$tnc = new TelephoneNumbersController();
		
		use FlowrouteNumbersLib\Models\BillingMethod;
		use FlowrouteNumbersLib\Models\Route;
		
		?>
   
3. Save the file in your top-level **flowroute-numbers-php** folder. For this example, the PHP file is named ***import.php***.

4.	On the command line, run the PHP file you just created. For example,

		run import.php

4.	Next, configure your API Access Key and Secret Key.

5.	From the **flowroute-numbers-php** directory change directories to **src**. 

6.	Using a code text editor, open **Configuration.php**. 

7.	In **Configure.php** replace the AccessKey and SecretKey variables with your Flowroute API credentials. The file should resemble the following:

	```sh
		<?php
		/*
		 * FlowrouteNumbersLib
		 *
		 * This file was automatically generated for flowroute by APIMATIC BETA v2.0 on 02/12/2016
		 */
	
		namespace FlowrouteNumbersLib;
	
		class Configuration {
 			//The base Uri for API calls
   			public static $BASEURI = 'https://api.flowroute.com/v1';
	
			//Tech Prefix
    		//TODO: Replace the $username with an appropriate value
			public static $username = '1111111';

			//API Secret Key
			//TODO: Replace the $password with an appropriate value
			public static $password = 'm8axLA45yds7kmiC88aOQ9d5caADg6vr';
		}
```

8.	Save the file.

	The Controllers point automatically to **Configuration.php**, so there is no need to do anything else with this file.
	
## Controllers<a name=controllers></a>

This SDK describes the following Controllers:

<li>[`PurchasablePhoneNumbersController`](#purchaseno)

<li>[`TelephoneNumbersController`](#telephoneno)

<li>[`InboundRoutesController`](#inboundco) 

When passing a method, and the method has additional parameters, you are not required to pass the parameter name in the method. For example, the `listAreaAndExchange ($limit=null,$npa=null,$page=null)` method can be formatted as `listAreaAndExchange (10,206,3)` where the `limit` is `10`, the `npa` is `206`, and the page to return is `3`.


### PurchasablePhoneNumbersController<a name=purhcaseno></a>

The Purchasable Phone Numbers Controller contains all of the methods necessary to search through Flowroute's phone number inventory. Methods must be added to a PHP file and that file run from a command line. For example, you can create a **purchase.php** file contains the following information:

	<?php

	require_once('vendor/autoload.php');

	use FlowrouteNumbersLib\Controllers\PurchasablePhoneNumbersController;
	
	$pnc = new PurchasablePhoneNumbersController();

	?>

You can then add lines for each of the following PurchasePhoneNumbersController methods and comment out each line as needed, or create unique files for each of the following methods:

*	[`listAvailableNPAs()]`(#listnpa)
* 	[`listAreaAndExchange()`](#listnpanxx)
* 	[`search()`](#searchno)

You can run the file on the command line using the `php <PHP file>` command.

#### `listAvailableNPAs ($limit=null)`<a name=listnpa></a>

The `listAvailableNPAs` method allows you to retrieve a list of every NPA (area code) available in Flowroute's phone number inventory.
#####Usage

Add the following lines to your PHP file:

	$response = $pnc->listAvailableNPAs();
	print_r($response);`

>**Note:** `$response` can be any name of you choose, and of any length, but the name you choose must be used consistently in the method.

The method can take the following parameter:

| Parameter | Required |Type |Description                           |
|-----------|----------|-----|--------------------------------|
| `limit`     | False  |integer| Controls the number of items returned. The maximum number of items is 200. If neither a number nor `null` are passed, a default of ten NPAs are returned. |

##### Example usage
	
	$response = $pnc->listAvailableNPAs(3);
	print_r($response);

#####Example response
For the `listAvailableNPAs(3)` request, the first three NPAs are returned:

```sh
(
    [npas] => stdClass Object
        (
            [201] => stdClass Object
                (
                    [nxxs] => /v1/available-tns/npanxxs/?npa=201
                    [tns] => /v1/available-tns/tns/?npa=201
                )

            [203] => stdClass Object
                (
                    [nxxs] => /v1/available-tns/npanxxs/?npa=203
                    [tns] => /v1/available-tns/tns/?npa=203
                )

            [202] => stdClass Object
                (
                    [nxxs] => /v1/available-tns/npanxxs/?npa=202
                    [tns] => /v1/available-tns/tns/?npa=202
                )

        )

    [links] => stdClass Object
        (
            [next] => /v1/available-tns/npas/?limit=3&page=2
        )
```

#### `listAreaAndExchange ($limit=null,$npa=null,$page=null)`<a name=listnpanxx></a>

The `listAreaAndExchange` method allows you to retrieve a list of every NPA NXX (area code and exchange) combination available in Flowroute's phone number inventory.

#####Usage
Add the following lines to your PHP file:
	
	$response = $pnc->listAreaAndExchange ()
	print_r($response)

>**Note:** `$response` can be any name of your choosing, and of any length, but the name you choose must be used consistently in the method.
	
The method takes the following parameters:

| Parameter | Required |Type| Description                                                         |
|-----------|----------|--------------|-------------------------------------------------|
| `limit`     | False    | integer| Controls the number of items returned. The maximum number of items is 200. If neither a number nor `null` are passed, a default of ten NPA-NXX combinations are returned.                 |
| `npa`       | False  | integer| Three-digit area code. Limits results to the specified NPA. If `null` is passed, all NPAs are returned. Partial number search is also supported. For example, passing `20` returns all NPA and NXX results that include `20`.|
| `page`      | False  |integer  | Sets which page of the results is returned.` Next` and `Prev` URLs provided at the bottom of the response provide navigation pointers. If `null` is passed, all pages are returned.   |

##### Example usage

In the following, a request is made to limit the results to `2`, the NPA to `203` and to display page `3`:
		
	$response = $pnc->listAreaAndExchange(2,203,2);
	print_r($response);
	
#####Example response
Based on the example usage above, the following two NPA NXX combinations are returned on page 2, organized by NPANXX. 

```sh
(
    [npanxxs] => stdClass Object
        (
            [203583] => stdClass Object
                (
                    [tns] => /v1/available-tns/tns/?npa=203&nxx=583
                )

            [203567] => stdClass Object
                (
                    [tns] => /v1/available-tns/tns/?npa=203&nxx=567
                )

        )

    [links] => stdClass Object
        (
            [prev] => /v1/available-tns/npanxxs/?npa=203&limit=2&page=2
            [next] => /v1/available-tns/npanxxs/?npa=203&limit=2&page=4
        )

)
```
#### `search ($limit = NULL,$npa = NULL,$nxx = NULL,$page = NULL,$ratecenter = NULL,$state = NULL,$tn = NULL)`<a name=searchno></a>

The search method is the most robust option for searching through Flowroute's purchasable phone number inventory. It allows you to search by NPA, NXX, Ratecenter, State, and TN.

#####Usage
Add the following lines to your PHP file:

	$response = $pnc->search();
	print_r($response)

>**Note:** `$response` can be any name of your choosing, and of any length, but the name you choose must be used consistently in the method.

The method supports the following parameters:

| Parameter  | Required|   Type|          Description                                         |
|------------|----------|------|--------------------------------------------------------|
| `limit`     | False    | integer| Controls the number of items returned. The maximum number of items is 200. If neither a number nor `null` are passed, a default of ten NPA NXX combinations are returned.                      |
| `npa`       | False, unless `nxx` is passed, then `True`.  | integer| Three-digit area code. Limits results to the specified NPA. If `null` is passed, all NPAs are returned. Partial number search is also supported. For example, passing `20` returns all NPA and NXX results that include `20`.|
| `nxx`       |False  | integer |Three-digit exchange. Limits the results for the specified NXX. If no `nxx` is passed, `null` is used and all results are returned. Partial search is also supported. For example, passing `'45'` for the `nxx` returns exchanges that include `45`. Note that if you pass an `nxx` you must also pass an `npa`. |
| `page`      | False   | integer |Sets which page of the results is returned.` Next` and `Prev` URLs provided at the bottom of the response provide navigation pointers. If `null` is passed, all pages are returned.   |            |
| `ratecenter` | False |string             | Limits the results to the specified ratecenter.  There is no limit on the number of characters that can be passed, and this field is case-insensitive. |                      |
| `state`      | False, unless `ratecenter` is passed, then `True`.|string | Limits results to the specified state or Canadian province. Must be formatted using the two-letter state or province/territory abbreviation. This field is case-insensitive.                           |
| `tn`         | False  |string             | Limits results to the specified telephone number. The phone number must be passed as an 11-digit number formatted as *`1NPNXXXXXX`*.  |

##### Example Usage

In the following example, a search request sets the `limit` to `3`, `206` for the `npa`, `641` for the `nxx`, `2` for the `page`, `seattle` for the `ratecenter`, `wa` for the `state`, and `null` for the `tn`.

	$response = $pnc->search(3,206,641,2,seattle,wa,null);
	print_r($response);
	
#####Response
Based on the passed parameters for the `search()`, the response returns three results:

```sh
(
    [tns] => stdClass Object
        (
            [12066417848] => stdClass Object
                (
                    [initial_cost] => 1.00
                    [monthly_cost] => 1.25
                    [billing_methods] => Array
                        (
                            [0] => VPRI
                            [1] => METERED
                        )
                    [ratecenter] => SEATTLE
                    [state] => WA
                )
            [12066417632] => stdClass Object
                (
                    [initial_cost] => 1.00
                    [monthly_cost] => 1.25
                    [billing_methods] => Array
                        (
                            [0] => VPRI
                            [1] => METERED
                        )
                    [ratecenter] => SEATTLE
                    [state] => WA
                )
            [12066417664] => stdClass Object
                (
                    [initial_cost] => 1.00
                    [monthly_cost] => 1.25
                    [billing_methods] => Array
                        (
                            [0] => VPRI
                            [1] => METERED
                        )
                    [ratecenter] => SEATTLE
                    [state] => WA
                )
        )
    [links] => stdClass Object
        (
            [next] => /v1/available-tns/tns/?npa=206&nxx=641&state=wa&ratecenter=seattle&limit=3&page=2
        )
)
```

#####Response field descriptions	
The following fields are returned in the response:

Parameter | Description                                             |
|--------|-------------------------------------------------------|
| `tns`  | Object composed of a `telephone number`, `state`, `ratecenter`, and `billing_methods`.|                           |
||	*`telephone number`*- The retrieved telephone number object, which is composed of:|
||	<ul><ul><li> `initial_cost`- The one-time fixed cost for that telephone number. The default value is USD `1.00`.</ul>|
| | <ul><ul><li>`monthly_cost`- The recurring monthly cost to maintain that telephone number. The default value is USD `1.25`.</ul>|
| |<ul><ul><li>`billing_methods`- Displays the billing methods available for the telephone number: <ul><li>`[0] VPRI`, or</ul></li> <ul><li>`[1] METERED` </ul></li>|
||	`ratecenter`- The ratecenter associated with the NPA/NXX.|
||	`state`- The US State or Canadian province or territory in which the NPA NXX is located.</ol>|


### TelephoneNumbersController<a name=telephoneno></a>

The TelephoneNumbersController contains all of the methods necessary to purchase and manage a Flowroute number. Methods must be added to a PHP file and that file run from a command line. For example, you can create a **telephone.php** file contains the following information:

	<?php

	require_once('vendor/autoload.php');

	use FlowrouteNumbersLib\Controllers\TelephoneNumbersController;
	
	$tnc = new TelephoneNumbersController();

	?>

You can then add lines for each of the following PurchasePhoneNumbersController methods and comment out each line as needed, or create unique files for each of the following methods:
The Telephone Numbers Controller contains all of the methods necesary to purchase a new phone number and to manage your owned phone number inventory. The Controller supports the following methods:

<li>[`purchase`](#purchaseno)
<li>[`listAccountTelephoneNumbers`](#listnumbers)
<li>[`telephoneNumberDetails`](#phonedetails)
<li>[`update`](#updateroute)
</li>

#### `purchase ($billing,$number)`<a name=purchaseno></a>

The purchase method is used to purchase a telephone number from Flowroute's inventory.

#####Usage

	$billing = new BillingMethod('');
	$number = 'phone number';
	$response = $tnc->purchase($billing, $number);

Create three variables:

|Variable name    |Required  |Type      |Description|
|-----------------|----------|----------|-------------------------------------------------------| 
|`$billing `      | True     | string   |This variable assigns the billing method. An unlimited number of characters can be used. For this example, `$billing` is the name of the variable. |
|`$number`        | True     | string   | This variable identifies the phone number to purchase. An unlimited number of characters can be used. For this example, `$number` is the name of the variable.|
|`$response`      | True     | string   | This variable identifies the response to purchase. An unlimited number of characters can be used. For this example, `$response` is the name of the variable.|

The variables then take the following parameters

| Parameter       | Required | Type|Description                                                 |                                                          
|-----------------|----------|--------|-------------------------------------------------------|
| `BillingMethod`   | True     |string  | Sets the billing method applied to the purchased number. This must be one of the following: <li>`METERED` — unlimited concurrent calls, each billed per-minute used.</li> <li> `VPRI` — limits the number of concurrent calls to the number of VPRI channels you have, but with unlimited usage on each channel. </li>|       
| `number` | True    | string | The telephone number to purchase, using an E.164 *`1NPANXXXXXX`* format.                |
	
##### Example Usage

For the following example, a new number is being purchased that uses `VPRI` for the billing method:

	$billing = new BillingMethod('VPRI');
	$number = '12066417848';
	$response = $tnc->purchase($billing, $number);
	print_r($response);

#####Example response

If the purchase is successful, a **201 Created** and empty message string are returned indicating the date on which the purchase occurred:

		(
   		 [code] => 201
       		 [raw_body] =>
   		 [body] =>
   		 [headers] => Array
     	   (
     	       [0] => HTTP/1.1 201 Created
     	       [Content-Type] => application/json
    	        [Date] => Thu, 26 May 2016 18:32:36 GMT
    	        [Server] => nginx
   	         [Content-Length] => 0
    	        [Connection] => keep-alive
  	    	  )


####`listAccountTelephoneNumbers ($limit = NULL,$page = NULL,$pattern = NULL)`<a name=listnumbers></a>

The listAccountTelephoneNumbers method is used to retrieve a list of all of the phone numbers on your Flowroute account.

#####Usage

	listAccountTelephoneNumbers()

The method takes the following parameters:

| Parameter | Required |     Type | Description                                    |
|-----------|----------|-----------|-----------------------------------------------|
| `limit`     | False    | integer| Controls the number of items returned. The maximum number of phone numbers is 200. If neither a number nor `null` are passed, a default of ten numbers are returned.                      
| `page`      | False  |integer  | Sets which page of the results is returned.` Next` and `Prev` URLs provided at the bottom of the response provide navigation pointers. If `null` is passed, all pages are returned.   |
| pattern   | False | string  | The phone number on which to search. Partial number search is supported; for example, if `206` is passed the response returns all phone numbers which include `206`. If neither a number nor `null` are passed, all numbers associated with the account are returned.  |

##### Example Usage
For this example, the `limit` is `1`, the `page` is `null`, and the `pattern` includes `206`.
	
	$response = $tnc->listAccountTelephoneNumbers(1,null,206);
	print_r($response);

#####Example response

Based on the passed parameters, the number purchased using the [purchase](#purhcaseno) method above is returned as the response:

	(
    [tns] => stdClass Object
        (
            [12066417848] => stdClass Object
                (
                    [billing_method] => VPRI
                    [routes] => Array
                        (
                            [0] => stdClass Object
                                (
                                    [type] => SIP-REG
                                    [name] => sip-reg
                                )

                            [1] => stdClass Object
                                (
                                    [type] => SIP-REG
                                    [name] => sip-reg
                                )
                        )
                    [detail] => /v1/tns/12066417848
                )
        )
    [links] => stdClass Object
        (
            [next] => /v1/tns/?pattern=206&limit=1&page=2
        )
	)    
 
#####Response field descriptions	
 
The following information is returned within the response:

Parameter | Description                                             |
|--------|-------------------------------------------------------|
| `tns`  | Object composed of a `telephone number`, `billing_method`, and `routes`.|                           
||	*`telephone number`*- The retrieved telephone number object, which is composed of:|
||	<ul><ul><li> `billing_method`- The billing method assigned to the phone number when the number was purchased. This will be either `METERED` or `VPRI`.</ul>|
| |<ul><ul><li>`routes`- Displays the primary `[0]` and failover `[1]` routes for the phone number: <ul><li>`type` — Indicates the type of route: `HOST`, `PSTN`, or `URI`. If no route is assigned, `SIP-REG` is the default name assigned to the route.</ul></li> <ul><li>`name` — Name of the route. If no `name` was given to the route, `sip-reg` is the assigned default name.</ul></li> **Note:** Routes are created using the [createNewRoute](#createroute) endpoint.|


#### `telephoneNumberDetails($Number)`<a name=phonedetails></a>

The telephoneNumberDetails method is used to retrieve the billing method, primary route, and failover route for the specified telephone number. 

#####Usage

		$number = 'telephoneNumber';
		telephoneNumberDetails($number)
		print_r($response);

>**Note:** `$number` and `$response` can be any name of your choosing, and of any length, but the name you choose must be used consistently in the method.

The method takes the following parameter:

| Parameter       | Required | Type   |Description                                    |
|-----------------|----------|--------|-------------------------------------------|
| `telephoneNumber` | True     | string |    The telephone number on which to query. You must use an 11-digit, E.164 number, formatted as *`1NPANXXXXXX`*. Neither partial number search nor multiple number search are supported. |

##### Example Usage

For the following example, the number purchased using the [purchase](#purchaseno) method is passed in the request:

	$number = '12066417848';
	$response = $tnc->telephoneNumberDetails($number);
	print_r($response);

#####Example response
	(
    [billing_method] => VPRI
    [routes] => Array
        (
            [0] => stdClass Object
                (
                    [type] => SIP-REG
                    [name] => sip-reg
                )
            [1] => stdClass Object
                (
                    [type] => SIP-REG
                    [name] => sip-reg
                )
        )
	)

#####Response field descriptions	
 
The following information is returned within the response:

Parameter | Description                                             |
|--------|-------------------------------------------------------|                       
|| `billing_method`- The billing method assigned to the phone number when the number was purchased. This will be either `METERED` or `VPRI`.</ul>|
| |`routes`- Displays the primary `[0]` and failover `[1]` routes for the phone number: <ul><li>`type` — Indicates the type of route: `HOST`, `PSTN`, or `URI`. If no route is assigned, `SIP-REG` is the default name assigned to the route.</ul></li> <ul><li>`name` — Name of the route. If no `name` was given to the route, `sip-reg` is the assigned default name.</ul></li> **Note:** Routes are created using the [createNewRoute](#createroute) endpoint.|

#### `update ($number,$routes)`<a name=updateroute></a>

The `update` method is used to update both the primary and failover route for a phone number. Both the primary and failover route must be specified inside of an array. See Example Usage below. The first route name specified is assigned as the primary route and the second route name specified will be assigned as the failover route. The list of available route names can be retrieved by using the list method in the InboundRoutesController.

>**Note:** In order to apply an existing route to a number, the route must first be created using the [createNewRoute](#createRoute) method. To view a list of your existing routes, use the [mlist](#listroutes) method.

#####Usage

	$rtes = '{"routes": [{"name": "primary route name"}, {"name": "failover route name"}]}'; 
	$response = $tnc->update('telephoneNumber',$rtes);
	print_r($response);

>**Important:** `$rtes` and `$response` are variables that can be assigned any name of you choose, and of any length; however, the names you choose you must use consistently in the method.

| Parameter       | Required | Type |Description                                                       |
|-----------------|----------|-------|-----------------------------------------------------------------|
|`name='route name'`|True| string| Name of an existing route. The first `name` in the array will be assigned the primary route; the second `name` in the array will be assigned the secondary, or failover, route. 
| `telephoneNumber` | True     | string |    The telephone number for which to update the route. You must use an 11-digit, E.164 number, formatted as *`1NPANXXXXXX`*.| 

##### Example Usage
	
	$rtes = '{"routes": [{"name": "HOSTroute1"}, {"name": "PSTNroute1"}]}'; 
	$response = $tnc->update('12064205780',$rtes);
	print_r($response);
	
#####Example response

No confirmation message is returned for a successful update. To view the route changes on the phone number, run the 
[`listAccountTelephoneNumbers()`](#inboundco) or [`telephoneNumberDetails()`](#phonedetails) methods.

#####Error response 
| Error code | Message  | Description                                           |
|------------|----------|-------------------------------------------------------|
|No error code.  |HTTP Response Not OK|This can be caused when a route does not exist, a route name has been misspelled, or an incorrect phone number was passed in the method.|

###InboundRoutesController<a name=inboundco></a>

The Inbound Routes Controller contains the methods required to view all of your existing inbound routes and to create new inbound routes.

#### `mlist ($limit = NULL,$page = NULL)`<a name=listroutes></a>

The list method is used to return all of the existing inbound routes from your Flowroute account.

#####Usage

	$response = $inbound->mlist();
	print_r($response)

>**Important:** `$response` is a variable that can be assigned any name of you choose, and of any length; however, the name you choose you must use consistently in the method.

The method takes the following parameters:

| Parameter | Required | Type   |Usage                                    |
|-----------|----------|---------|----------------------------------------|
| `limit`     | False    | integer| Controls the number of routes returned. The maximum numberis 200. If neither a number nor `null` are passed, a default of ten routes are returned.  |                    
| `page`      | False  |integer  | Sets which page of the results is returned.` Next` and `Prev` URLs provided at the bottom of the response provide navigation pointers. If `null` is passed, all pages are returned.   |

##### Example Usage

For this example, a `limit` of `4` routes  and the `page` to return set to `null` are passed.

	$inbound = new InboundRoutesController();
	$response = $inbound->mlist(4,null);
	print_r($response);
	
#####Example response

Based on the parameters passed in the request, the following is returned:

	(
    [routes] => stdClass Object
        (
            [HOSTroute1] => stdClass Object
                (
                    [type] => HOST
                    [value] => 24.239.23.40:5060
                )
            [PSTNroute1] => stdClass Object
                (
                    [type] => PSTN
                    [value] => 178
                )
            [URIroute1] => stdClass Object
                (
                    [type] => URI
                    [value] => sip:16476998778@215.122.69.152:5060
                )
            [sip-reg] => stdClass Object
                (
                    [type] => SIP-REG
                    [value] =>
                )
        )
	)

These routes can be applied to any of your purchased phone numbers using the [`update`](#updateroute) method.

#### `createNewRoute ($routeName,$type,$value)`<a name=createroute></a>
 
The createNewRoute method is used to create a new inbound route.

| Parameter | Required | Usage                                                                                   |
|-----------|----------|-----------------------------------------------------------------------------------------|
| route_name | True     | The name you would like to assign to the new route (supports alphanumeric characters)   |
| mtype      | True     | The type of route you would like to create. Valid options are "HOST", "PSTN", and "URI" |
| value     | True     | The actual route that you would like to create                                          |

##### Example Usage

	$response = $irc->createNewRoute('PSTNroute1','PSTN','19513232211');
	print_r($response);
	$response = $irc->createNewRoute('HOSTroute1','HOST','4.239.23.40:5060');
	print_r($response);
	$response = $irc->createNewRoute('URIroute1','URI','sip:120664480000@215.122.69.152:5060');
	print_r($response);