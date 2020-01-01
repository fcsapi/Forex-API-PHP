<?php
require_once(__DIR__.'/Forex.php');

global $forex;
$forex = new FCS_Functions();

/*======================================
Your access Key is the unique key that is passed into the function
======================================*/
$api_key = 'API_KEY'; // signup to get your api_key 
$forex->set_access_key($api_key);



/*======================================
Set your API response format.
Default: JSON
Valid Values: JSON, JSONP, object, XML, serialize and array
======================================*/
$forex->set_output_type('JSON');



/*======================================
Return All symbols
If the value of top_symbol=1, It will return a list of popular currencies.

example:
	1) $forex->get_symbols_list();
	2) $forex->get_symbols_list('1');
======================================*/
echo '<br><h3>Symbols list</h3>';
echo $forex->get_symbols_list();



/*======================================
Accepted Parameters: id, symbol
By profile API, you can get the profiles of the different currencies by passing their IDs, Symbols or Single currency short name

format:
	1) $forex->get_profile(ids);
	2) $forex->get_profile(symbol);
example:
	1) $forex->get_profile('1,2,3');
	2) $forex->get_profile('CHF/USD,USD/JPY');
	3) $forex->get_profile('CHF,USD,JPY,GBP,NZD');
======================================*/
echo '<br><h3>Forex Currency Profile Details</h3>';
echo $forex->get_profile('1,2,3');



/*======================================
Accepted Parameters: amount id, symbol
In any Forex API, currency conversion is the most common and a popular part, through which we can get price conversion between two different specified currencies. To do so, you just simply have to attach the symbols parameter with amount to convert it into your required currency.

format:
	1) $forex->get_converter(set_amount, set_id);
	2) $forex->get_converter(set_amount, set_symbol);
	3) $forex->get_converter(set_amount, set_pair_1, set_pair_2);
example:
	1) $forex->get_converter(200, 1);
	2) $forex->get_converter(200, 'EUR/USD');
	2) $forex->get_converter(200, 'EUR', 'USD');
======================================*/
echo '<br><h3>Currency Converter</h3>';
echo $forex->get_converter(200, 1);



/*======================================
Accepted Parameters: id, symbol
Forex latest price API is very useful, you must have to get in touch with the updated price of a currency That's why the latest prices are included in any API which is the most common part.

format:
	1) $forex->get_latest_price(ids);
	2) $forex->get_latest_price(symbols);
example:
	1) $forex->get_latest_price('1,2');
	2) $forex->get_latest_price('EUR/USD,USD/JPY');
======================================*/
echo '<br><h3>Currency Latest Price</h3>';
echo $forex->get_latest_price('1,2');
