        <?php
        include("classes/cell.php");
        ?>
<!DOCTYPE html>
<html>
<head>
    <title>Minesweeper</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/game.css">
    <script src="scripts/minesweeper.js"></script>
</head>
<body>
    <canvas id = "board" width="310" height="360">
        
        
        
        <script>
            
        var canvas = document.getElementById("board");
        var context = canvas.getContext("2d");
        
        //Add all the cells into an array to keep track of
        <?php 
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
            
            for($x = 0; $x<9; $x++){
                for($y = 0; $y<9; $y++){
                    $table[$y][$x] = new Cell($x,$y);
                    $text = json_encode($table[$y][$x]);
                    $data = json_decode($text);
                    //echo $table[$y][$x]->x . ',' . $table[$y][$x]->y;
                    echo $data->x;
                } 
            }
        
        ?>
            
        var boarderHeight = 40;
        var canvasWidth = 310;
        var y = <?php echo $data->y ?>;
        var x = <?php echo $data->x ?>;
        var width = <?php echo $data->width ?>;
        var height = <?php echo $data->height ?>;
        var padding = 5;
        
        //Draw top boarder
        context.fillStyle = 'blue';
        context.beginPath();
        context.fillRect(0,0,canvasWidth,boarderHeight - padding);
        context.closePath();
            
        function drawFirstRect(){
            context.fillStyle = 'black';
            context.beginPath();
            context.fillRect((boarderHeight-scoreBoxHeight)/2,(boarderHeight-scoreBoxHeight-padding)/2,scoreBoxWidth,scoreBoxHeight);
            context.closePath();
        }
        function drawSecondRect(){
            context.beginPath();
            context.fillStyle = 'black';
            context.fillRect(canvasWidth - scoreBoxWidth - ((boarderHeight-scoreBoxHeight-padding)/2),(boarderHeight-scoreBoxHeight-padding)/2,scoreBoxWidth,scoreBoxHeight);
            context.closePath();
        }
        function printTime(){
            context.fillStyle = 'red';
            context.font = "30px Arial";
            context.fillText(String(clockTime), canvasWidth - scoreBoxWidth - ((boarderHeight-scoreBoxHeight-padding)/2),((boarderHeight-scoreBoxHeight-padding)/2) + scoreBoxHeight);  

        }
        
         
                
        //Draw the squares
        for (y = 0; y < 9; y++) { 
            for(x = 0; x < 9; x++){
                context.fillStyle = 'gray';
                context.beginPath();
                context.fillRect((x*width)+(padding*x), (y*height)+(y*padding) + boarderHeight, width, height);
                context.closePath(); 
            }
        }
        
        //Event that is triggered when a cell is clicked
        canvas.addEventListener('contextmenu', function (evt) {
        var mousePos = getMousePos(canvas, evt);
        var mouseCell = getMouseCell(mousePos.x,mousePos.y, width, padding,canvas.scrollWidth, canvas.width, boarderHeight);
        context.fillStyle = 'red';
        context.fillRect(((mouseCell.x - 1)*width)+(padding*(mouseCell.x - 1)), ((mouseCell.y - 1)*height)+((mouseCell.y - 1)*padding) + boarderHeight, width, height);
        context.fillStyle = 'gray';
        evt.preventDefault();
        return false;
        }, false);
            
        var scoreBoxHeight = 25;
        var scoreBoxWidth = 50;
        var clockTime = 0;
        var score = 0;
            
        
        //draw black boxes to display score and time on
        drawFirstRect();
        drawSecondRect();

        

        
        //print score
        context.fillStyle = 'red';
        context.font = "30px Arial";
        context.fillText(String(clockTime), (boarderHeight-scoreBoxHeight)/2,((boarderHeight-scoreBoxHeight-padding)/2) + scoreBoxHeight);
           
        //print time
            
        
        var secondCounter = setInterval(timeCounter, 1000);
        function timeCounter() {
            drawSecondRect();
            clockTime++;
            printTime();

        }
        
        //draw image
        drawing = new Image();
        drawing.src = "small-smile.png";
        drawing.height = 15;
        drawing.width = 15;
        drawing.onload = function() {
        context.drawImage(drawing,(canvasWidth/2)- 15,((boarderHeight-scoreBoxHeight-padding)/2) - padding/2);
        };
     
    </script>
    </canvas>

</body>
</html>