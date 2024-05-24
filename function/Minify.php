<?php
/** op-unit-webpack:/function/Minify.php
 *
 * @creation   2023-05-24
 * @version    1.0
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

/** Minify
 *
 * @creation   2023-05-24
 * @version    1.0
 * @package    op-unit-webpack
 * @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright  Tomoaki Nagahara All right reserved.
 */
function Minify($css) {
	//	Remove comment.
	$css = preg_replace('!/\*.*?\*/!s', '', $css);
	//	Remove space character.
	$css = preg_replace('/\s+/', ' ', $css);
	//	Remove human readable space character.
	$css = preg_replace('/\s*([{}|:;,])\s*/', '$1', $css);
	//	Remove space character of line's head and tail.
	$css = preg_replace('/^\s*|\s*$/', '', $css);
	//	...
	return $css;
}
