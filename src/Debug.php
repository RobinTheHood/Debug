<?php
namespace Debug;

use Terminal\Terminal;

class Debug
{
    const LEVEL_DEBUG = 0;
    const LEVEL_NOTICE = 1;
    const LEVEL_WARNING = 2;
    const LEVEL_ERROR = 3;

    public static function out($string, $level = Debug::LEVEL_DEBUG)
    {
        if(self::isCommandLineInterface()) {
            self::outTerminal($string, $level);
        } else {
            self::outHtml($string, $level);
        }
    }

    private static function outTerminal($string, $level)
    {
        if ($level == Debug::LEVEL_DEBUG) {
            $color = Terminal::WHITE;
        } else if ($level == Debug::LEVEL_NOTICE) {
            $color = Terminal::YELLOW;
        } else if ($level == Debug::LEVEL_WARNING) {
            $color = Terminal::ORANGE;
        } else if ($level == Debug::LEVEL_ERROR) {
            $color = Terminal::RED;
        }
        Terminal::outln($string, $color);
    }

    private static function outHtml($mix, $level)
    {
        echo '<pre>';
        print_($mix);
        echo '</pre';
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
