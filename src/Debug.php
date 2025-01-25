<?php

namespace RobinTheHood\Debug;

use RobinTheHood\Terminal\Terminal;

class Debug
{
    public const LEVEL_DEBUG = 0;
    public const LEVEL_NOTICE = 1;
    public const LEVEL_WARNING = 2;
    public const LEVEL_ERROR = 3;

    public static function out($string, $level = Debug::LEVEL_DEBUG)
    {
        if (self::isCommandLineInterface()) {
            self::outTerminal($string, $level);
        } else {
            self::outHtml($string, $level);
        }
    }

    private static function outTerminal($string, $level)
    {
        if ($level == Debug::LEVEL_DEBUG) {
            $color = Terminal::WHITE;
        } elseif ($level == Debug::LEVEL_NOTICE) {
            $color = Terminal::YELLOW;
        } elseif ($level == Debug::LEVEL_WARNING) {
            $color = Terminal::ORANGE;
        } elseif ($level == Debug::LEVEL_ERROR) {
            $color = Terminal::RED;
        }
        Terminal::outln($string, $color);
    }

    private static function outHtml($mix, $level)
    {
        echo '<pre>';
        print_r($mix);
        echo '</pre>';
    }

    public static function debug($string)
    {
        self::out($string, Debug::LEVEL_DEBUG);
    }

    public static function notice($string)
    {
        self::out($string, Debug::LEVEL_NOTICE);
    }

    public static function warning($string)
    {
        self::out($string, Debug::LEVEL_WARNING);
    }

    public static function error($string)
    {
        self::out($string, Debug::LEVEL_ERROR);
    }


    private static function isCommandLineInterface()
    {
        return (php_sapi_name() === 'cli');
    }
}
