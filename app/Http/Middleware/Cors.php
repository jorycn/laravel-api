<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Closure;

class Cors
{
    protected $response;
    protected $option;

    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->option = [
            'supportsCredentials' => false,
            'allowedOrigins' => ['http://code.xian.qq.com'],
            'allowedHeaders' => ['*'],
            'allowedMethods' => ['GET', 'POST'],
            'exposedHeaders' => [],
            'maxAge' => 0,
            'hosts' => [],
        ];
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', $this->option['allowedOrigins']);
        $response->headers->set('Access-Control-Allow-Method', $this->option['allowedMethods']);
        return $response;
    }
}
