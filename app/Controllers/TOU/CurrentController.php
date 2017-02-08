<?php namespace App\Controllers\TOU;

use App\Kernel\ControllerAbstract;
use App\Controllers\Time\DateController;
use App\Controllers\Time\TimeController;

class CurrentController extends ControllerAbstract
{

	/**
	 * Get Current TOU
	 *
	 * @param string $name
	 * @return string
	 */
	public function get(){

		$date = new DateController(date("Y-m-d"));
		$tou = new TimeController();
		$retval;

		switch($date->getPeriod()){
			case "weekend-holiday":
				$retval = $tou->getHolidayValues();
				break;
			case "winter":
				$retval = $tou->getWinterValues();
				break;
			case "summer":
				$retval = $tou->getSummerValues();
				break;
			default:
				// It's currently winter so use these values
				$retval = $tou->getWinterValues();
		}

		$response = $this->getResponse();
		$response->withHeader('Content-Type', 'application/json');
		$response->write(json_encode($retval));

		return $response;

	}

}
