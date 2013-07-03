<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jsiciarek
 * Date: 03.07.13
 * Time: 14:17
 * To change this template use File | Settings | File Templates.
 */

namespace Siciarek\SymfonyUtilsBundle\Utils;

class Debug {
    public static function dump($var, $echo = true) {
        $output = sprintf('<pre>%s</pre>', \Doctrine\Common\Util\Debug::dump($var));
        if($echo === true) {
            echo $output;
        }
        return $output;
    }
}