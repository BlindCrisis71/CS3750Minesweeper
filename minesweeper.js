        function getMousePos(canvas, evt) {
            var rect = canvas.getBoundingClientRect();
            return {
                x: evt.clientX - rect.left,
                y: evt.clientY - rect.top
            };
        }
        
        function getMouseCell(x,y,width, padding) {
            var cellX;
            var cellY;
            
            console.log((width * 4) + (padding * 3));
            
            //check for location of x click
            if(x<width){
               cellX = 1;             
            }
            else if(x<((width * 2) + (padding * 1)) * (canvas.scrollWidth/canvas.width)){
               cellX = 2;             
            }
            else if(x<((width * 3) + (padding * 2))* (canvas.scrollWidth/canvas.width)){
               cellX = 3;
            }
            else if(x<((width * 4) + (padding * 3))* (canvas.scrollWidth/canvas.width)){
               cellX = 4;             
            }
            else if(x<((width * 5) + (padding * 4))* (canvas.scrollWidth/canvas.width)){
               cellX = 5;             
            }
            else if(x<((width * 6) + (padding * 5))* (canvas.scrollWidth/canvas.width)){
               cellX = 6;             
            }
            else if(x<((width * 7) + (padding * 6))* (canvas.scrollWidth/canvas.width)){
               cellX = 7;             
            }
            else if(x<((width * 8) + (padding * 7))* (canvas.scrollWidth/canvas.width)){
               cellX = 8;             
            }
            else if(x<((width * 9) + (padding * 8))* (canvas.scrollWidth/canvas.width)){
               cellX = 9;             
            }
            else{
                cellX = -1;
            }
            //check for location of y click
            console.log(((boarderHeight + padding) + (width))* (canvas.scrollWidth/canvas.width));
            if(y<25){
               cellY = -1;             
            }
            else if(y< (((boarderHeight + padding) + (width))* (canvas.scrollWidth/canvas.width))){
               cellY = 1;             
            }
            else if(y< (((boarderHeight + (padding * 2)) + (width * 2))* (canvas.scrollHeight/canvas.height))){
               cellY = 2;             
            }
            else if(y< (((boarderHeight + (padding * 3)) + (width * 3))* (canvas.scrollHeight/canvas.height))){
               cellY = 3;             
            }
            else if(y< (((boarderHeight + (padding * 4)) + (width * 4))* (canvas.scrollHeight/canvas.height))){
               cellY = 4;             
            }
            else if(y< (((boarderHeight + (padding * 5)) + (width * 5))* (canvas.scrollHeight/canvas.height))){
               cellY = 5;             
            }
            else if(y< (((boarderHeight + (padding * 6)) + (width * 6))* (canvas.scrollHeight/canvas.height))){
               cellY = 6;             
            }
            else if(y< (((boarderHeight + (padding * 7)) + (width * 7))* (canvas.scrollHeight/canvas.height))){
               cellY = 7;             
            }
            else if(y< (((boarderHeight + (padding * 8)) + (width * 8))* (canvas.scrollHeight/canvas.height))){
               cellY = 8;             
            }
            else if(y<(((25 + (padding * 9)) + (width * 9))* (canvas.scrollHeight/canvas.height))){
               cellY = 9;             
            }
            else{
                cellY = 0;
            }
            
            return {
                x: cellX,
                y: cellY
            };
        }