<?php
namespace App\iPolitic\NawpCore\Components;

/**
 * All nawp utils.
 *
 * All small function & snipets should go there
 *
 * @version 1.0
 * @author fauss
 */
class Utils
{
    /**
     * WIll var_dump a var and/or exit the script.
     * @param $var
     * @param bool $exitScript
     */
    public static function p($var, bool $exitScript = false): void {
        var_dump($var);
        if($exitScript) {
            exit;
        }
        return;
    }
    /**
     * Will return the
     * @param string $input
     * @param string $tag
     * @return mixed
     */
    public static function strInTag(string $input, string $tag): string {
        $matches = [];
        $pattern = "#<".$tag.".*?>([^<]+)</".$tag.">#";
        preg_match_all($pattern, $input, $matches);
        return $matches[0][0];
    }

    /**
     * Will hide the twig string by replacing { and } chars
     * The goal of this method is to be able to pass TWIG to client
     * Without having server interpreting it
     * (the inverse function should exist in the client side only)
     * @param string $string
     * @return string
     */
    public static function hideTwigIn(string $string) : string {
        return str_replace("}", "²==//", str_replace
            ("{", "==²//", $string)
        );
    }

    /**
     * Will execute the function, and return all rendered data as a string
     * @param mixed $func
     * @return string
     */
    public static function ocb($func): string {
        ob_start();
            call_user_func($func);
            $res = ob_get_contents();
        ob_end_clean();
        return $res;
    }

    /**
     * Will generate a new ID
     * @param int $length
     * @return string
     * @throws \Exception
     */
    public static function  generateUID(int $length = 20): string {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($length / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $length).microtime(true);
    }
}