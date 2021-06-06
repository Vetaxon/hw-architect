<?php

namespace App\Tree;

class CountingSort
{
    /**
     * @param array $array
     */
    public static function countingSort(array &$array): void
    {
        $n = count($array);

        $max = 0;

        for ($i = 0; $i < $n; $i++) {
            if ($max < $array[$i]) {
                $max = $array[$i];
            }
        }

        $frequency = [];

        for ($i = 0; $i < $max + 1; $i++) {
            $frequency[$i] = 0;
        }

        for ($i = 0; $i < $n; $i++) {
            $frequency[$array[$i]]++;
        }

        for ($i = 0, $j = 0; $i <= $max; $i++) {
            while ($frequency[$i] > 0) {
                $array[$j] = $i;
                $j++;
                $frequency[$i]--;
            }
        }
    }
}
