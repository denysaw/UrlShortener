<?php
/**
 * @author Denysaw
 */
declare(strict_types=1);

namespace App\Services;

use App\Libs\Math;

/**
 * Class UrlShortener
 * @package App\Services
 */
class UrlShortener
{

	/**
	 * @var Redis;
	 */
	protected $redis;


	/**
	 * UrlShortener constructor.
	 * @param Redis $redis
	 */
	public function __construct(Redis $redis)
	{
		$this->redis = $redis;
	}


	/**
	 * @param string $url
	 * @return array
	 */
	public function wrap(string $url): array
	{
		if (!filter_var($url, FILTER_VALIDATE_URL)) {
			return ['error' => 'Invalid URL passed'];
		}

		/** Checking if same url already exists */
		$key = $this->redis->get('_'. $url);

		if (!$key) {
			$key = $this->redis->incr('key');

			$this->redis->set((string) $key, $url);
			$this->redis->set('_'. $url, (string) $key);
		}

		return ['slug' => Math::to_base($key)];
	}


	/**
	 * @param string $slug
	 * @return array
	 */
	public function unwrap(string $slug): array
	{
		$key  = Math::to_base_10($slug);
		$slug = $this->redis->get((string) $key);

		return $slug ? ['url' => $slug] : ['error' => 'Url not found'];
	}
}