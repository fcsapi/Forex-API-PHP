> require_once(__DIR__.'/Forex.php');

> $forex = new FCS_Functions();


# set_access_key
Your access Key is the unique key that is passed into the function
> $forex->set_access_key($api_key);


# Set your API response format.
Set your API response format.<br>
Default: JSON<br>
Valid Values: JSON, JSONP, object, XML, serialize and array<br>
> $forex->set_output_type('JSON');


# Return All symbols
Return All symbols<br>
If the value of top_symbol=1, It will return a list of popular currencies.
> $forex->get_symbols_list();


# get profile
By profile API, you can get the profiles of the different currencies by passing their IDs, Symbols or Single currency short name
> $forex->get_profile('1,2,3');
