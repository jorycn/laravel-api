<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Closure;

class Api
{
    protected $response;
    protected $option;

    public function __construct(Response $response)
    {
        $this->response = $response;
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
        if($request->isMethod('post')){
            $origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : $_SERVER['HTTP_HOST'];
            if($this->getSuffix($origin) !== 'qq.com'){
                $html = <<<EOF
<script type="text/javascript">alert("Domain Denied!");</script>
EOF;
                echo $html;
                return false;
            }
        }
        return $next($request);
    }

    protected function getSuffix($val)
    {
        if ($this->isIP($val)) return null;
        $host = $this->Host($val);
        //排除localhost
        if (strpos($host, '.') === false) return null;
        $parts = array_slice(explode('.', $host), -2); // "a.b.c.domain.tld" => [a, b, c, domain, tld] => [domain, tld];
        return implode('.', $parts);
    }

    protected function isIP($value)
    {
        $value = preg_replace('/^(http|https|file|ftp):\/\//', '', $value);
        return (bool) filter_var($value, FILTER_VALIDATE_IP);
    }

    protected function Host($value)
    {
        if (!preg_match('/^(http|file|ftp)/', $value)) $value = "http://$value";
        return parse_url($value, PHP_URL_HOST);
    }
}
