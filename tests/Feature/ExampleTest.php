<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_sum_digits()
    {
        $arg1 = '9000000000000000000000000655';
        $arg2 = '2000000000000000000000000712';
        $result = $this->sumBigDigits($arg1, $arg2);
        $this->assertEquals('11000000000000000000000001367', $result);
    }

    public function sumBigDigits(string $arg1, string $arg2): string
    {
        $max = $arg1 >= $arg2 ? $arg1 : $arg2;
        $min = $arg1 == $max ? $arg2 : $arg1;
        $stackMax = array_reverse(str_split($max));
        $stackMin = array_reverse(str_split($min));
        $resultStack = [];
        $uppNextLevel = false;
        foreach ($stackMax as $key => $value) {
            $sum = $value + @$stackMin[$key] + $uppNextLevel;
            $uppNextLevel = false;
            if ($sum < 10) {
                array_push($resultStack, (string)$sum);
            } else {
                $uppNextLevel = true;
                array_push($resultStack, ((string)$sum)[1]);
            }
        }

        if ($uppNextLevel) {
            array_push($resultStack, '1');
        }

        return implode("", array_reverse($resultStack));
    }
}
