<?php
class Gameboard
{
  var $minesBoard;
  var $flagsBoard;
  var $uncoveredBoard;

  public function getDefaultMinesArray() {
    $mines = array();
    for ($x = 1; $x < 10; $x++) {
      for ($y = 1; $y < 10; $y++) {
        array_push($mines, array($x, $y, "F"));
      }
    }
    $this->$minesBoard = $mines;
    return $mines;
  }

  public function getDefaultFlagsArray() {
    $flags = array();
    for ($x = 1; $x < 10; $x++) {
      for ($y = 1; $y < 10; $y++) {
        array_push($flags, array($x, $y, "F"));
      }
    }
    $this->$flagsBoard = $flags;
    return $flags;
  }

  public function getDefaultUncoveredArray() {
    $uncovered = array();
    for ($x = 1; $x < 10; $x++) {
      for ($y = 1; $y < 10; $y++) {
        array_push($uncovered, array($x, $y, "F"));
      }
    }
    $this->$uncoveredBoard = $uncovered;
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
?>
