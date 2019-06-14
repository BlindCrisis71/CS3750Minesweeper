<?php

/**
 * Keeps track of all the game rules and mechanics
 */
class Game
{
    private $time = 0;

    /**
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    public function resetTime(){
        $this->time = 0;
    }

    public function isWinningMove(){

    }

    public function isGameOver(){

    }

    public function startTimer(){

    }
}