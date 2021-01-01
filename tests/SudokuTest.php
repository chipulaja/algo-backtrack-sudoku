<?php

use Chipulaja\Algo\Backtrack\Sudoku\SudokuSolverCara1;
use Chipulaja\Algo\Backtrack\Sudoku\SudokuValidator;
use PHPUnit\Framework\TestCase;

class SudokuTest extends TestCase
{
    public function testCara1()
    {
        $files = [
            __DIR__."/../data/easy1.json",
            __DIR__."/../data/easy2.json",
            __DIR__."/../data/medium1.json",
            __DIR__."/../data/medium2.json",
            __DIR__."/../data/hard1.json",
            __DIR__."/../data/hard2.json"
        ];
        foreach ($files as $file) {
            $jsonData = file_get_contents($file);
            $data = json_decode($jsonData, true);
            $question = $data["question"];
            $answer = $data["answer"];

            $solver = new SudokuSolverCara1();
            $solver->tryToSolve($question);
            $answerBoard = $solver->getAnswerBoard();
            $this->assertEquals($answer, $answerBoard);
        }
    }
    
    public function testValidation()
    {
        $files = [
            __DIR__."/../data/easy1.json"    => true,
            __DIR__."/../data/easy2.json"    => true,
            __DIR__."/../data/medium1.json"  => true,
            __DIR__."/../data/medium2.json"  => true,
            __DIR__."/../data/hard1.json"    => true,
            __DIR__."/../data/hard2.json"    => true,
            __DIR__."/../data/novalid1.json"  => false,
            __DIR__."/../data/novalid2.json"  => false,
            __DIR__."/../data/novalid3.json"  => false
        ];
        foreach ($files as $file => $status) {
            $jsonData = file_get_contents($file);
            $data = json_decode($jsonData, true);
            $question = $data["question"];

            $solver  = new SudokuValidator();
            $isValid = $solver->isValidSudoku($question);
            $this->assertEquals($status, $isValid);
        }
    }
}
