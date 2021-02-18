# Live Forex API - PHP

<b>Update: 2021-02-12 (version 3)</b>

FCS currency exchange quotes API is a PHP Library for fetching forex quotes, provide response in array or JSON format.
This library is designed to get latest exchange quotes data, historical rates, economy calendar and indicators data. 

## API Supports Features
* 2000+ Currency exchange rates.
* 10 secods price update frequency
* 25 years historical data
* MA lines and indicators signals
* Economic calendar data

## Requirements
* PHP >= 5.6
* An API key, you can get free at https://fcsapi.com/dashboard

## Installation
Include FCS php library files in your project from github. Next
````PHP
<?php 
use FCS\FCS_forex;

require_once(__DIR__.'/api/FCS_forex.php'); // Include library

````
### Instantiate the client
````PHP
<?php

// You can get your API key from fcsapi.com
define('FCS_KEY', 'API_KEY');

$forex = new FCS_forex(); // create class object

````
### API reponse format
Default output is array for php, valid values are: array, json, jsonp, object, xml, serialize
```PHP
$forex->set_output_type('JSON'); // optional
```
### 	Get the list of available symbols:
````PHP
$response = $forex->get_symbols_list();
````

### Get quotes for specific currency:
````PHP
$response = $forex->get_latest_price([
	'EUR/USD',
	'USD/JPY',
	'GBP/CHF'
]);

// OR  without array
$response = $forex->get_latest_price('EUR/USD,GBP/CHF');

// OR  by ids
$response = $forex->get_latest_price('1,2,3,4');
````

#### Convert one currency into another:
Convert 200 EUR : output = 240USD
````PHP
$response = $forex->	get_converter(200, 'EUR','USD');
````

### Other API methods
You can  check full documentaions here [https://fcsapi.com/document/forex-api](https://fcsapi.com/document/forex-ap)
````PHP
<?php 
	$response = $forex->	get_symbols_list();
	$response = $forex->	get_profile('EUR,USD,JPY');
	$response = $forex->	get_converter(200, 'EUR','USD'); // 200EUR to output 240 USD
	
	$response = $forex->	get_base_prices('EUR');
	$response = $forex->	get_base_prices('EUR','forex',true); // return with last update time
	$response = $forex->	get_base_prices('EUR','crypto');

	$response = $forex->	get_latest_price('all_forex');
	$response = $forex->	get_latest_price('1,2'); // by id, Latest OHLC
	$response = $forex->	get_latest_price( ['EUR/USD','JPY/USD'] ); // OHLC, Ask,bid,spread, change 
	
	$response = $forex->	get_last_candle('all_forex',	'5m');
	$response = $forex->	get_last_candle('all_forex',	'1h');
	$response = $forex->	get_last_candle('all_forex',	'1d');
	$response = $forex->	get_last_candle('1,2,3,4,5',	'1d'); 	// OHLC of specific time period
	
	$response = $forex->	get_pivot_points('1','1d'); 		// Support / Resistance
	$response = $forex->	get_pivot_points('EUR/USD','4h');
	
	$response = $forex->	get_moving_averages('1','1d'); // MA Lines signals
	$response = $forex->	get_moving_averages('EUR/USD','1d');

	$response = $forex->	get_technical_indicator('1','1d'); // Top Indicators
	$response = $forex->	get_technical_indicator('EUR/USD','1d');

	$response = $forex->	get_economy_calendar('USD,JPY');
	$response = $forex->	get_economy_calendar('USD','2021-02-01','2021-02-10');
	
	$response = $forex->	get_search_query('BTC Dollar',0);  // contain any words
	$response = $forex->	get_search_query('BTC Dollar',1); // contain all words

	$response = $forex->	get_history( ['id'=>1,'period'=>'1h'] );
	$response = $forex->	get_history( ['id'=>1,'period'=>'1h','from'=>'2020-01-01', 'to'=>'2020-01-31'] );

````

### Other Links
Forex live prices with php Socket : [Github Real Time prices](https://github.com/fcsapi/Real-Time-Prices-with-Socket-PHP) <br>
Forex JS websocket : [https://fcsapi.com/document/socket-api](https://fcsapi.com/document/socket-api)

## Support and Contact
you can contact us at [support@fcsapi.com](mailto:support@fcsapi.com) or Live chat at https://fcsapi.com

## License and Terms
This library is provided under the MIT license, also FCS privacy policy, terms and conditons apply.
