<?php
/**
 * Created by PhpStorm.
 * User: collin
 * Date: 2018/11/7
 * Time: 上午11:44
 */

namespace CollinPeng\UniqueId;

use CollinPeng\UniqueId;
use PHPUnit\Framework\TestCase;

class UniqueIdTest extends TestCase
{
    /**
     * @var UniqueId
     */
    protected $uniqueId;

    protected function setUp()
    {
        $this->uniqueId = new UniqueId;
    }

    public function testShouldConstruct()
    {
        $this->assertInstanceOf(UniqueId::class, $this->uniqueId);
    }

    public function testObjectIdShouldBe24Bytes()
    {
        $this->assertEquals(24, strlen($this->uniqueId->objectId()));
    }

    public function testUuidShouldBe36Bytes()
    {
        $this->assertEquals(36, strlen($this->uniqueId->uuid()));
    }

    public function testUuidFormat()
    {
        $pattern = "/^[\da-fA-F]{8}-[\da-fA-F]{4}-[\da-fA-F]{4}-[\da-fA-F]{4}-[\da-fA-F]{12}$/";
        $this->assertTrue((bool)preg_match($pattern, $this->uniqueId->uuid()));
    }

    public function testMACAddress()
    {
        $this->assertNotEmpty(MACAddress::getCurrentMACAddress());
    }

    public function testGetMachine()
    {
        $this->assertNotEmpty(substr(hash("crc32", MACAddress::getCurrentMACAddress()), 2));
    }

    public function testGetmypid()
    {
        $this->assertNotEmpty(getmypid());
    }

    public function testRandomBy6Bytes()
    {
        $this->assertEquals(6, strlen(dechex(rand(1048576, 16777215)) . ""));
    }
}