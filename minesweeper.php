<!DOCTYPE html>
<html>
<head>
    <title>Minesweeper</title>
    <link rel="stylesheet" type="text/css" href="game.css">
</head>
<body>
    <canvas id = "board" width="310" height="360">
            <script>
        var canvas = document.getElementById("board");
        var context = canvas.getContext("2d")

                
        var x;
        var y;
        var width = 30;
        var height = 30;
        var padding = 5;
        var boarderHeight = 40;
        var canvasWidth = 310;
                
        //Draw top boarder
        context.fillStyle = 'blue';
        context.beginPath();
        context.fillRect(0,0,canvasWidth,boarderHeight - padding);
        context.closePath();
         
                
        //Draw the squares
        for (y = 0; y < 9; y++) { 
            for(x = 0; x < 9; x++){
                context.fillStyle = 'gray';
                context.beginPath();
                context.fillRect((x*30)+(padding*x), (y*30)+(y*padding) + boarderHeight, width, height); 
                context.closePath(); 
            }
        }
        
        var scoreBoxHeight = 25;
        var scoreBoxWidth = 50;
        var clockTime = 0;
        var score = 0
        
        //draw black boxes to display score and time on
        context.fillStyle = 'black';
        context.beginPath();
        context.fillRect((boarderHeight-scoreBoxHeight)/2,(boarderHeight-scoreBoxHeight-padding)/2,scoreBoxWidth,scoreBoxHeight);
        context.closePath();
        
        context.beginPath();
        context.fillRect(canvasWidth - scoreBoxWidth - ((boarderHeight-scoreBoxHeight-padding)/2),(boarderHeight-scoreBoxHeight-padding)/2,scoreBoxWidth,scoreBoxHeight);
        context.closePath();
        
        //print score
        context.fillStyle = 'red';
        context.font = "30px Arial";
        context.fillText(String(clockTime), (boarderHeight-scoreBoxHeight)/2,((boarderHeight-scoreBoxHeight-padding)/2) + scoreBoxHeight);
           
        //print time
        context.fillStyle = 'red';
        context.font = "30px Arial";
        context.fillText(String(clockTime), canvasWidth - scoreBoxWidth - ((boarderHeight-scoreBoxHeight-padding)/2),((boarderHeight-scoreBoxHeight-padding)/2) + scoreBoxHeight);

        //draw image
        drawing = new Image();
        drawing.src = "img/small-smile.png";
        drawing.height = 15;
        drawing.width = 15;
        drawing.onload = function() {
        context.drawImage(drawing,(canvasWidth/2)- 15,((boarderHeight-scoreBoxHeight-padding)/2) - padding/2);
        };
    
    </script>
    </canvas>

</body>
</html>