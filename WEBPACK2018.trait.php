<?php
/** op-unit-webpack:/WEBPACK2018.trait.php
 *
 * @created    2024-01-23
 * @version    2.0
 * @package    op-unit-webpack
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/** Declare strict
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP\UNIT\WEBPACK;

/** use
 *
 */
use function OP\ConvertPath;

/** WebPack
 *
 * @created    2024-01-23
 * @version    2.0
 * @package    op-unit-webpack
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */
trait OP_WEBPACK_2018
{
	/** Wrapper method
	 *
	 * @deprecated 2024-01-23
	 * @param      string     $extension
	 * @param      string     $files
	 */
	public static function Set(string $extension, string $files)
	{
		//	Add extension.
		foreach( $files as & $file ){
			$file .= ".{$extension}";
		}

		//	Register files.
		self::_RegisterFiles($files);

		//	For Eclipse notice error.
		if( 0 ){
			D($file);
		}
	}

	/** Wrapper method
	 *
	 * @deprecated 2024-01-23
	 * @param      string     $file_path
	 */
	public static function Js(string $file_path)
	{
		//	Remove extension if added.
		$file_path  = rtrim($file_path, '.js');

		//	Add extension.
		$file_path .= '.js';

		//	Register.
		self::Auto($file_path);
	}

	/** Wrapper method.
	 *
	 * @deprecated 2024-01-23
	 * @param      string     $file_path
	 */
	public static function Css(string $file_path)
	{
		//	Remove extension if added.
		$file_path  = rtrim($file_path, '.css');

		//	Add extension.
		$file_path .= '.css';

		//	Register.
		self::Auto($file_path);
	}

	/** Generate unique hash key by stacked files.
	 *
	 * @created  2019-04-06
	 * @moved    2024-04-08  WebPack2018.class.php --> WEBPACK2018.trait.php
	 * @param    string      $extension
	 * @return   string      $hash
	 */
	public function FileContentHash($ext)
	{
		//	...
		static $_hash;

		//	...
		if( empty($_hash[$ext]) ){

			//	...
			$session = $this->Session($ext);

			//	Generate hash by content.
			$_hash[$ext] = substr(md5($this->Get($ext)), 0, 8);

			//	...
			$this->Session($ext, $session);
		};

		//	...
		return $_hash[$ext];

		/*
		//	...
		$session = $this->Session($ext);

		//	...
		$hash = substr(md5($this->Get($ext)), 0, 8);

		//	...
		$this->Session($ext, $session);

		//	...
		return $hash;
		*/
	}

	/** Get packed string each extension.
	 *
	 * @moved  2024-04-08  WebPack2018.class.php --> WEBPACK2018.trait.php
	 * @param  string $extension
	 * @return string $string
	 */
	public function Get($ext)
	{
		//	...
		if(!ob_start()){
			OP()->Notice("ob_start was failed.");
			return;
		}

		//	...
		$this->Out($ext);

		//	...
		return ob_get_clean();
	}
}
