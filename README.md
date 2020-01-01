# require_once(__DIR__.'/Forex.php');

// global $forex;<br>
// $forex = new FCS_Functions();


# set_access_key
$forex->set_access_key($api_key);


# Set your API response format.
$forex->set_output_type('JSON');


# Return All symbols
$forex->get_symbols_list();


# get profile
$forex->get_profile('1,2,3');
