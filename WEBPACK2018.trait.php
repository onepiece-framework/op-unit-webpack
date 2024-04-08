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

	/** Output packed string each extension.
	 *
	 * @moved 2024-04-08  WebPack2018.class.php --> WEBPACK2018.trait.php
	 * @param string $extension
	 */
	public function Out($ext)
	{
		//	...
		static $_is_admin;

		//	...
		if( $_is_admin === NULL ){
			$_is_admin = OP()->Env()->isAdmin();
		}

		//	Get target directory.
		$list = [];
		$path = self::Directory();
		$path = "{$path}/{$ext}/action.php";
		if( file_exists($path) ){
			$list = include($path);
		};

		//	...
		foreach( array_merge($list, ($this->Session($ext) ?? [])) as $file_path ){
			//	...
			$full_path = $file_path.'.'.$ext;

			//	...
			if(!file_exists($full_path) ){
				OP()->Notice("This file does not exists. ({$full_path})");
				continue;
			}

			//	...
			if( $_is_admin ){
				echo "/* $file_path, $ext */\n";
			}

			//	...
			$file_path .= ".{$ext}";
			$meta_path  = CompressPath($file_path);

			//	...
			if(!$meta_path ){
				OP()->Notice("This file is not git root path. ($file_path)");
				continue;
			};

			//	...
			Template($meta_path);

			//	...
			echo "\n";
		}

		//	Set empty array.
		$this->Session($ext, []);
	}

	/** WebPack directory.
	 *
	 *  For separate each WebPack directory.
	 *
	 * <pre>
	 * //  Instantiate
	 * $webpack1 = Unit::Instantiate('WebPack');
	 * $webpack2 = Unit::Instantiate('WebPack');
	 *
	 * //  Set different directory.
	 * $webpack1->Directory('app:/webpack1/');
	 * $webpack2->Directory('app:/webpack2/');
	 *
	 * //  Output different webpack.
	 * $webpack1->Out();
	 * $webpack2->Out();
	 * </pre>
	 *
	 * @created   2020-02-07
	 * @moved     2024-04-08  WebPack2018.class.php --> WEBPACK2018.trait.php
	 * @param     string
	 * @return    string
	 */
	public static function Directory($path=null)
	{
		//	...
		static $_directory;

		//	...
		if( $path ){
			$_directory = ConvertPath(path);
		}

		//	...
		if(!$_directory ){
			//	...
			$config = OP()->Config('webpack');

			//	...
			if( $_directory = $config['directory'] ?? null ){
				$_directory = ConvertPath($_directory);
			}
		}

		//	...
		if(!$_directory ){
			OP()->Notice("WebPack directory is not set.\n Env::Set('webpack',['directory'=>\$path])");
		}

		//	...
		return $_directory;
	}
}
