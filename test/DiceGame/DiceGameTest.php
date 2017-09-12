<?php

namespace joel\DiceGame;

/**
 * Test cases for class Guess.
 */
class DiceGameTest extends \PHPUnit_Framework_TestCase
{

    public function testCreateObject()
    {
        $diceGame = new DiceGame();
        $this->assertInstanceOf("\joel\DiceGame\DiceGame", $diceGame);
        $this->assertEquals(0, $diceGame->diceNumber);

    }
}
