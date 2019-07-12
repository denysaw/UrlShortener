<?php
/**
 * @author Denysaw
 */
declare(strict_types=1);

namespace App\Services;

/**
 * Class Redis
 * @package App\Services
 */
class Redis extends \Redis
{

	/**
	 * @param string $host
	 */
	public function __construct($host = 'redis')
	{
		parent::__construct();
		$this->connect($host);
	}
}