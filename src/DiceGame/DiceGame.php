<?php

namespace joel\DiceGame;

class DiceGame
{

  public $player1 = [];
  public $rolls = [];
  public $diceNumber = 0;

  public function rollDice()
  {
    $this->diceNumber = rand(1, 6);
  }

  public function getTotal()
  {
    return array_sum($this->rolls);
  }

  public function getTotalPlayer()
  {
    return array_sum($this->player1);
  }

  public function getRollsAsArray()
  {
    return $this->rolls;
  }

  public function win($score)
  {
    if ($score >= 100) {
      return "<h2 style='color:green'>YOU WIN!</h2>";
    }
  }

}
