<?php
class Gameboard
{
    /**
     * @var array Keeps track of the gameboard
     * 2D array
     * First array keeps track of the number of cells
     * Second array keeps track of the cell states (x, y, mine, flag, uncovered)
     */
    private $gameboard;

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

    // public function getCellStatus($array, $x, $y) {
    //     $status = "";
    //
    //     for ($row = 0; $row < 81; $row++) {
    //         if ($array[$row][0] == $x && $array[$row][1] == $y) {
    //             $status = $array[$row][2];
    //         }
    //     }
    //     return $status;
    // }
    //
    // public function setCellStatus($array, $x, $y, $value) {
    //     $modifiedArray = $array;
    //     $newStatus = $value;
    //
    //     for ($row = 0; $row < 81; $row++) {
    //         if ($array[$row][0] == $x && $array[$row][1] == $y) {
    //             $modifiedArray[$row][2] = $newStatus;
    //         }
    //     }
    //     return $modifiedArray;
    // }

    /**
     * Randomizes the coordinates of all mines on the gameboard.
     * @return array A list of coordinates for the mines
     */
    public function randomizeMinePlacement() {
        // 2D array that holds the coordinates of all the mines
        $arrMineCoordinates = array();
        // Keeps track of how many mines have been placed into $arrMineCoordinates
        $count = 0;

        // Loops until all mines have been given random coordinates
        while ($count < $this->numMines) {
            // Randomizes the x and y coordinates of each mine
            $x = rand(1, $this->numMines - 1);
            $y = rand(1, $this->numMines - 1);

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

        return $arrMineCoordinates;
    }

    /**
     * Checks to see if an x and y coordinate pair exist in a given array
     * @param $coordinateArray Array of x and y coordinates
     * @param $x X coordinate
     * @param $y Y coordinate
     * @return bool Returns true if the coordinate pair exists in the array
     */
    public function coordinateExists($coordinateArray, $x, $y) {
        for ($row = 0; $row < count($coordinateArray); $row++){
            if ($coordinateArray[$row][0] == $x && $coordinateArray[$row][1] == $y){
                return true;
            }
        }

        return false;
    }

    /**
     * Sets the default gameboard with random mine coordinates
     */
    public function setDefaultGameboard() {
        $defaultGameboard = array();
        for ($i = 1; $i < $this->gameboardWidth + 1; $i++) {
            for ($j = 1; $j < $this->gameboardHeight + 1; $j++) {
                // Setting default values for each cell
                // (X Coordinate, Y Coordinate, Mine, Flag, Uncovered)
                array_push($defaultGameboard, array($i, $j, "F", "F", "F"));
            }
        }

        // Gets array of random mines
        $arrMineCoordinates = $this->randomizeMinePlacement();

        // Matches gameboard coordinates to mine coordinates and sets the mine value to 'T' for True
        for ($row = 0; $row < 81; $row++) {
            for ($i = 0; $i < 10; $i++) {
                if ($defaultGameboard[$row][0] == $arrMineCoordinates[$i][0] && $defaultGameboard[$row][1] == $arrMineCoordinates[$i][1]) {
                    // Setting mine to 'T' for True
                    $defaultGameboard[$row][2] = "T";
                }
            }
        }

        /**  Uncomment following code to debug mine placement only!
        // START OF ECHO TESTS
        echo "<h1><b>RANDOMIZED MINES</b></h1>";

        for ($i = 0; $i < 10; $i++) {
            echo "<p><b>Mine number $i</b></p>";
            echo "<ul>";
            for ($j = 0; $j < 2; $j++) {
                echo "<li>".$arrMineCoordinates[$i][$j]."</li>";
            }
            echo "</ul>";
        }


        echo "<h1><b>GAMEBOARD</b></h1>";
        for ($row = 0; $row < 81; $row++) {
            echo "<p><b>Cell number $row</b></p>";
            echo "<ul>";
            for ($col = 0; $col < 5; $col++) {
                echo "<li>".$defaultGameboard[$row][$col]."</li>";
            }
            echo "</ul>";
        }
        // END OF ECHO TESTS
         */
    }
}

