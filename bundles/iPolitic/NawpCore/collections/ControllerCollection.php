<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: fauss
 * Date: 8/5/2018
 * Time: 7:46 PM
 */
namespace App\iPolitic\NawpCore\Collections;

use App\iPolitic\NawpCore\components\Cookie;
use App\iPolitic\NawpCore\components\RequestHandler;
use App\iPolitic\NawpCore\Kernel;
use iPolitic\Solex\Router;
use App\iPolitic\NawpCore\Components\Collection;
use App\iPolitic\NawpCore\Components\Controller;
use App\iPolitic\NawpCore\Components\PacketAdapter;
use App\iPolitic\NawpCore\Components\Utils;
use App\iPolitic\NawpCore\Components\ViewLogger;
use App\iPolitic\NawpCore\Interfaces\ControllerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

/**
 * Class ControllerCollection
 * Provide storage and match for a controller list
 * @package App\iPolitic\NawpCore
 */
class ControllerCollection extends Collection implements LoggerAwareInterface
{
    /**
     * @var LoggerInterface
     */
    public $logger;
    /**
    * ControllerCollection constructor.
    * @param array $input
    * @param int $flags
    * @param string $iterator_class
    */
    public function __construct(array $input = [], int $flags = 0, string $iterator_class = "ArrayIterator")
    {
        parent::__construct($input, $flags, $iterator_class);
    }

    /**
     * Will run all controllers and reassign $response while the
     * Controller collection ->  handle() didn't returned TRU
     * @param Kernel $kernel
     * @param string $response
     * @param ServerRequestInterface $request
     * @param string $requestType
     * @param mixed $packet
     * @param array $array
     * @param $viewLogger|null ViewLogger
     * @throws \iPolitic\Solex\RouterException
     * @throws \Exception
     */
    public function handle(Kernel &$kernel, &$response, ServerRequestInterface &$request, $requestType, $packet = null, $array = [], $viewLogger = null): void
    {
        $response = "";
        $viewLogger = $viewLogger !== null ? $viewLogger : new ViewLogger($kernel, $array, $packet, $requestType);
        // redirecting to the same page with needed UID param if none where passed to $_SERVER REQUEST URI
        if (!Cookie::areCookieEnabled($viewLogger)) {
            if (isset($request->getServerParams()["HTTP_REFERER"])) {
                $parsedHttpReferer = Utils::parseUrlParams($request->getServerParams()["HTTP_REFERER"]);
                $parsedHttpUri = $params = Utils::parseUrlParams($request->getServerParams()["HTTP_REFERER"]);
                if (isset($parsedHttpReferer["UID"]) && !isset($parsedHttpUri["UID"])) {
                    $params["UID"] = $parsedHttpReferer["UID"];
                    if (!stristr($request->getServerParams()["REQUEST_URI"], "logout")) {
                        PacketAdapter::redirectTo(
                            $response,
                            $viewLogger,
                            Utils::buildUrlParams($request->getServerParams()["REQUEST_URI"], $params),
                            $array
                        );
                        return;
                    }
                }
            }
        }
        // removing not allowed cookies
        if ($requestType !== "SOCKET") {
            // removing for disallowed cookie
            foreach (Cookie::getHttpCookies() as $k => $v) {
                if (!Cookie::isAllowedCookie($k)) {
                    Cookie::remove($viewLogger, $k);
                } else {
                    Cookie::set($viewLogger, new Cookie($k, $v), true);
                }
            }
        }
        $controllerMethodsCalled = [];

        // for each controller methods ordered by priority
        foreach ($this->getOrderedByPriority($request) as $controllerMethod) {
            //var_dump($controllerMehod);
            // we force a match if wildcard used
            if ($controllerMethod["router"][1] === "*") {
                $routerResponse = [""];
            } else {
                // create a new router for that method
                $dynamicRouter = new Router();
                // add the route then match
                $dynamicRouter->add($controllerMethod["controller"]."::".$controllerMethod["method"], [
                    "method" => $controllerMethod["router"][0],
                    "route" => $controllerMethod["router"][1]
                ]);
                $routerResponse = $dynamicRouter->match(
                    $requestType,
                    $request->getServerParams()["REQUEST_URI"]
                );
            }
            // execute controller method if router matched or wildecas used
            if (!empty($routerResponse)) {
                /**
                 * @var $controller Controller
                 */
                $controllerMethod["controller"] = "\\" . $controllerMethod["controller"];
                $controller = new $controllerMethod["controller"]($kernel->atlas, $kernel->logger);
                array_push(
                    $controllerMethodsCalled,
                    ($arr = explode("\\", $controller->name))[count($arr) - 1]
                    . "::". $controllerMethod["method"]
                );
                if ($controller->call($viewLogger, $response, $controllerMethod["method"], $routerResponse)) {
                    // nothing special to do right now
                    break;
                }
            }
        }
        if ($packet !== null) {
            $serverGenerated = $viewLogger->renderedTemplates;
            $response = json_encode($serverGenerated);
        }
        $this->logger->info("[".$requestType."] - '".$request->getServerParams()["REQUEST_URI"]."' =-=|> '".join(" -> ", $controllerMethodsCalled)."'");
        return;
    }

    /**
     * Will the current controller array orded by their priority
     * @param ServerRequestInterface $request
     * @return array
     */
    public function getOrderedByPriority(ServerRequestInterface &$request): array
    {
        $queue = [];
        /**
         * Copy all controllers methods to queue and add controller name as methods params
         * @var $v ControllerInterface
         */
        foreach ($this->getArrayCopy() as $v) {
            if ($v instanceof Controller && is_array($methods = $v->getMethods())) {
                foreach ($methods as $k => $u) {
                    //  echo "method : " . $u["method"] . PHP_EOL;
                    $rqType = $methods[$k]["router"][0];
                    if (
                        (($request->getServerParams()["REQUEST_URI"] === "*") || ($rqType === "*")) ||
                        ($request->getServerParams()["REQUEST_URI"] === $rqType)
                    ) {
                        $methods[$k]["controller"] = $v->name;
                        array_push($queue, $methods[$k]);
                    }
                }
            }
        }
        // order by priority value
        usort($queue, function ($a, $b) {
            return ($a["priority"] === $b["priority"]) ? 0 : ($a["priority"] > $b["priority"]) ? -1 : 1;
        });
        return $queue;
    }

    /**
     * Will set the logger interface following PSR recommendations
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
