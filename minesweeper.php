<?php
include ("classes/Cell.php");
include ("database/dbconfig.php");

//Initialize Table
$table = [
'0' => [],
'1' => [],
'2' => [],
'3' => [],
'4' => [],
'5' => [],
'6' => [],
'7' => [],
'8' => []
];
//Create all new cell objects
for($x = 0; $x<9; $x++){
    for($y = 0; $y<9; $y++){
        $table[$x][$y] = new Cell($x,$y, 0);
    }
}

//Runs if the user clicks
if(isset($_GET['x'])){
    include "(database/dbconfig.php)";

    //The X and Y Cell the User Clicked
    $xClicked = $_GET['x'];
    $yClicked = $_GET['y'];
    
    /*
    * The SQL Commands that are run when a user clicks a cell.
    * These commands insert a flag on a cell if there was not one previously
    * or removes a flag if there was one previously.
    */
    $sql = "SELECT hasFlag FROM minesweeper WHERE xCoordinate= " . $xClicked . " AND yCoordinate = " . $yClicked;
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
           $hasFlag = $row['hasFlag'];
       }

       if($hasFlag == 0){
        $sql = "UPDATE minesweeper SET hasFlag = 1 WHERE xCoordinate= " . $xClicked . " AND yCoordinate = " . $yClicked;
        $table[$yClicked-1][$xClicked-1]->hasFlag = 1;
    }
    else{
        $sql = "UPDATE minesweeper SET hasFlag = 0 WHERE xCoordinate= " . $xClicked . " AND yCoordinate = " . $yClicked;
        $table[$yClicked-1][$xClicked-1]->hasFlag = 0;
    }
    mysqli_query($conn, $sql);
    //END OF FLAG CHECKING

    /*
    * Commands that are run when a user clicks on a cell
    * It checks to see if the database has a mine in that given cell
    * If so, it displays a message. 
    */
    $hasMine = 0;

    $sql = "SELECT hasMine FROM minesweeper WHERE xCoordinate= " . $xClicked . " AND yCoordinate = " . $yClicked;
    $result = $conn->query($sql);


    if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
           $hasMine = $row['hasMine'];
       }
   }
   if($hasMine == 1){
    echo "You Lost!"; //displayed message
}
//END OF MINE CHECKING

}

}
else{
    $xClicked = 0;
    $yClicked = 0;
    /* BEGIN PLACING MINES */
    
    $sql = "DELETE FROM minesweeper";
    mysqli_query($conn, $sql);

    //MINEFIELD
    //TODO: Randomly generate it
    $minefield = [
    '0' => [1,1,0,1,0,0,0,0,0],
    '1' => [0,0,0,0,0,0,0,0,0],
    '2' => [0,0,0,0,0,0,0,0,0],
    '3' => [0,0,0,1,0,0,0,0,0],
    '4' => [0,0,0,0,0,0,0,0,0],
    '5' => [0,0,0,0,0,0,0,0,0],
    '6' => [0,0,0,0,0,0,0,0,0],
    '7' => [0,0,0,0,0,0,0,0,0],
    '8' => [0,0,0,0,0,0,0,0,0]
    ];
    $arrayNumBombs = [
    '0' => [0,0,0,0,0,0,0,0,0],
    '1' => [0,0,0,0,0,0,0,0,0],
    '2' => [0,0,0,0,0,0,0,0,0],
    '3' => [0,0,0,0,0,0,0,0,0],
    '4' => [0,0,0,0,0,0,0,0,0],
    '5' => [0,0,0,0,0,0,0,0,0],
    '6' => [0,0,0,0,0,0,0,0,0],
    '7' => [0,0,0,0,0,0,0,0,0],
    '8' => [0,0,0,0,0,0,0,0,0]
    ];
    //INSERT each cell into the database
    //TODO: Calculate how many bombs are next to each cell and display the value in the database

    
    for($x=0; $x<9; $x++){
        for($y=0; $y<9; $y++){
          $numBombs = 0;
          if($x == 0 && $y == 0){
              if($minefield[$x + 1][$y] == 1){
                $numBombs++;  
              }
              if($minefield[$x][$y + 1] == 1){
                $numBombs++;
              }
          }
          else if($x == 8 && $y == 0){
              if($minefield[$x - 1][$y] == 1){
                 $numBombs++; 
              }
              if($minefield[$x][$y + 1] == 1){
                 $numBombs++; 
              }
          }
          else if($x == 0 && $y == 8){
              if($minefield[$x + 1][$y] == 1){
                 $numBombs++; 
              }
              if($minefield[$x][$y - 1] == 1){
                 $numBombs++; 
              }
          }
          else if($x == 8 && $y == 8){
              if($minefield[$x - 1][$y] == 1){
                 $numBombs++; 
              }
              if($minefield[$x][$y - 1] == 1){
                 $numBombs++;  
              }
          }
          else if($x == 0 && (($y !== 0) && ($y !== 8) )){
              if($minefield[$x][$y + 1]){
                 $numBombs++; 
              }
              if($minefield[$x][$y - 1]){
                 $numBombs++; 
              }
              if($minefield[$x + 1][$y]){
                 $numBombs++; 
              }
          }
          else if($x == 8 && (($y !== 0) && ($y !== 8) )){
              if($minefield[$x][$y + 1]){
                 $numBombs++;  
              }
              if($minefield[$x][$y - 1]){
                 $numBombs++; 
              }
              if($minefield[$x - 1][$y]){
                 $numBombs++; 
              }
          }
          else if($y == 0 && (($x !== 0) && ($x !== 8) )){
              if($minefield[$x + 1][$y]){
                 $numBombs++;  
              }
              if($minefield[$x - 1][$y]){
                 $numBombs++;  
              }
              if($minefield[$x][$y + 1]){
                 $numBombs++; 
              }
          }
          else if($y == 8 && (($x !== 0) && ($x !== 8) )){
              if($minefield[$x + 1][$y]){
                 $numBombs++; 
              }
              if($minefield[$x - 1][$y]){
                 $numBombs++; 
              }
              if($minefield[$x][$y - 1]){
                 $numBombs++; 
              }
          }
          else{
              if($minefield[$x][$y + 1]){
                 $numBombs++; 
              }
              if($minefield[$x][$y - 1]){
                 $numBombs++; 
              }
              if($minefield[$x + 1][$y]){
                 $numBombs++; 
              } 
              if($minefield[$x - 1][$y]){
                 $numBombs++; 
              }
          }
          $arrayNumBombs[$x][$y] = $numBombs;
          
        }                
    }
    
    for($x=0; $x<9; $x++){
        for($y=0; $y<9; $y++){
            $sql = "INSERT INTO `minesweeper` (`xCoordinate`, `yCoordinate`, `GameID`, `hasFlag`, `hasMine`, numMines ) VALUES ('" . ($x + 1) . "', '" . ($y + 1) . "', '" . 1 . "', '" . 0 . "', '" . $minefield[$x][$y] . "', '" . $arrayNumBombs[$x][$y] . "')";
            mysqli_query($conn, $sql);

        }                
    }
    ?>
    <!DOCTYPE html>
    <html id = 'myhtml'>
    <head>
        <title>Minesweeper</title>
        <link rel='stylesheet' type='text/css' href='stylesheets/game.css'>
        <script src='scripts/minesweeper.js'></script>
    </head>
    <body>
        <canvas id = 'board' width='310' height='360'>
            <script>
                //Table that stores what cells have flags
                var flagTable = [
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0]
                ];
                //Table that stores which cells have been clicked
                //This is just used so we don't place a flag over 
                //a cell that has already been clicked
                var clickedTable = [
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0,0]
                ];

                var hasFlag = 0;
                var score = 0;

        //Functions

        //This function is called on a timer and checks to see if "You Lost" is displayed if so it stops
        //the counters and ends the game.
        var bombExploded = false;
        var numDrawn = false;
        
        function checkForBomb(){
            if(bombExploded == false){
                if(document.getElementById('txtHint').innerHTML == "You Lost!"){
                    score = 0;
                    bombExploded = true;
                    clearTimeout(bombCounter);
                    clearTimeout(secondCounter);
                    drawFirstRect();
                    printScore();
                    for (x = 0; x < 9; x++) { 
                        for(y = 0; y < 9; y++){
                            context.fillStyle = 'red';
                            context.beginPath();
                            context.fillRect((x*width)+(padding*x), (y*height)+(y*padding) + boarderHeight, width, height);
                            context.closePath();


                        }
                    }
                }
            }

        }
        function drawFirstRect(){
            if(bombExploded == false){
                context.fillStyle = 'black';
                context.beginPath();
                context.fillRect((boarderHeight-scoreBoxHeight)/2,(boarderHeight-scoreBoxHeight-padding)/2,scoreBoxWidth,scoreBoxHeight);
                context.closePath(); 
            }

        }
        function drawSecondRect(){
            if(bombExploded == false){
                context.beginPath();
                context.fillStyle = 'black';
                context.fillRect(canvasWidth - scoreBoxWidth - ((boarderHeight-scoreBoxHeight-padding)/2),(boarderHeight-scoreBoxHeight-padding)/2,scoreBoxWidth,scoreBoxHeight);
                context.closePath();   
            }

        }
        function printTime(){
            context.fillStyle = 'red';
            context.font = '30px Arial';
            context.fillText(String(clockTime), canvasWidth - scoreBoxWidth - ((boarderHeight-scoreBoxHeight-padding)/2),((boarderHeight-scoreBoxHeight-padding)/2) + scoreBoxHeight);  
        }
        function printScore(){
            context.fillStyle = 'red';
            context.font = '30px Arial';
            context.fillText(String(score), (boarderHeight-scoreBoxHeight)/2,((boarderHeight-scoreBoxHeight-padding)/2) + scoreBoxHeight);
        }
        function drawBoard(){
            if(bombExploded == false){
                for (x = 0; x < 9; x++) { 
                    for(y = 0; y < 9; y++){
                        if(flagTable[x][y] == 0){
                            console.log("hit");
                            context.fillStyle = 'gray';
                            context.beginPath();
                            context.fillRect((x*width)+(padding*x), (y*height)+(y*padding) + boarderHeight, width, height);
                            context.closePath();
                        }
                        else{
                            drawing = new Image();
                            drawing.src = 'img/flag.jpg';
                            drawing.height = 15;
                            drawing.width = 15;
                            drawing.onload = function() {
                                context.drawImage(drawing,((x - 1)*width)+(padding*(x - 1)),((y - 1)*height)+((y - 1)*padding) + boarderHeight);
                            }; 
                        }
                    }
                }
            }

        }
        
        //Draw out the canvas
        var canvas = document.getElementById('board');
        var context = canvas.getContext('2d');
        
        var boarderHeight = 40;
        var canvasWidth = 310;
        var y =0;
        var x = 0;
        var width =30;
        var height =30;
        var padding = 5;
        var score = 0;
        var scoreBoxHeight = 25;
        var scoreBoxWidth = 50;
        var clockTime = 0;
                
function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

        
        //Draw top boarder
        context.fillStyle = 'blue';
        context.beginPath();
        context.fillRect(0,0,canvasWidth,boarderHeight - padding);
        context.closePath();      

        //Draw out the gameboard
        drawBoard();

        //This is the AJAX part of the gameboard,

        var str = '';
        function sendCoordinates(x,y,status){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                  document.getElementById('txtHint').innerHTML = this.responseText;
              }

              str = 'minesweeper.php?x=' + x + '&y=' + y;

          }
          xmlhttp.open('GET',str,true); 
          xmlhttp.open('GET',str,true);
          xmlhttp.send();  
      }
        function getNumBombs(x,y){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                  document.getElementById('numBombs').innerHTML = this.responseText;
              }

              str = 'numBombs.php?x=' + x + '&y=' + y;
             console.log(str);

          }
          xmlhttp.open('GET',str,true); 
          xmlhttp.open('GET',str,true);
          xmlhttp.send(); 
        
          //print number to the screen
          if(numDrawn == false){

            sleep(300).then(() => {
                var numberToDisplay = document.getElementById('numBombs').textContent;
                console.log(numberToDisplay);
                context.fillStyle = 'white';
                context.font = '30px Arial';
                context.fillText(String(numberToDisplay), (x*width)+(padding*x) - width,(y*height)+(y*padding) + boarderHeight - 5, width, height);
                context.closePath();
                numDrawn = true;
            })

          }


      }

        //Event that is triggered when a cell is clicked

        canvas.addEventListener('contextmenu', function (evt) {
            if(bombExploded == false){
                var mousePos = getMousePos(canvas, evt);
                var mouseCell = getMouseCell(mousePos.x,mousePos.y, width, padding,canvas.scrollWidth, canvas.width, boarderHeight);
                context.fillStyle = 'blue';
                if(clickedTable[mouseCell.x-1][mouseCell.y-1] != 1){
                    drawFlag(mouseCell.x, mouseCell.y);
                }
                context.fillRect(((mouseCell.x - 1)*width)+(padding*(mouseCell.x - 1)), ((mouseCell.y - 1)*height)+((mouseCell.y - 1)*padding) + boarderHeight, width, height);
                if(flagTable[mouseCell.x -1][mouseCell.y -1] == 0){
                    flagTable[mouseCell.x -1][mouseCell.y -1] = 1;
                    console.log(flagTable[mouseCell.x -1][mouseCell.y -1]);
                }
                else{
                    flagTable[mouseCell.x -1][mouseCell.y -1] = 0;
                    console.log(flagTable[mouseCell.x -1][mouseCell.y -1]);
                }
                evt.preventDefault();
                return false; 
            }
        }, false);
        
        canvas.addEventListener('click', function (evt) {
            if(bombExploded == false){
                var mousePos = getMousePos(canvas, evt);
                var mouseCell = getMouseCell(mousePos.x,mousePos.y, width, padding,canvas.scrollWidth, canvas.width, boarderHeight);
                context.fillStyle = 'blue';
                score += 10;
                numDrawn = false;
                console.log("Score" + score);
                context.fillRect(((mouseCell.x - 1)*width)+(padding*(mouseCell.x - 1)), ((mouseCell.y - 1)*height)+((mouseCell.y - 1)*padding) + boarderHeight, width, height);
                clickedTable[mouseCell.x-1][mouseCell.y-1] = 1;
                context.fillStyle = 'gray';
                canvas.addEventListener('click', sendCoordinates(mouseCell.x, mouseCell.y, "Normal"));
                console.log ("TEEEEEEEEEEEEEEEST");
                getNumBombs(mouseCell.x, mouseCell.y);
                evt.preventDefault();   
            }
            return false;
        }, false);
        
        //draw black boxes to display score and time on
        drawFirstRect();
        drawSecondRect();
        
        var secondCounter = setInterval(timeCounter, 1000);
        function timeCounter() {
            drawFirstRect();
            drawSecondRect();
            clockTime++;
            printTime();
            printScore();

        }
                
        var bombCounter = setInterval(bombChecker, 10);
        function bombChecker() {
            checkForBomb();
        }
        
        //draw image
        drawing = new Image();
        drawing.src = 'img/small-smile.png';
        drawing.height = 15;
        drawing.width = 15;
        drawing.onload = function() {
            context.drawImage(drawing,(canvasWidth/2)- 15,((boarderHeight-scoreBoxHeight-padding)/2) - padding/2);
        };
        
        //Draw flag
        function drawFlag(x,y){
            if(flagTable[x-1][y-1] == 0){
                drawing = new Image();
                drawing.src = 'img/flag.jpg';
                drawing.height = 15;
                drawing.width = 15;
                drawing.onload = function() {
                    context.drawImage(drawing,((x - 1)*width)+(padding*(x - 1)),((y - 1)*height)+((y - 1)*padding) + boarderHeight);
                }; 
            }
            else{
                console.log("hit");
                context.fillStyle = 'gray';
                context.beginPath();
                context.fillRect((x*width)+(padding*x), (y*height)+(y*padding) + boarderHeight, width, height);
                context.closePath();
            }

        }
        


    </script>
</canvas>
<h1 id = 'txtHint'></h1>
<h1 id = 'numBombs'></h1>

</body>
</html>

<?php $conn->close(); ?>
<?php } ?>
