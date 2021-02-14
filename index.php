<?php

require_once(__DIR__.'/config.php');
require_once(__DIR__.'/api/Forex.php');

$forex = new FCS_forex();

## GET latest prices
$response = $forex->get_base_prices('EUR');

echo "<pre>";
print_r($response);

/*
	Each method take times to get data from server, so dont use all at same time.
*/

	#### Methods Summary ####
/*
	$forex->set_output_type('JSON'); // Optional 

	$response = $forex->	get_symbols_list();
	$response = $forex->	get_profile('EUR,USD,JPY');
	$response = $forex->	get_converter(200, 'EUR','USD'); // 200EUR to output 240 USD
	
	$response = $forex->	get_base_prices('EUR');
	$response = $forex->	get_base_prices('EUR','crypto');

	$response = $forex->	get_latest_price('all_forex');
	$response = $forex->	get_latest_price('1,2'); // by id, Latest OHLC
	$response = $forex->	get_latest_price('EUR/USD'); // OHLC, Ask,bid,spread, change 
	
	$response = $forex->	get_last_candle('all_forex',	5m');
	$response = $forex->	get_last_candle('all_forex',	1h');
	$response = $forex->	get_last_candle('all_forex',	1d');
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

	$params 	  = array('id'=>1,'period'=>'1h','limit'=>2);
	$response = $forex->	get_history($params);
	OR with FROM/TO
	$params    = array('id'=>1,'period'=>'1d','from'=>'2020-01-01', 'to'=>'2020-01-31');
	$response = $forex->	get_history($params);

*/



?>
