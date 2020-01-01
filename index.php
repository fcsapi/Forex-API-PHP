<?php
require_once(__DIR__.'/Forex.php');

global $forex;
$forex = new Forex_Functions();

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



/*======================================
Accepted Parameters: id, symbol, period
ast Forex Candle API only support ID/Symbols of Popular currencies list as described above in the "All Symbols List" Section.

Default period 1h
Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month
format:
	1) $forex->get_last_candle(ids,period);
	2) $forex->get_last_candle(symbols,period);
example:
	1) $forex->get_last_candle('1,2','1h');
	2) $forex->get_last_candle('EUR/USD,USD/JPY','1h');
======================================*/
echo '<br><h3>Last Candle Prices</h3>';
echo $forex->get_last_candle('1,2');



/*======================================
Accepted Parameters: id, symbol, from, to
We provide a simple and easy to use latest historical API which returns the previous 300 candle which is the latest and easy to watch the latest market.

Default period 1h
Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month
format:
	1) $forex->get_history(ids, period);
	2) $forex->get_history(symbol, period);
	3) $forex->get_history(symbol, period, from_date, to_date);
example:
	1) $forex->get_history('1', '1h');
	2) $forex->get_history('EUR/USD', '1h');
	3) $forex->get_history('EUR/USD', '1h', '2019-07-01', '2019-12-31');
======================================*/
echo '<br><h3>Historical Price</h3>';
echo $forex->get_history('1');



/*======================================
Accepted Parameters: id, symbol, period
In financial markets, a pivot point is a support/resistance level is a helper that is used by traders as a possible indicator of market movement.

Default period 1h
Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month
format:
	1) $forex->get_pivot_points(ids, period);
	2) $forex->get_pivot_points(symbol, period);
example:
	1) $forex->get_pivot_points('1', '1h');
	2) $forex->get_pivot_points('EUR/USD', '1h');
======================================*/
echo '<br><h3>Forex Pivot Points</h3>';
echo $forex->get_pivot_points('1','1d');



/*======================================
Accepted Parameters: id, symbol, period
Moving Average (MA) is a trend indicator. MA lines are used by traders to check the average market value on the base of previous (5,10,20,50,100,200) candles.

Default period 1h
Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month
format:
	1) $forex->get_moving_averages(ids, period);
	2) $forex->get_moving_averages(symbol, period);
example:
	1) $forex->get_moving_averages('1', '1h');
	2) $forex->get_moving_averages('EUR/USD', '1h');
======================================*/
echo '<br><h3>Forex Moving Averages</h3>';
echo $forex->get_moving_averages('1','1d');



/*======================================
Accepted Parameters: id, symbol, period
Technical indicators are calculated with the help of top forex indicators (MA,RSI,STOCH,ATR etc). The Collection of Indicators Powerful & Profitable Forex Trading Strategies and Systems that work.

Default period 1h
Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month
format:
	1) $forex->get_technical_indicator(ids, period);
	2) $forex->get_technical_indicator(symbol, period);
example:
	1) $forex->get_technical_indicator('1', '1h');
	2) $forex->get_technical_indicator('EUR/USD', '1h');
======================================*/
echo '<br><h3>Forex Technical Indicator</h3>';
echo $forex->get_technical_indicator('1','1d');

?>
