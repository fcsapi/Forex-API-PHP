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
