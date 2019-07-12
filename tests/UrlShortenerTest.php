<?php
/**
 * @author Denysaw
 */
declare(strict_types=1);

use App\Services\Redis;
use App\Services\UrlShortener;
use PHPUnit\Framework\TestCase;

final class UrlShortenerTest extends TestCase
{

	/**
	 * @var UrlShortener
	 */
	private $shortener;


	public function setUp(): void
	{
		$redis = new Redis('localhost');
		$this->shortener = new UrlShortener($redis);
		parent::setUp();
	}


	public function testInvalidUrl()
	{
		$result = $this->shortener->wrap('invalid_url');
		$this->assertTrue(key_exists('error', $result));
		$this->assertFalse(key_exists('slug', $result));
	}


	public function testCorrectUrl()
	{
		$result = $this->shortener->wrap('https://google.com/');
		$this->assertFalse(key_exists('error', $result));
		$this->assertTrue(key_exists('slug', $result));
	}


	public function testUrlNotFound()
	{
		$result = $this->shortener->unwrap('some_unexisting_slug');
		$this->assertTrue(key_exists('error', $result));
		$this->assertFalse(key_exists('url', $result));
	}


	public function testUnwrapUrl()
	{
		$result = $this->shortener->wrap('https://google.com/');

		$result = $this->shortener->unwrap($result['slug']);
		$this->assertFalse(key_exists('error', $result));
		$this->assertTrue(key_exists('url', $result));
	}


	public function test100Submissions()
	{
		$start = microtime(true);
		$left = 100;

		while ($left--) {
			$result = $this->shortener->wrap('https://google.com/'. rand(0, 9999999));

			if (!key_exists('slug', $result)) {
				throwException(new Exception("Url shorting failed"));
			}
		}

		$time = round(microtime(true) - $start, 4);
		echo "\n100 submissions successfully completed in: ". $time. " sec.";

		$this->assertLessThanOrEqual(60, $time);
	}


	public function test1000UrlAccesses()
	{
		$left = 1000;
		$slugs = [];

		while ($left--) {
			$result = $this->shortener->wrap('https://google.com/'. rand(0, 9999999));

			if (!key_exists('slug', $result)) {
				throwException(new Exception("Url shorting failed"));
			}

			$slugs[] = $result['slug'];
		}

		$start = microtime(true);

		while ($slugs) {
			$slug   = array_shift($slugs);
			$result = $this->shortener->unwrap($slug);

			if (!key_exists('url', $result)) {
				throwException(new Exception("Url unwrapping failed"));
			}
		}

		$time = round(microtime(true) - $start, 4);
		echo "\n1000 url accessed successfully in: ". $time. " sec.";

		$this->assertLessThanOrEqual(60, $time);
	}

	// TODO: uncomment after scaling the app

//    public function test10000Submissions()
//    {
//	    $start = microtime(true);
//		$left = 10000;
//
//	    while ($left--) {
//		    $result = $this->shortener->wrap('https://google.com/'. rand(0, 99999999999));
//
//		    if (!key_exists('slug', $result)) {
//		    	throwException(new Exception("Url shorting failed"));
//		    }
//	    }
//
//        $time = round(microtime(true) - $start, 4);
//	    echo "\n10000 submissions successfully completed in: ". $time. " sec.";
//
//        $this->assertLessThanOrEqual(1, $time);
//    }


//	public function test10000000UrlAccesses()
//	{
//		$left = 10000000;
//		$slugs = [];
//
//		while ($left--) {
//			$result = $this->shortener->wrap('https://google.com/'. rand(0, 99999999999));
//
//			if (!key_exists('slug', $result)) {
//				throwException(new Exception("Url shorting failed"));
//			}
//
//			$slugs[] = $result['slug'];
//		}
//
//		$start = microtime(true);
//
//		while ($slugs) {
//			$slug   = array_shift($slugs);
//			$result = $this->shortener->unwrap($slug);
//
//			if (!key_exists('url', $result)) {
//				throwException(new Exception("Url unwrapping failed"));
//			}
//		}
//
//		$time = round(microtime(true) - $start, 4);
//		echo "\n10000000 url accessed successfully in: ". $time. " sec.";
//
//		$this->assertLessThanOrEqual(1, $time);
//	}
}