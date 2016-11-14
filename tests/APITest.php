<?php
namespace Plancke\Tests;

use Plancke\HypixelPHP\exceptions\ExceptionCodes;
use Plancke\HypixelPHP\exceptions\HypixelPHPException;
use Plancke\HypixelPHP\fetch\FetchParams;
use Plancke\HypixelPHP\HypixelPHP;
use Plancke\HypixelPHP\responses\guild\Guild;
use Plancke\HypixelPHP\responses\player\Player;
use Plancke\Tests\util\TestUtil;

class APITest extends \PHPUnit_Framework_TestCase {

    function testNoKey() {
        try {
            new HypixelPHP(null);
        } catch (HypixelPHPException $e) {
            $this->assertEquals(ExceptionCodes::NO_KEY, $e->getCode());
        }
    }

    function testInvalidKey() {
        try {
            new HypixelPHP("INVALID");
        } catch (HypixelPHPException $e) {
            $this->assertEquals(ExceptionCodes::INVALID_KEY, $e->getCode());
        }
    }

    function testValidKey() {
        new HypixelPHP("b13e2f50-a16c-4aa5-92a6-75e9b699b9fc");
    }

    function testPlayerResponse() {
        $this->assertTrue(TestUtil::getHypixelPHP()->getPlayer([FetchParams::PLAYER_BY_NAME => "Plancke"]) instanceof Player);
    }

    function testGuildResponse() {
        $this->assertTrue(TestUtil::getHypixelPHP()->getGuild([FetchParams::GUILD_BY_PLAYER_NAME => "Plancke"]) instanceof Guild);
    }
}
