<?php
/*
 * This Controller is used to determine the Time of Use periods
 *		- Summer, Winter, Holiday
 *		- Prices are included
 *
 *		REF: http://www.ontario-hydro.com/current-rates
 */

?>
<?php namespace App\Controllers\Time;

use App\Kernel\ControllerAbstract;

class TimeController extends ControllerAbstract
{

	public $prices;
	public $period;

	public function __construct(){
		$this->prices = array(
			'mid' => 13.2,
			'on' => 18.0,
			'off' => 8.7
		);
	}

	public function getHolidayValues(){

		$hours = array();
		foreach(range(0, 23) as $hour){
			$hours[$hour] = "off";
		}

		return array(
			'period' => 'weekend-holiday',
			'prices' => $this->prices,
			'times' => $hours
		);
	}

	public function getSummerValues(){

		foreach(range(0, 23) as $hour){
			if($hour <= 6 || ($hour >= 19 && $hour <= 23)){
				$hours[$hour] = "off";
			}} elseif(($hour > 6 && $hour <= 10) || ($hour > 16 && $hour < 19)) {
				$hours[$hour] = "mid";
			} elseif($hour > 10 && $hour <= 16 ) {
				$hours[$hour] = "on";
			}
		}

		return array(
			'period' => 'summer',
			'prices' => $this->prices,
			'times' => $hours
		);
	}

	public function getWinterValues(){

		foreach(range(0, 23) as $hour){
			if($hour <= 6 || ($hour >= 19 && $hour <= 23)){
				$hours[$hour] = "off";
			} elseif(($hour > 6 && $hour <= 10) || ($hour > 16 && $hour < 19)) {
				$hours[$hour] = "on";
			} elseif($hour > 10 && $hour <= 16 ) {
				$hours[$hour] = "mid";
			}
		}

		return array(
			'period' => 'winter',
			'prices' => $this->prices,
			'times' => $hours
		);
	}

}
