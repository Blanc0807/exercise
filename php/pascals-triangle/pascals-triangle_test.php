<?php

class PascalsTriangleTest extends PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass(): void
    {
        require_once 'pascals-triangle.php';
    }

    public function testZeroRows(): void
    {
        $this->assertSame([], pascalsTriangleRows(0));
    }

    public function testSingleRow(): void
    {
        $this->assertSame([[1]], pascalsTriangleRows(1));
    }

    public function testTwoRows(): void
    {
        $this->assertSame([[1], [1, 1]], pascalsTriangleRows(2));
    }

    public function testThreeRows(): void
    {
        $this->assertSame([[1], [1, 1], [1, 2, 1]], pascalsTriangleRows(3));
    }

    public function testFourRows(): void
    {
        $this->assertSame([[1], [1, 1], [1, 2, 1], [1, 3, 3, 1]], pascalsTriangleRows(4));
    }

    public function testTenRows(): void
    {
        $this->assertSame([
            [1],
            [1, 1],
            [1, 2, 1],
            [1, 3, 3, 1],
            [1, 4, 6, 4, 1],
            [1, 5, 10, 10, 5, 1],
            [1, 6, 15, 20, 15, 6, 1],
            [1, 7, 21, 35, 35, 21, 7, 1],
            [1, 8, 28, 56, 70, 56, 28, 8, 1],
            [1, 9, 36, 84, 126, 126, 84, 36, 9, 1]
        ], pascalsTriangleRows(10));
    }

    public function testNegativeRows(): void
    {
        $this->assertEquals(-1, pascalsTriangleRows(-1));
    }

    public function testNullNoRows(): void
    {
        $this->assertEquals(-1, pascalsTriangleRows(null));
    }
}
