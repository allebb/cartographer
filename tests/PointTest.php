<?php

use Ballen\Cartographer\Point;
use Ballen\Cartographer\Core\LatLong;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{

    private $point;
    private $lat = 52.058356;
    private $lng = 1.192342;

    public function setUp(): void
    {
        $this->point = new Point(new LatLong($this->lat, $this->lng));
        parent::setUp();
    }

    public function testPointExport()
    {
        $this->assertEquals(['coordinates' => [$this->lng, $this->lat]], $this->point->export());
    }

    public function testPointExportMember()
    {
        $this->assertEquals([$this->lng, $this->lat], $this->point->exportArray());
    }

    public function testPointGenerate()
    {
        $this->assertEquals('{"type":"Point","coordinates":[1.192342,52.058356]}', $this->point->generate());
    }

    public function testPointGenerateMember()
    {
        $this->assertEquals(
            ['type' => 'Point', 'coordinates' => [1.192342, 52.058356]],
            $this->point->generateMember()
        );
    }
}
