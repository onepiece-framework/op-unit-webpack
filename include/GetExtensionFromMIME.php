<?php
/** op-unit-webpack:/include/GetExtensionFromMIME.php
 *
 * @created    2024-07-07
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

//	...
switch( $mime = OP()->Env()->MIME() ){
	case 'text/css':
		$extension = 'css';
		break;
	case 'text/javascript':
		$extension = 'js';
		break;
	case 'text/markdown':
		$extension = 'md';
		break;
	default:
		OP()->Notice("This MIME is not support. ($mime)");
		return;
}

//	...
return $extension;
