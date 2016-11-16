<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * RD Cache Breaker
 *
 * @package		ExpressionEngine
 * @category	Plugin
 * @author		Jarrod D Nix, Reusser Design
 * @license		https://opensource.org/licenses/MIT The MIT License (MIT)
 */

class Rd_string
{

	public $return_data = "";

	// --------------------------------------------------------------------

	/**
	 * RD String
	 *
	 * This function applies the string manipulations according to the given parameters
	 *
	 * @access  public
	 * @return  string
	 */
	public function __construct()
	{
		// Get PHP functions to run
		$functions = ee()->TMPL->fetch_param('functions');
		$functions = explode("|", $functions);

		// Get parameters for those functions
		$params = ee()->TMPL->fetch_param('params');
		$params = explode("|", $params);
		foreach($params as $key => $param)
		{
			if(stripos($params[$key], ",") !== false)
			{
				$params[$key] = explode(",", $param);
			}
		}

		// Initial tag data
		$return = trim(ee()->TMPL->tagdata);

		foreach($functions as $key => $function)
		{
			switch($function)
			{
				case "strip_tags":
					if(strlen($params[$key]) > 0)
					{
						$return = strip_tags($return, $params[$key]);
					}else
					{
						$return = strip_tags($return);
					}
					break;

				case "strtolower":
					$return = strtolower($return);
					break;

				case "strtoupper":
					$return = strtoupper($return);
					break;

				case "substr":
					if(count($params[$key]) < 1)
					{
						// substr() needs at least 1 argument
						$this->return_data = trim($return);
						return;
					}else
					{
						if(isset($params[$key][1]))
						{
							$return = substr($return, $params[$key][0], $params[$key][1]);
						}else
						{
							$return = substr($return, $params[$key][0]);
						}
					}
					break;

				case "substr_replace":
					if(count($params[$key]) < 3)
					{
						// substr_replace() needs at least 3 arguments
						$this->return_data = trim($return);
						return;
					}else
					{
						if(isset($params[$key][3]))
						{
							$return = substr($return, $params[$key][0], $params[$key][1], $params[$key][2], $params[$key][3]);
						}else
						{
							$return = substr($return, $params[$key][0], $params[$key][1], $params[$key][2]);
						}
					}
					break;

				case "urlencode":
					$return = url_encode($return);
					break;

				default:
					continue;
			}
		}

		$this->return_data = trim($return);

	}

}


/* End of file pi.rd_string.php */
/* Location: ./system/user/addons/rd_string/pi.rd_string.php */
