<?php 
// tests/Unit/MathHelperTest.php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\MathHelper;

class MathHelperTest extends TestCase
{
    public function test_add_function_returns_correct_sum()
    {
        $result = MathHelper::add(2, 3);
        $this->assertEquals(6, $result);
    }
}
