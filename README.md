# Algo Backtrack Sudoku

[![Latest version][ico-version]][link-packagist]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

a library for solving sudoku.

## Table of contents

- [Install](#install)
- [Usage](#usage)
- [Testing](#testing)

## Install

Via Composer

``` bash
$ composer require chipulaja/algo-backtrack-sudoku
```

## Usage

```php
use Chipulaja\Algo\Backtrack\Sudoku\SudokuSolverCara1;

$data = [
    [0,2,0,  0,1,3,  0,6,0],
    [0,0,5,  6,0,0,  3,4,0],
    [0,0,0,  0,0,0,  0,0,0],

    [1,0,2,  0,7,0,  0,8,5],
    [0,9,0,  0,0,2,  0,0,0],
    [7,0,0,  0,3,0,  0,0,0],

    [0,0,0,  3,0,5,  9,0,0],
    [0,0,0,  0,2,0,  0,5,1],
    [0,0,0,  8,0,0,  0,7,0]
];

$solver = new SudokuSolverCara1();
$solver->tryToSolve($data);
$answerBoard = $solver->getAnswerBoard();
```

## Testing

``` bash
$ vendor\bin\phpunit
```

[ico-version]: https://img.shields.io/packagist/v/Chipulaja/Algo-Backtrack-Sudoku.svg?style=flat-square
[ico-travis]: https://travis-ci.org/Chipulaja/Algo-Backtrack-Sudoku.svg?branch=master
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/Chipulaja/Algo-Backtrack-Sudoku.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/chipulaja/Algo-Backtrack-Sudoku.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/chipulaja/algo-backtrack-sudoku.svg?style=flat-square


[link-packagist]: https://packagist.org/packages/chipulaja/algo-backtrack-sudoku
[link-travis]: https://travis-ci.org/Chipulaja/Algo-Backtrack-Sudoku
[link-scrutinizer]: https://scrutinizer-ci.com/g/Chipulaja/Algo-Backtrack-Sudoku/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/Chipulaja/Algo-Backtrack-Sudoku
[link-downloads]: https://packagist.org/packages/chipulaja/algo-backtrack-sudoku

