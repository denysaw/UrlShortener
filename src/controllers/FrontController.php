<?php
/**
 * @author Denysaw
 */
declare(strict_types=1);

namespace App\Controllers;

/**
 * Class FrontController
 * @package App\Controllers
 */
class FrontController extends Controller
{

	public function indexAction()
	{
		$this->render('index');
	}


	public function taskAction()
	{
		$this->render('task');
	}


	/**
	 * @param string $slug
	 */
	public function findUrlAction(string $slug)
	{
		$result = $this->shortener->unwrap($slug);

		if ($result['url']) {
			header('Location: '. $result['url'], true, 301);
		} else {
			$this->notFoundAction();
		}
	}


	public function notFoundAction()
	{
		$this->render('errors/404');
	}
}