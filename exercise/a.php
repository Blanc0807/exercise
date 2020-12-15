<?php
function solve(string $boardString) : string
{
    return Board::create($boardString)
        ->solve();
}

class Board
{
    const CELL_DEFAULT = ' ';
    const CELL_MINE = '*';
    const BORDER_TOP = 1;
    const BORDER_BOTTOM = 2;
    const BORDER_LEFT = 4;
    const BORDER_RIGHT = 8;
    const MINE = '';
    protected $dimension = [
        'X' => 0,
        'Y' => 0
    ];
    protected $corners;
    protected $borders;
    protected $boardMatrix;
    protected $cells;
    public function __construct(string $boardString)
    {
        $this->boardMatrix = array_map(function ($row) {
            return str_split(trim($row));
        }, preg_split('/\n/', trim($boardString)));
        $this->resolveDimensions()
            ->resolveCorners()
            ->resolveBorders()
            ->validateCorners()
            ->validateBorders();
    }
    protected function resolveDimensions() : Board
    {
        $x = max(...array_map('count', $this->boardMatrix));
        $y = count($this->boardMatrix);
        $this->dimension = [
            'X' => $x,
            'Y' => $y
        ];
        if ($x <= 3 && $y <= 3) throw new InvalidArgumentException('');
        return $this;
    }
    protected function resolveCorners() : Board
    {
        $x = $this->dimension['X'] - 1;
        $y = $this->dimension['Y'] - 1;
        $this->corners = [
            $this->boardMatrix[0][0] ?? NULL,
            $this->boardMatrix[0][$x] ?? NULL,
            $this->boardMatrix[$y][0] ?? NULL,
            $this->boardMatrix[$y][$x] ?? NULL,
        ];
        print_r($this->corners);
        return $this;
    }
    protected function resolveBorders() : Board
    {
        $this->borders = [
            static::BORDER_TOP => trim(join('', $this->boardMatrix[0]), '+'),
            static::BORDER_BOTTOM => trim(join('', $this->boardMatrix[$this->dimension['Y'] - 1] ?? []), '+'),
            static::BORDER_LEFT => trim(array_reduce($this->boardMatrix, function ($return, $row) {
                $return .= $row[0];
                return $return;
            }), '+'),
            static::BORDER_RIGHT => trim(array_reduce($this->boardMatrix, function ($return, $row) {
                $return .= $row[$this->dimension['X'] - 1] ?? '';
                return $return;
            }), '+'),
        ];
        print_r($this->borders);
        return $this;
    }
    protected function validateCorners() : Board
    {
        array_map([$this, 'validateCorner'], $this->corners);
        return $this;
    }
    protected function validateBorders() : Board
    {
        array_walk($this->borders, [$this, 'validateBorder']);
        return $this;
    }
    protected function validateCorner($value)
    {
        if ($value !== '+') throw new InvalidArgumentException("Err Corner");
    }
    protected function validateBorder($value, $pos)
    {
        switch ($pos) {
            case static::BORDER_TOP :
            case static::BORDER_BOTTOM :
                if ($value !== str_repeat('-', $this->dimension['X'] - 2)) {
                    throw new InvalidArgumentException("Err Border");
                }
                break;
            case static::BORDER_LEFT :
            case static::BORDER_RIGHT :
                if ($value !== str_repeat('|', $this->dimension['Y'] - 2)) {
                    throw new InvalidArgumentException("Err Border");
                }
                break;
        };

    }
    public static function create(string $boardString) : Board
    {
        return new static($boardString);
    }
    public function solve() : Board
    {
        foreach ($this->boardMatrix as $y => &$row) {
            if ($y === 0 || $y === $this->dimension['Y'] - 1)
                continue;
            foreach ($row as $x => &$cell) {
                if ($x === 0 || $x === $this->dimension['X'] - 1)
                    continue;
                $this->solveCell($x, $y, $cell);
            }
        }
        return $this;
    }
    protected function solveCell($x, $y, &$cell)
    {
        switch ($this->boardMatrix[$y][$x]) {
            case static::CELL_DEFAULT :
                $mineCount = 0;
                foreach (static::siblings as $sibling) {
                    if ($this->boardMatrix[$y + $sibling['delta_Y']][$x + $sibling['delta_X']] === static::CELL_MINE) {
                        $mineCount++;
                    }
                }
                $cell = $mineCount ? : ' ';
                return;
            case static::CELL_MINE :
                return;
            default :
                throw new InvalidArgumentException("Err Mine", 1);
        }
    }
    public function __toString() : string
    {
        return "\n" . array_reduce($this->boardMatrix, function ($return, $row) {
                $return .= join('', $row) . "\n";
                return $return;
            });
    }
    const siblings = [
        'TOP' => [
            'delta_X' => 0,
            'delta_Y' => -1,
        ],
        'BOTTOM' => [
            'delta_X' => 0,
            'delta_Y' => 1,
        ],
        'LEFT' => [
            'delta_X' => -1,
            'delta_Y' => 0,
        ],
        'RIGHT' => [
            'delta_X' => 1,
            'delta_Y' => 0,
        ],
        'TOP_LEFT' => [
            'delta_X' => -1,
            'delta_Y' => -1,
        ],
        'TOP_RIGHT' => [
            'delta_X' => 1,
            'delta_Y' => -1,
        ],
        'BOTTOM_LEFT' => [
            'delta_X' => -1,
            'delta_Y' => 1,
        ],
        'BOTTOM_RIGHT' => [
            'delta_X' => 1,
            'delta_Y' => 1,
        ],
    ];
}