<?php

namespace Bench;

use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @BeforeMethods({"init"})
 * @Revs(10)
 */
final class BenchArrayChangeKeys
{
    const ARRAY_SIZE = 1000;

    /**
     * @var int[]
     */
    private $array;

    public function init()
    {
        $this->array = range(0, self::ARRAY_SIZE);
    }

    /**
     * @Iterations(100)
     */
    public function benchSimpleLoopArrayKeyChanging()
    {
        /** @noinspection OnlyWritesOnParameterInspection */
        $newArray = [];

        foreach ($this->array as $value) {
            /** @noinspection OnlyWritesOnParameterInspection */
            $newArray[$value + 1] = $value;
        }
    }

    /**
     * @Iterations(100)
     */
    public function benchArrayCombineArrayKeyChanging()
    {
        /** @noinspection PhpUnusedLocalVariableInspection */
        $newArray = array_combine(
            array_map(
                function ($value) {
                    return $value + 1;
                },
                $this->array
            ),
            $this->array
        );
    }

    /**
     * @Iterations(100)
     */
    public function benchArrayChangeKeys()
    {
        $newArray = array_change_keys(
            $this->array,
            function($key, $value) {
                return $value + 1;
            }
        );
    }
}