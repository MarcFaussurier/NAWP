<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: fauss
 * Date: 8/20/2018
 * Time: 1:37 PM
 */
namespace App\Views\Elements\Admin;

use App\DataSources\User\User;
use App\Ipolitic\Nawpcore\Components\View;
use App\Ipolitic\Nawpcore\Components\ViewLogger;
use App\Ipolitic\Nawpcore\Interfaces\TwigInterface;
use App\Ipolitic\Nawpcore\Kernel;

class Login extends View implements TwigInterface
{
    public $states = [
        "email" => "",
        "rand" => 0,
        "message" => "",
        "cookie_on" => "false"
    ];

    public function twig(): void
    {
        ?>
    <section data-id="{{id}}" id="loginwrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Access member area</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" id="loginform" method="POST" action="">
                                <fieldset>
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                <input class="loginRadio" type="radio" name="accessTypeRadio" id="optionsRadios1" value="login" checked="">
                                                I already have an account
                                                {{ message }}
                                            </label>
                                        </div>
                                    </div>
                                    <div id="commonLoginSection">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-italic"></i></span>
                                            <input type="text" class="form-control" name="firstName" placeholder="First name">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-font"></i> </span>
                                            <input type="text" class="form-control" name="lastName" placeholder="Last name">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="glyphicon  glyphicon-map-marker"></span> </span>
                                            <input type="text" class="form-control" name="birthPlace" placeholder="Birth place">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i> </span>
                                            <input class="form-control" placeholder="Pin" name="pin" type="password" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                <input class="registerRadio" type="radio" name="accessTypeRadio" id="optionsRadios1" value="register">
                                                I want to create one
                                            </label>
                                        </div>
                                    </div>
                                    <div id="registrationSection">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><span class="fa fa-birthday-cake"></span> </span>
                                            <input type="date" class="form-control" name="birthPlace" placeholder="Birth date">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i> </span>
                                            <input class="form-control" placeholder="Pin confirmation" name="pin2" type="password" value="">
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input name="remember" type="radio" value="cookie">Remember me using a cookie
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input name="remember" type="radio" value="url">Remember me using url param
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input name="remember" type="radio" value="off">Logout on page exit
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">  <i class="fa fa-arrow-right"></i></span>
                                        <input type="submit" value="Submit" class="btn btn-lg btn-success btn-block" />
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <?php
    }
}
