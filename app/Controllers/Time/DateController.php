<?php namespace App\Controllers\Time;

use App\Kernel\ControllerAbstract;

class DateController extends ControllerAbstract
{

	private $date;
	private $year;
	private $holidays;
	private $winter;
	private $summer;

	public function __construct($date){

		$this->date = $date;
		$this->year = substr($date, 0, 4);

		$this->holidays = array(

			/* New Years */
			$this->year . '-01-01',

			/* Family Day */
			date("Y-m-d", strtotime($this->year . "-02-00, third monday")),

			/* Good Friday */
			date("Y-m-d", strtotime("-2 days", (easter_date($this->year)))),

			/* Victoria Day */
			date("Y-m-d", strtotime($this->year . '-05-20, last monday')),

			/* Canada Day */
			$this->year . '-07-03',

			/* Civic Holiday */
			date("Y-m-d", strtotime($this->year . '-08-00, first monday')),

			/* Labour Day */
			date("Y-m-d", strtotime($this->year . '-09-00, first monday')),

			/* Thanksgiving */
			date("Y-m-d", strtotime($this->year . '-10-00, second monday')),

			/* Christmas */
			$this->year . '-12-25',

			/* Boxing Day */
			$this->year . '-12-26'
			
		);

		/*
		 **
		 ** Summer time ( May 1st - October 31st )
		 **
		 */
		$this->summer = array(
			strtotime($this->year . "-05-01"),
			strtotime($this->year . "-10-31")
		);

		/*
		 **
		 ** Winter time ( November 1st - April 30th )
		 **
		 */
		$this->winter = array(
			array(
				strtotime($this->year . "-11-01"),
				strtotime($this->year . "-12-31")
			),
			array(
				strtotime($this->year . "-01-01"),
				strtotime($this->year . "-04-30")
			),
		);
	}

	/**
	 * isHoliday
	 *
	 * @return bool
	 */
	public function isHoliday()
	{
		if(in_array($this->date, $this->holidays)){
			return true;
		}

		return false;
	}

	/**
	 * getPeriod
	 *
	 * @return string
	 */
	public function getPeriod()
	{

		$datetime = strtotime($this->date);

		if($this->isHoliday()){
			return 'weekend-holiday';
		}
		elseif($datetime > $this->winter[0][0] && $this->winter[0][1] > $datetime){
			return 'winter';
		}
		elseif($datetime > $this->summer[0] && $this->summer[1] > $datetime ){
			return 'summer';
		}
		elseif($datetime > $this->winter[1][0] && $this->winter[1][1] > $datetime){
			return 'winter';
		}

		return false;
	}
}
