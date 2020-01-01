<?php

/*================================================
Author: FCSAPI
Description: fcsapi github data
Author URL: http://fcsapi.com/
Version: 1.0
================================================*/



/*================================================
  [ Table of contents ]
  ================================================

#1.	set_access_key
#2.	set_output_type
#3.	get_symbols_list
#4.	get_profile
#5.	get_converter
#6.	get_latest_price
#7.	get_last_candle
#8.	get_history
#9.	get_history_graphic_chart
#10. get_pivot_points
#11. get_moving_averages
#12. get_technical_indicator

  ================================================
  [ End table content ]
  ================================================*/


class FCS_Functions {
	private $api_key = '';
	private $output = 'json';


	/*================================================
		set your access key
		format:
			$forex->set_access_key('your_access_key');
	================================================*/
	public function set_access_key($key=''){
		$this->api_key = $key;
	}


	/*================================================
		which type output data return set
		Default: JSON
		Valid Values: JSON, JSONP, object, XML, serialize and array
		format:
			$forex->set_output_type(set_return_type);
		example:
			$forex->set_output_type('json');
	================================================*/
	public function set_output_type($output_type=''){
		if(!empty($output_type)){
			$output_type = strtolower($output_type);
			if($output_type == 'json' || 
				$output_type == 'jsonp' ||  
				$output_type == 'object' ||  
				$output_type == 'xml' ||  
				$output_type == 'serialize' ||
				$output_type == 'array' )
			{
				$this->output = $output_type;
			}
			else{
				return 'Your output type wrong.<br>Valid Values: JSON, JSONP, object, XML, serialize and array';
			}
		}
		else{
			return 'Select Value: JSON, JSONP, object, XML, serialize and array';
		}
	}


	/*================================================
		get list view
	================================================*/
	public function get_symbols_list($top=''){
		if(!$this->check_api_key())
			return "Please add your access key use this function: set_access_key('Set Your Access Key')";

		$link = "https://fcsapi.com/api/forex/list?type=forex&access_key=".$this->api_key."&output=".$this->output;

		if($top =='1')
			$link .= "&top_symbol=1";

		return file_get_contents($link);
	}


	/*================================================
		get profile which id or symbol 
		format:
			1) $forex->get_profile(ids);
			2) $forex->get_profile(symbol);
		example:
			1) $forex->get_profile('1,2,3');
			2) $forex->get_profile('CHF/USD,USD/JPY');
			3) $forex->get_profile('CHF,USD,JPY,GBP,NZD');
	================================================*/
	public function get_profile($which=''){
		if(!$this->check_api_key())
			return "Please add your access key use this function: set_access_key('Set Your Access Key')";

		if(empty($which))
			return "please set id or symbol<br>example:<br>
			1) &#x24;forex->get_profile('1,2,3');<br>
			2) &#x24;forex->get_profile('CHF/USD,USD/JPY');<br>
			3) &#x24;forex->get_profile('CHF,USD,JPY,GBP,NZD');<br>
			<a href='https://fcsapi.com/document/forex-api#profile' target='_blank'>Goto more info</a>";

		$symbol_id = $this->check_symbol_id($which);
		$link = "https://fcsapi.com/api/forex/profile?$symbol_id=$which&access_key=".$this->api_key."&output=".$this->output;

		return file_get_contents($link);
	}


	/*================================================
		get converter data
		Default amount 200
		format:
			1) $forex->get_converter(set_amount, set_id);
			2) $forex->get_converter(set_amount, set_symbol);
			3) $forex->get_converter(set_amount, set_pair_1, set_pair_2);
		example: 
			1) $forex->get_converter(200, 1);
			2) $forex->get_converter(200, 'EUR/USD');
			2) $forex->get_converter(200, 'EUR', 'USD');
	================================================*/
	public function get_converter($amount='200',$pair_one='',$pair_two=''){
		if(!$this->check_api_key())
			return "Please add your access key use this function: set_access_key('Set Your Access Key')";

		if(empty($pair_one))
			return "please set id or symbol<br>example:<br>
			1) &#x24;forex->get_converter(200, 1);<br>
			2) &#x24;forex->get_converter(200, 'EUR/USD');<br>
			3) &#x24;forex->get_converter(200, 'EUR', 'USD');<br>
			<a href='https://fcsapi.com/document/forex-api#converter' target='_blank'>Goto more info</a>";

		if(!empty($pair_two)){
			$link = "https://fcsapi.com/api/forex/converter?pair1=$pair_one&pair2=$pair_two";
		}
		else{
			$symbol_id = $this->check_symbol_id($pair_one);
			$link = "https://fcsapi.com/api/forex/converter?$symbol_id=$pair_one";
		}

		$link .= "&amount=$amount&access_key=".$this->api_key."&output=".$this->output;
		return file_get_contents($link);
	}


	/*================================================
		get latest price forex 
		format:
			1) $forex->get_latest_price(ids);
			2) $forex->get_latest_price(symbol);
		example:
			1) $forex->get_latest_price('1,2');
			2) $forex->get_latest_price('EUR/USD,USD/JPY');
	================================================*/
	public function get_latest_price($which=''){
		if(!$this->check_api_key())
			return "Please add your access key use this function: set_access_key('Set Your Access Key')";

		if(empty($which))
			return "please set id or symbol<br>example:<br>
			1) &#x24;forex->get_latest_price('1,2');<br>
			2) &#x24;forex->get_latest_price('EUR/USD,USD/JPY');<br>
			<a href='https://fcsapi.com/document/forex-api#latestprice' target='_blank'>Goto more info</a>";

		$symbol_id = $this->check_symbol_id($which);
		$link = "https://fcsapi.com/api/forex/latest?$symbol_id=$which&access_key=".$this->api_key."&output=".$this->output;

		return file_get_contents($link);
	}


	/*================================================
		get last candle price forex 
		Default period 1h
		Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month
		format:
			1) $forex->get_last_candle(ids,period);
			2) $forex->get_last_candle(symbol,period);
		example:
			1) $forex->get_last_candle('1,2', '1h');
			2) $forex->get_last_candle('EUR/USD,USD/JPY', '1h');
	================================================*/
	public function get_last_candle($which='',$period='1h'){
		if(!$this->check_api_key())
			return "Please add your access key use this function: set_access_key('Set Your Access Key')";

		if(empty($which))
			return "please set id or symbol<br>example:<br>
			1) &#x24;forex->get_last_candle('1,2', '1h');<br>
			2) &#x24;forex->get_last_candle('EUR/USD,USD/JPY', '1h');<br>
			Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month<br>
			<a href='https://fcsapi.com/document/forex-api#lastcandle' target='_blank'>Goto more info</a>";

		$symbol_id = $this->check_symbol_id($which);
		$link = "https://fcsapi.com/api/forex/candle?$symbol_id=$which&period=$period&access_key=".$this->api_key."&output=".$this->output;

		return file_get_contents($link);
	}


	/*================================================
		get history forex 
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
	================================================*/
	public function get_history($which='',$period='1h',$from='',$to=''){
		if(!$this->check_api_key())
			return "Please add your access key use this function: set_access_key('Set Your Access Key')";

		if(empty($which))
			return "please set id or symbol<br>example:<br>
			1) &#x24;forex->get_history('1', '1h');<br>
			2) &#x24;forex->get_history('EUR/USD', '1h');<br>
			3) &#x24;forex->get_history('EUR/USD', '1h', '2019-07-01', '2019-12-31');<br>
			Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month<br>
			<a href='https://fcsapi.com/document/forex-api#historicalprice' target='_blank'>Goto more info</a>";

		$symbol_id = $this->check_symbol_id($which);
		$link = "https://fcsapi.com/api/forex/history?$symbol_id=$which&period=$period";

		if(!empty($from) && !empty($to)){
			$link .= "&from=$from&to=$to";
		}
		$link .= "&access_key=".$this->api_key."&output=".$this->output;

		return file_get_contents($link);
	}


	/*================================================
		get history graphic chart type data forex 
		Default period 1h
		Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month
		format:
			1) $forex->get_history_graphic_chart(ids, period);
			2) $forex->get_history_graphic_chart(symbol, period);
		example:
			1) $forex->get_history_graphic_chart('1', '1h');
			2) $forex->get_history_graphic_chart('EUR/USD', '1h');
	================================================*/
	public function get_history_graphic_chart($which='',$period='1h'){
		if(!$this->check_api_key())
			return "Please add your access key use this function: set_access_key('Set Your Access Key')";

		if(empty($which))
			return "please set id or symbol<br>example:<br>
			1) &#x24;forex->get_history_graphic_chart('1', '1h');<br>
			2) &#x24;forex->get_history_graphic_chart('EUR/USD', '1h');<br>
			Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month<br>
			<a href='https://fcsapi.com/document/forex-api#historicalprice' target='_blank'>Goto more info</a>";

		$symbol_id = $this->check_symbol_id($which);
		$link = "https://fcsapi.com/api/forex/history?$symbol_id=$which&period=$period&chart=1&access_key=".$this->api_key;

		return file_get_contents($link);
	}


	/*================================================
		get pivot points forex 
		Default period 1h
		Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month
		format:
			1) $forex->get_pivot_points(ids,period);
			2) $forex->get_pivot_points(symbol,period);
		example:
			1) $forex->get_pivot_points('1', '1h');
			2) $forex->get_pivot_points('EUR/USD', '1h');
	================================================*/
	public function get_pivot_points($which='',$period='1h'){
		if(!$this->check_api_key())
			return "Please add your access key use this function: set_access_key('Set Your Access Key')";

		if(empty($which))
			return "please set id or symbol<br>example:<br>
			1) &#x24;forex->get_pivot_points('1', '1h');<br>
			2) &#x24;forex->get_pivot_points('EUR/USD', '1h');<br>
			Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month<br>
			<a href='https://fcsapi.com/document/forex-api#pivotpoints' target='_blank'>Goto more info</a>";

		$symbol_id = $this->check_symbol_id($which);
		$link = "https://fcsapi.com/api/forex/pivot_points?$symbol_id=$which&period=$period&access_key=".$this->api_key."&output=".$this->output;

		return file_get_contents($link);
	}


	/*================================================
		get moving averages forex 
		Default period 1h
		Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month
		format:
			1) $forex->get_moving_averages(ids,period);
			2) $forex->get_moving_averages(symbol,period);
		example:
			1) $forex->get_moving_averages('1', '1h');
			2) $forex->get_moving_averages('EUR/USD', '1h');
	================================================*/
	public function get_moving_averages($which='',$period='1h'){
		if(!$this->check_api_key())
			return "Please add your access key use this function: set_access_key('Set Your Access Key')";

		if(empty($which))
			return "please set id or symbol<br>example:<br>
			1) &#x24;forex->get_moving_averages('1', '1h');<br>
			2) &#x24;forex->get_moving_averages('EUR/USD', '1h');<br>
			Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month<br>
			<a href='https://fcsapi.com/document/forex-api#movingaverages' target='_blank'>Goto more info</a>";

		$symbol_id = $this->check_symbol_id($which);
		$link = "https://fcsapi.com/api/forex/ma_avg?$symbol_id=$which&period=$period&access_key=".$this->api_key."&output=".$this->output;

		return file_get_contents($link);
	}


	/*================================================
		get technical indicator forex 
		Default period 1h
		Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month
		format:
			1) $forex->get_technical_indicator(ids,period);
			2) $forex->get_technical_indicator(symbol,period);
		example:
			1) $forex->get_technical_indicator('1', '1h');
			2) $forex->get_technical_indicator('EUR/USD', '1h');
	================================================*/
	public function get_technical_indicator($which='',$period='1h'){
		if(!$this->check_api_key())
			return "Please add your access key use this function: set_access_key('Set Your Access Key')";

		if(empty($which))
			return "please set id or symbol<br>example:<br>
			1) &#x24;forex->get_technical_indicator('1', '1h');<br>
			2) &#x24;forex->get_technical_indicator('EUR/USD', '1h');<br>
			Period Valid Values: 5m, 15m, 30m, 1h, 5h, 1d, 1w, month<br>
			<a href='https://fcsapi.com/document/forex-api#technicalindicator' target='_blank'>Goto more info</a>";

		$symbol_id = $this->check_symbol_id($which);
		$link = "https://fcsapi.com/api/forex/indicators?$symbol_id=$which&period=$period&access_key=".$this->api_key."&output=".$this->output;

		return file_get_contents($link);
	}



	/*================================================
		check api key
	================================================*/
	private function check_api_key(){
		$temp_key = strtolower($this->api_key);
		if(empty($this->api_key) || $temp_key == 'api_key')
		//if(empty($this->api_key))
			return false;
		else
			return true;
	}


	/* where type id or symbol check */
	private function check_symbol_id($txt){
		$type = 'id';
		if(preg_replace("/[^A-Za-z?!]/",'',$txt))
			$type = 'symbol';

		return $type;
	}
}



?>