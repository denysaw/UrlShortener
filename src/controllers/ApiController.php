<?php
/**
 * @author Denysaw
 */
declare(strict_types=1);

namespace App\Controllers;

/**
 * Class ApiController
 * @package App\Controllers
 */
class ApiController extends Controller
{

	/**
	 * @param string $url
	 */
	public function shortenUrlAction(string $url)
	{
		$result = $this->shortener->wrap($url);

		$this->jsonResponse($result);
	}
}