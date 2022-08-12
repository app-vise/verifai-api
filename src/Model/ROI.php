<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class ROI
{
    /** @var float $x1 */
    private $x1;
    /** @var float $x2 */
    private $x2;
    /** @var float $x3 */
    private $x3;
    /** @var float $x4 */
    private $x4;
    /** @var float $y1 */
    private $y1;
    /** @var float $y2 */
    private $y2;
    /** @var float $y3 */
    private $y3;
    /** @var float $y4 */
    private $y4;

    public function __construct(float $x1, float $x2, float $x3, float $x4, float $y1, float $y2, float $y3, float $y4)
    {
        $this->x1 = $x1;
        $this->x2 = $x2;
        $this->x3 = $x3;
        $this->x4 = $x4;
        $this->y1 = $y1;
        $this->y2 = $y2;
        $this->y3 = $y3;
        $this->y4 = $y4;
    }

    public function getX1(): float
    {
        return $this->x1;
    }

    public function getX2(): float
    {
        return $this->x2;
    }

    public function getX3(): float
    {
        return $this->x3;
    }

    public function getX4(): float
    {
        return $this->x4;
    }

    public function getY1(): float
    {
        return $this->y1;
    }

    public function getY2(): float
    {
        return $this->y2;
    }

    public function getY3(): float
    {
        return $this->y3;
    }

    public function getY4(): float
    {
        return $this->y4;
    }
}
