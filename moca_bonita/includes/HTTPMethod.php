<?php
namespace MocaBonita\includes;
/**
* Deal with a subset of HTTP methods.
*
* @author Rômulo Batista
* @category WordPress
* @package moca_bonita\util
* @copyright Copyright (c) 2015-2016 Núcleo de Tecnologia da Informação - NTI, Universidade Estadual do Maranhão - UEMA
*/

class HTTPMethod {
	/**
    * Constant that defines a HTTP 304 code
    *
    * @var string
    */

	const NOT_IMPLEMENTED = 'not_implemented';
	/**
    * Constant that defines a HTTP 400 code
    *
    * @var string
    */

	const REQUEST_UNAVAIABLE = 'bad_request';
	/**
    * Constant that defines a HTTP 403 code
    *
    * @var string
    */

	const FORBIDDEN = 'forbidden';
	/**
    * Constant that defines a HTTP 409 code
    *
    * @var string
    */

	const CONFLICT = 'conflict';
	/**
    * Constant that defines a HTTP 500 code
    *
    * @var string
    */

	const INTERNAL_ERROR = 'internal_error';
	/**
    * Constant that defines a HTTP 204 code
    *
    * @var string
    */

	const NO_CONTENT = 'no_content';
	/**
    * Constant that defines a HTTP 304 code
    *
    * @var string
    */

	const NOT_MODIFIED = 'not_modified';
	/**
    * Constant that defines a HTTP 401 code
    *
    * @var string
    */

	const UNAUTHORIZED = 'unauthorized';
	/**
    * Constant that defines a HTTP 404 code
    *
    * @var string
    */

	const NOT_FOUND = 'not_found';

	/**
    * Get the respective HTTP message
    *
    * @param string $method The HTTP
    * @param string $message The HTTP message
    */
	public static function getError($method, $message = null){
		if($method === HTTPMethod::REQUEST_UNAVAIABLE){
			return array('http_method' => array('error_message' => is_null($message) ? '400 - BAD REQUEST' : $message,
											'code' => 400));

		} elseif($method === HTTPMethod::NOT_IMPLEMENTED){
			return array('http_method' => array('error_message' =>is_null($message) ? '501 - NOT IMPLEMENTED' : $message,
											'code' => 501));
		} elseif($method === HTTPMethod::FORBIDDEN){
			return array('http_method' => array('error_message' => is_null($message) ? '403 - FORBIDDEN' : $message,
											'code' => 403));
		} elseif($method === HTTPMethod::CONFLICT){
			return array('http_method' => array('error_message' => is_null($message) ? '409 - CONFLICT' : $message,
											'code' => 409));
		} elseif($method === HTTPMethod::NO_CONTENT){
			return array('http_method' => array('error_message' => is_null($message) ? '204 - NO CONTENT' : $message,
											'code' => 204));
		} elseif($method === HTTPMethod::INTERNAL_ERROR){
			return array('http_method' => array('error_message' => is_null($message) ? '500 - INTERNAL SERVER ERROR' : $message,
											'code' => 500));
		} elseif($method === HTTPMethod::NOT_IMPLEMENTED){
			return array('http_method' => array('error_message' => is_null($message) ? '304 - NOT MODIFIED' : $message,
											'code' => 304));
		} elseif($method === HTTPMethod::UNAUTHORIZED){
			return array('http_method' => array('error_message' => is_null($message) ? '401 - UNAUTHORIZED' : $message,
											'code' => 401));
		} elseif($method === HTTPMethod::NOT_FOUND){
			return array('http_method' => array('error_message' => is_null($message) ? '404 - NOT FOUND' : $message,
											'code' => 404));
		} else {
			return array('http_method' => array('error_message' => is_null($message) ? '400 - BAD REQUEST' : $message,
											'code' => 400));
		}
	}
}
