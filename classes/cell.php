<?php  
    class Cell {
        public $x = 0;
        public $y = 0;
        public $width = 30;
        public $height = 30;

        
        function __construct($x,$y) {
            $this->x = $x;
            $this->y = $y;
            $this->width = 30;
            $this->height = 30;
            
        }
    }


?>