<?php

namespace Chipulaja\Algo\Backtrack\Sudoku;

class SudokuValidator
{
    public function isValidSudoku($data)
    {
        $isValid = true;
        $locationHaveContents = $this->getLocationHaveContents($data);
        foreach ($locationHaveContents as $location) {
            $x = $location['x'];
            $y = $location['y'];
            $value = $data[$x][$y];
            $vertical = $this->isValidVertical($location, $value, $data);
            if ($vertical === false) {
                return false;
            }
            $horisontal = $this->isValidHorisontal($location, $value, $data);
            if ($horisontal === false) {
                return false;
            }
            $squere = $this->isValidSquere($location, $value, $data);
            if ($squere === false) {
                return false;
            }
        }
        return true;
    }

    public function getLocationHaveContents($data)
    {
        $location = [];
        foreach ($data as $x => $cells) {
            foreach ($cells as $y => $value) {
                if (!empty($value)) {
                    $position = (int)($x."".$y);
                    $location[$position] = [
                        'x' => $x,
                        'y' => $y
                    ];
                }
            }
        }

        return $location;
    }

    protected function isValidVertical($location, $value, $data)
    {
        $x = $location["x"];
        $count = array_count_values($data[$x]);
        if ($count[$value] > 1) {
            return false;
        }
        return true;
    }

    protected function isValidHorisontal($location, $value, $data)
    {
        $dataY = [];
        foreach ($data as $x => $cells) {
            foreach ($cells as $y => $cellValue) {
                if ($y == $location["y"]) {
                    $dataY[] = $cellValue;
                }
            }
        }
        $count = array_count_values($dataY);
        if ($count[$value] > 1) {
            return false;
        }
        return true;
    }

    protected function isValidSquere($location, $value, $data)
    {
        $squereData = [];
        $x = $location['x'];
        $y = $location['y'];

        $iStart = 3 * floor($x/3);
        $iEnd   = $iStart + 2;
        $jStart = 3 * floor($y/3);
        $jEnd   = $jStart + 2;

        for ($i=$iStart; $i<=$iEnd; $i++) {
            for ($j=$jStart; $j<=$jEnd; $j++) {
                if (!empty($data[$i][$j])) {
                    $squereData[] = $data[$i][$j];
                }
            }
        }

        $count = array_count_values($squereData);
        if ($count[$value] > 1) {
            return false;
        }
        return true;
    }
}
