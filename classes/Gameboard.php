<?php
class Gameboard
{
    var $minesBoard;
    var $flagsBoard;
    var $uncoveredBoard;

    /**
     * @var bool Keeps track if the game has started
     */
    private $isGameStarted = false;

    /**
     * @var int How many mines are in the game
     */
    private $numMines = 10;

    /**
     * @var int How wide the gameboard is
     */
    private $gameboardWidth = 9;

    /**
     * @var int How tall the gameboard is
     */
    private $gameboardHeight = 9;

    public function getDefaultMinesArray() {
        $mines = array();
        for ($x = 1; $x < 10; $x++) {
            for ($y = 1; $y < 10; $y++) {
                array_push($mines, array($x, $y, "F"));
            }
        }
        $this->minesBoard = $mines;
        return $mines;
    }

    public function getDefaultFlagsArray() {
        $flags = array();
        for ($x = 1; $x < 10; $x++) {
            for ($y = 1; $y < 10; $y++) {
                array_push($flags, array($x, $y, "F"));
            }
        }
        $this->flagsBoard = $flags;
        return $flags;
    }

    public function getDefaultUncoveredArray() {
        $uncovered = array();
        for ($x = 1; $x < 10; $x++) {
            for ($y = 1; $y < 10; $y++) {
                array_push($uncovered, array($x, $y, "F"));
            }
        }
        $this->uncoveredBoard = $uncovered;
        return $uncovered;
    }

    public function getCellStatus($array, $x, $y) {
        $status = "";

        for ($row = 0; $row < 81; $row++) {
            if ($array[$row][0] == $x && $array[$row][1] == $y) {
                $status = $array[$row][2];
            }
        }
        return $status;
    }

    public function setCellStatus($array, $x, $y, $value) {
        $modifiedArray = $array;
        $newStatus = $value;

        for ($row = 0; $row < 81; $row++) {
            if ($array[$row][0] == $x && $array[$row][1] == $y) {
                $modifiedArray[$row][2] = $newStatus;
            }
        }
        return $modifiedArray;
    }

    /**
     * Randomizes the coordinates of all mines on the gameboard.
     */
    public function randomizeMinePlacement() {
        // 2D array that holds the coordinates of all the mines
        $arrMineCoordinates = array();
        // Keeps track of how many mines have been placed into $arrMineCoordinates
        $count = 0;

        // Loops until all mines have been given random coordinates
        while ($count < $this->numMines) {
            // Randomizes the x and y coordinates of each mine
            $x = rand(1, $this->numMines);
            $y = rand(1, $this->numMines);

            // If the randomized x and y coordinates don't exist in $arrMineCoordinates,
            // insert them into the array
            if (!$this->coordinateExists($arrMineCoordinates, $x, $y)){
                // Index for the placement of the current mine
                $index = count($arrMineCoordinates);
                // Inserts the x and y coordinate into the current index of $arrMineCoordinates
                $arrMineCoordinates[$index][0] = $x;
                $arrMineCoordinates[$index][1] = $y;

                $count++;
            }
        }

        // Sorts $arrMineCoordinates values in ascending order
        sort($arrMineCoordinates);
    }

    /**
     * Checks to see if an x and y coordinate pair exist in a given array
     * @param $coordinateArray Array of x and y coordinates
     * @param $x X coordinate
     * @param $y Y coordinate
     * @return bool Returns true if the coordinate pair exists in the array
     */
    private function coordinateExists($coordinateArray, $x, $y) {
        for ($row = 0; $row < count($coordinateArray); $row++){
            if ($coordinateArray[$row][0] == $x && $coordinateArray[$row][1] == $y){
                return true;
            }
        }

        return false;
    }
}

//// TEST
$mines = array();
for ($x = 1; $x < 10; $x++) {
  for ($y = 1; $y < 10; $y++) {
    array_push($mines, array($x, $y, "F"));
  }
}

for ($row = 0; $row < 81; $row++) {
  echo "<p><b>Row number $row</b></p>";
  echo "<ul>";
  for ($col = 0; $col < 3; $col++) {
    echo "<li>".$mines[$row][$col]."</li>";
  }
  echo "</ul>";
}
