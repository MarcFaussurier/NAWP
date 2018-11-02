<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: fauss
 * Date: 10/30/2018
 * Time: 12:12 PM
 */

namespace App\Server;

use App\Ipolitic\Nawpcore\Kernel;
use Bulldog\HttpFactory\FactoryBuilder;
use DebugBar\StandardDebugBar;
use PhpMiddleware\PhpDebugBar\PhpDebugBarMiddleware;

class PsrMiddlewares
{
    public static function process(): array
    {
        /* $psr17ResponseFactory = (FactoryBuilder::get("jasny"))->responseFactory();
         $psr17StreamFactory = (FactoryBuilder::get("jasny"))->streamFactory();

         $debugbar = new StandardDebugBar();
         $debugbarRenderer = $debugbar->getJavascriptRenderer();
         $middleware = new PhpDebugBarMiddleware($debugbarRenderer, $psr17ResponseFactory, $psr17StreamFactory);
*/
        //   echo "REQUEST FLOW CALLED" . PHP_EOL;
        /**
         * These middlewares will be executed at each request
         */
        return [/*
            //Handle errors
            (new \Middlewares\ErrorHandler()),
            //Log the request
            new \Middlewares\AccessLog($kernel->logger),
            //Calculate the response time
            new \Middlewares\ResponseTime(),
            //Removes the trailing slash
            new \Middlewares\TrailingSlash(false),
            //Insert the UUID
            new \Middlewares\Uuid(),
            //Disable the search engine robots
            new \Middlewares\Robots(false),
            //Compress the response to gzip
            new \Middlewares\GzipEncoder(),
            //Minify the html
            new \Middlewares\HtmlMinifier(),
            //Override the method using X-Http-Method-Override header
            new \Middlewares\MethodOverride(),
            //Parse the json payload
            new \Middlewares\JsonPayload(),
            //Parse the urlencoded payload
            new \Middlewares\UrlEncodePayload(),
            //Save the client ip in the '_ip' attribute
            (new \Middlewares\ClientIp())
                ->attribute('_ip'),
            //Allow only some ips
            (new \Middlewares\Firewall(['127.0.0.*']))
                ->ipAttribute('_ip'),
            //Add cache expiration headers
            new \Middlewares\Expires(),
            //Negotiate the content-type
            new \Middlewares\ContentType(),
            //Negotiate the language
            new \Middlewares\ContentLanguage(['gl', 'es', 'en']),*/
            //Add the php debugbar
//            $middleware,
        ];
    }
}
