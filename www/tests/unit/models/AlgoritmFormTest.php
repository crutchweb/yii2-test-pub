<?php

namespace tests\unit\models;

use app\models\Algorithm;
use app\models\AlgorithmForm;

class AlgoritmTest extends \Codeception\Test\Unit
{

    public function testRightSolution()
    {
        $model = new AlgorithmForm();
        $solution = $model->getSolution(5, [5,5,1,7,2,3,5]);

        expect_that($solution == 4 || $solution == -1);
        expect_not($solution != 4);
    }
}
