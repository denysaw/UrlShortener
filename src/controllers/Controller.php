<?php
/**
 * @author Denysaw
 */
declare(strict_types=1);

namespace App\Controllers;

use App\Services\UrlShortener;

/**
 * Class Controller
 * @package App\Controllers
 */
class Controller
{

	/**
	 * @var UrlShortener;
	 */
	protected $shortener;


	/**
	 * @param UrlShortener $shortener
	 */
	public function __construct(UrlShortener $shortener)
	{
		$this->shortener = $shortener;
	}


	/**
	 * @param string $view
	 */
	protected function render(string $view)
	{
		include APP_PATH. '/views/'. $view. '.phtml';
	}


	/**
	 * @param string $str
	 */
	protected function textResponse(string $str)
	{
		echo $str;
	}


	/**
	 * @param array $data
	 */
	protected function jsonResponse(array $data)
	{
		echo json_encode($data);
	}
}