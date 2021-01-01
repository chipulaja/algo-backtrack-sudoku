<?php

namespace Chipulaja\Algo\Backtrack\Sudoku;

class SudokuSolverCara1
{
    private $soal     = [];
    private $jawaban  = [];
    private $emptyLocation = [];

    public function tryToSolve(
        $data,
        $emptyLocation = [],
        $possibilitiesValue = [],
        $prevValue = null,
        $lastPosition = null,
        $tempSolusion = []
    ) {
        if (empty($emptyLocation)) {
            $emptyLocation = $this->getEmptyLocation($data);
            $this->soal = $data;
            $this->emptyLocation = $emptyLocation;
            foreach ($emptyLocation as $position => $location) {
                $possibilitiesValue[$position] = $this->getPossibilitiesValue(
                    $location,
                    $data
                );
            }
        }

        $newData = $data;
        if ($lastPosition === null) {
            $keysLocation = array_keys($emptyLocation);
            $lastPosition = (int)$keysLocation[0];
        }

        $record = false;
        foreach ($emptyLocation as $position => $location) {
            if (sizeof($tempSolusion) >= sizeof($emptyLocation)) {
                $this->jawaban = $tempSolusion;
                break;
            }

            if ($position == $lastPosition) {
                $record = true;
            }

            if ($record == false) {
                continue;
            }
            $lastPosition = $position;
            $value = $this->getNextValue($prevValue, $possibilitiesValue[$position]);
            if ($value === null) {
                $prevLocation = $this->getPrevLocation($lastPosition, $emptyLocation);
                $position = key($prevLocation);
                $lastPosition = $position;
                $x = $prevLocation[$position]["x"];
                $y = $prevLocation[$position]["y"];
                $prevValue = $tempSolusion[$lastPosition];
                $newData[$x][$y] = 0;
                array_pop($tempSolusion);

                $tempSolusion = $this->tryToSolve(
                    $newData,
                    $emptyLocation,
                    $possibilitiesValue,
                    $prevValue,
                    $position,
                    $tempSolusion
                );
            } else {
                $isValidValue = $this->isValidValue($location, $newData, $value);
                $x = $location["x"];
                $y = $location["y"];
                $newData[$x][$y] = $value;
                if ($isValidValue == true) {
                    $tempSolusion[$position] = $value;
                    $prevValue = null;
                } else {
                    $newData[$x][$y] = 0;
                    $tempSolusion = $this->tryToSolve(
                        $newData,
                        $emptyLocation,
                        $possibilitiesValue,
                        $value,
                        $position,
                        $tempSolusion
                    );
                    break;
                }
            }
        }

        return $tempSolusion;
    }

    public function getEmptyLocation($data)
    {
        $location = [];
        foreach ($data as $x => $cells) {
            foreach ($cells as $y => $value) {
                if (empty($value)) {
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

    protected function getPossibilitiesValue($location, $data)
    {
        $allHorisontalValue = $this->getAllHorisontalValue($location, $data);
        $allVerticalValue = $this->getAllVerticalValue($location, $data);
        $allSquereValue = $this->getAllSquereValue($location, $data);
        $allValue = array_merge(
            $allHorisontalValue,
            $allVerticalValue,
            $allSquereValue
        );

        $possibilitiesValue = array_diff(range(1, 9), $allValue);
        $possibilitiesValue = array_values($possibilitiesValue);
        return $possibilitiesValue;
    }

    protected function getAllHorisontalValue($location, $data)
    {
        $horisontalValue = [];
        $x = $location['x'];
        for ($i=$x; $i<=$x; $i++) {
            for ($j=0; $j<9; $j++) {
                if (!empty($data[$i][$j])) {
                    $horisontalValue[] = $data[$i][$j];
                }
            }
        }
        return $horisontalValue;
    }

    protected function getAllVerticalValue($location, $data)
    {
        $verticalValue = [];
        $y = $location['y'];
        for ($i=0; $i<9; $i++) {
            for ($j=$y; $j<=$y; $j++) {
                if (!empty($data[$i][$j])) {
                    $verticalValue[] = $data[$i][$j];
                }
            }
        }
        return $verticalValue;
    }

    protected function getAllSquereValue($location, $data)
    {
        $squereValue = [];
        $x = $location['x'];
        $y = $location['y'];

        $iStart = 3 * floor($x/3);
        $iEnd   = $iStart + 2;
        $jStart = 3 * floor($y/3);
        $jEnd   = $jStart + 2;

        for ($i=$iStart; $i<=$iEnd; $i++) {
            for ($j=$jStart; $j<=$jEnd; $j++) {
                if (!empty($data[$i][$j])) {
                    $squereValue[] = $data[$i][$j];
                }
            }
        }
        return $squereValue;
    }

    protected function isValidValue($location, $data, $value)
    {
        $allHorisontalValue = $this->getAllHorisontalValue($location, $data);
        if (in_array($value, $allHorisontalValue)) {
            return false;
        }

        $allVerticalValue = $this->getAllVerticalValue($location, $data);
        if (in_array($value, $allVerticalValue)) {
            return false;
        }

        $allSquereValue = $this->getAllSquereValue($location, $data);
        if (in_array($value, $allSquereValue)) {
            return false;
        }

        return true;
    }

    protected function getPrevLocation($currentPosition, $emptyLocation)
    {
        while (key($emptyLocation) !== $currentPosition) {
            next($emptyLocation);
        }
        $location = prev($emptyLocation);
        $position = key($emptyLocation);

        return [$position => $location];
    }

    protected function getNextValue($value, $possibilitiesValue)
    {
        if (!is_numeric($value)) {
            return @$possibilitiesValue[0];
        }

        $key = array_search($value, $possibilitiesValue);

        return @$possibilitiesValue[$key+1];
    }

    public function getAnswerBoard()
    {
        $jawabanBoard = $this->soal;
        $emptyLocation = $this->emptyLocation;
        $jawaban = $this->jawaban;

        foreach ($emptyLocation as $position => $location) {
            $x = $location['x'];
            $y = $location['y'];
            $jawabanValue = $jawaban[$position];
            $jawabanBoard[$x][$y] = $jawabanValue;
        }
        return $jawabanBoard;
    }
}
