<?php

namespace vPvP\Tests\util;

use vPvP\HypixelPHP\cache\impl\NoCacheHandler;
use vPvP\HypixelPHP\exceptions\HypixelPHPException;
use vPvP\HypixelPHP\fetch\impl\DefaultFetcher;
use vPvP\HypixelPHP\HypixelPHP;
use vPvP\HypixelPHP\log\Logger;

class TestUtil {

    /**
     * @return HypixelPHP
     * @throws HypixelPHPException
     */
    public static function getHypixelPHP() {
        $HypixelPHP = new HypixelPHP(self::getAPIKey());

        $HypixelPHP->setLogger(new class ($HypixelPHP) extends Logger {
            public function actuallyLog($level, $line) {
                echo $level . ': ' . $line . "\n";
            }
        });
        $HypixelPHP->setCacheHandler(new NoCacheHandler($HypixelPHP));

        $fetcher = new DefaultFetcher($HypixelPHP);
        $fetcher->setUseCurl(false);
        $HypixelPHP->setFetcher($fetcher);

        return $HypixelPHP;
    }

    public static function getAPIKey() {
        if (isset($_ENV['API_KEY'])) return $_ENV['API_KEY'];
        if (isset($_SERVER['API_KEY'])) return $_SERVER['API_KEY'];
        return null;
    }

}
