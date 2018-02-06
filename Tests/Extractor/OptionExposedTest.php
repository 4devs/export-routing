<?php

/*
 * This file is part of the 4devs Export Routing package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FDevs\ExportRouting\Tests\Extractor;

use FDevs\ExportRouting\Extractor\ExposedInterface;
use FDevs\ExportRouting\Extractor\OptionExposed;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Route;

class OptionExposedTest extends TestCase
{
    /**
     * @var ExposedInterface
     */
    private $exposed;

    protected function setUp()
    {
        $this->exposed = new OptionExposed('expose');
    }

    public function dataGranted(): array
    {
        return [
            [new Route('', [], [], ['expose' => true]), ''],
            [new Route('', [], [], ['expose' => 'true']), ''],
            [new Route('', [], [], ['expose' => 'on']), ''],
            [new Route('', [], [], ['expose' => '1']), ''],
            [new Route('', [], [], ['expose' => 1]), ''],
            [new Route('', [], [], ['expose' => 'yes']), ''],
        ];
    }

    /**
     * @dataProvider dataGranted
     */
    public function testGranted(Route $route, string $name)
    {
        $this->assertTrue($this->exposed->isRouteExposed($route, $name));
    }

    public function dataAbstain(): array
    {
        return [
            [new Route('', [], [], ['expose' => null]), ''],
            [new Route('', [], []), ''],
        ];
    }

    /**
     * @dataProvider dataAbstain
     */
    public function testAbstain(Route $route, string $name)
    {
        $this->assertNull($this->exposed->isRouteExposed($route, $name));
    }

    public function dataDenied(): array
    {
        return [
            [new Route('', [], [], ['expose' => false]),  uniqid()],
            [new Route('', [], [], ['expose' => 'false']),  uniqid()],
            [new Route('', [], [], ['expose' => 'off']),  uniqid()],
            [new Route('', [], [], ['expose' => '0']),  uniqid()],
            [new Route('', [], [], ['expose' => 0]),  uniqid()],
            [new Route('', [], [], ['expose' => 'no']),  uniqid()],
            [new Route('', [], [], ['expose' => uniqid()]), uniqid()],
        ];
    }

    /**
     * @dataProvider dataDenied
     */
    public function testDenied(Route $route, string $name)
    {
        $this->assertFalse($this->exposed->isRouteExposed($route, $name));
    }
}
