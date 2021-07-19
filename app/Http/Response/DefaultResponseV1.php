<?php

/**
 * DefaultResponseV1.php
 * 
 * @since 23 Aug, 2020
 * @copyright Grorapid @ 2020
 * @author Manish Sahani <rec.manish.sahani@gmail.com>
 */

namespace App\Http\Response;

use App\Http\Http;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class DefaultResponseV1
{
    /**
     * The Response Factory our app uses
     * 
     * @var ResponseFactory
     */
    protected $factory;

    /**
     * JsonMiddleware constructor.
     * 
     * @param ResponseFactory $factory
     */
    public function __construct(ResponseFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Generate a json response
     * 
     * @param mixed $data
     * @param int $code
     * @param string $status
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function json($data, $code = Http::RESPONSE_STATUS_CODE_OK, $status = Http::RESPONSE_STATUS_OK, $headers = [])
    {
        return $this->factory->json(
            self::generate($status, $data, $code),
            $code,
            $headers
        );
    }

    /**
     * Generate a Json response body structure  
     * 
     * @param boolean $status
     * @param mixed $content
     * @param int $statusCode
     * @param string $details
     * @return array
     */
    public static function generate($status, $content, $statusCode, $details = "")
    {
        return [
            'version'       => 'v1',
            'status'        => $status,
            'statusCode'    => $statusCode,
            'details'       => $details == "" ? Response::$statusTexts[$statusCode] : $details,
            'statusMessage' => ($status == Http::RESPONSE_STATUS_OK)
                                ? Http::RESPONSE_STATUS_OK_MESSAGE
                                : Http::RESPONSE_STATUS_ERROR_MESSAGE,
            'response'      => $content,
        ];
    }
}
