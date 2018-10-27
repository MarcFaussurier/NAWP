<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: fauss
 * Date: 8/6/2018
 * Time: 1:09 PM
 */
namespace App\Controllers;

use App\DataSources\User\User;
use App\iPolitic\NawpCore\components\Cookie;
use App\iPolitic\NawpCore\Components\PacketAdapter;
use App\iPolitic\NawpCore\Components\Utils;
use App\iPolitic\NawpCore\Components\ViewLogger;
use App\iPolitic\NawpCore\Components\Controller;
use App\iPolitic\NawpCore\Interfaces\ControllerInterface;
use App\iPolitic\NawpCore\Components\Session;
use App\iPolitic\NawpCore\Kernel;

/**
 * Class Admin
 * @package App\Controllers
 */
class Admin extends Controller implements ControllerInterface
{
    /**
     * Describes controller methods
     * @return array
     */
    public function getMethods(): array
    {
        return
        [
            [
                "method"    => "adminMiddleware",
                "router"    => ["*", "*"],
                "priority"  => 98,
            ],
            [
                "method"    => "login",
                "router"    => ["*", "/admin/login"],
                "priority"  => 0,
            ],
            [
                "method"    => "adminHome",
                "router"    => ["*", "/admin"],
                "priority"  => 0,
            ]
        ];
    }

    /**
     * Bind the login page of the admin backend
     * @param ViewLogger $viewLogger
     * @param string $httpResponse
     * @param array $args
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \iPolitic\Solex\RouterException
     * @throws \Exception
     */
    public function login(ViewLogger &$viewLogger, string &$httpResponse, array $args = []): bool
    {
        $loginMessage = "default";
        $atlas = $viewLogger->kernel->atlas;
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $userRecord = $atlas
                ->select(User::class)
                ->where('email = ', $_POST["email"])
                ->fetchRecord();

            if (($userRecord === null) || ($userRecord->hashed_password !== Utils::hashPassword($_POST["password"]))) {
                $this->logger->alert("LOGIN REFUSED");
                // wrong email and/or password
                $loginMessage = "Mot de passe ou utilisateur incorect (" . sha1($_POST["password"] . $_ENV["PASSWORD_SALT"]).")";
            } else {
                $this->logger->alert("LOGIN SUCCESS");
                $uid = Utils::generateUID(9);
                $url = "/admin";
                if (Cookie::areCookieEnabled($viewLogger)) {
                    Cookie::set($viewLogger, new Cookie("UID", $uid));
                } else {
                    $url = Utils::buildUrlParams($url, ["UID" => $uid]);
                }
                $_GET["UID"] = $uid;
                $viewLogger->getSession()->set("user_id", 5);
                //$loginMessage = $loginMessage . $url . " UID : " . Session::id($viewLogger);
                PacketAdapter::redirectTo($httpResponse, $viewLogger, $url, $args, $viewLogger->requestType);
                return true;
            }
        }
        $loginMessage = $viewLogger->getSession()->id();
        $httpResponse .= " <!DOCTYPE html>
        <html lang=\"en\">" .
            new \App\Views\Elements\Admin\Header($viewLogger, $this->logger, [
                    "page" => "Login",
                    "title" => "TEST".rand(0, 99),
                    "url" => $_SERVER["REQUEST_URI"],
                    "cookies" => base64_encode(json_encode($viewLogger->cookies)),
                ]) .
            "<body>" .
            new \App\Views\Pages\Admin\Page(

                    $viewLogger,
                    $this->logger,
                    [
                        "pass" => isset($_POST["password"]) ? $_POST["password"] : "emptypass!",
                        "html_elements" => [
                            (
                                new \App\Views\Elements\Admin\Login($viewLogger, $this->logger, [
                                "email" => isset($_POST["email"]) ? $_POST["email"] : null,
                                "message" => $loginMessage,
                                "rand" => rand(0, 9),
                                "cookie_on" => $viewLogger->areCookieEnabled ? "true" : "false",
                                "cookiestr" => print_r($viewLogger->cookies, true)
                            ])),
                        ],
                    ]
                ) .
                new \App\Views\Elements\Admin\Footer($viewLogger, $this->logger, []) . "
            </body>
        </html>";
        return true;
    }

    /**
     * @param ViewLogger $viewLogger
     * @param string $httpResponse
     * @param array $args
     * @return bool
     * @throws \Exception
     */
    public function adminHome(ViewLogger &$viewLogger, string &$httpResponse, array $args = []): bool
    {
        $loginMessage = "SUCCESS";
        $httpResponse .= "<!DOCTYPE html><html lang=\"en\">" .
            new \App\Views\Elements\Admin\Header(
                $viewLogger,
                $this->logger,
                ["page" => "Login", "title" => "TEST".rand(0, 99), "url" => $_SERVER["REQUEST_URI"]]
            ) .
            "<body>" .
            new \App\Views\Pages\Admin\Page(

                $viewLogger,
                $this->logger,
                [
                    "pass" => isset($_POST["password"]) ? $_POST["password"] : "emptypass!",
                    "html_elements" => [
                        (
                        new \App\Views\Elements\Admin\Login(
                            $viewLogger,
                            $this->logger,
                            [
                            "email" => isset($_POST["email"]) ? $_POST["email"] : null,
                            "message" => $loginMessage . " SESSION : " . print_r(Session::getAll($viewLogger), true),
                            "rand" => rand(0, 9)
                        ]
                        )),
                    ],
                ]
            ) .
            new \App\Views\Elements\Admin\Footer($viewLogger, $this->logger, [])
            .
            "</body></html>";
        return true;
    }

    /**
     * The admin middleware function, manage common features of all /admin* matches
     * @param ViewLogger $viewLogger
     * @param string $httpResponse
     * @param array $args
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \iPolitic\Solex\RouterException
     * @throws \Exception
     */
    public function adminMiddleware(ViewLogger &$viewLogger, string &$httpResponse, array $args = []): bool
    {
        if (stristr($_SERVER["REQUEST_URI"], "/admin")) {
            // if user requested a page that is not blacklisted (ex: login, register pages), and if user is not authenticated
            if (!$viewLogger->getSession()->isset("user_id") && !stristr($_SERVER["REQUEST_URI"], "/login")) {
                // We redirect him to the login page
                PacketAdapter::redirectTo($httpResponse, $viewLogger, "/admin/login", $args, $viewLogger->requestType);
                // We release the request
                return true;
            }
        }
        // We continue request flow
        return false;
    }
}
