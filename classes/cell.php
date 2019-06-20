<?php  
    class Cell {
        public $x = 0;
        public $y = 0;
        public $width = 30;
        public $height = 30;
        public $hasFlag = 0;

        
        function __construct($x,$y,$hasFlag) {
            $this->x = $x;
            $this->y = $y;
            $this->hasFlag = $hasFlag;
            $this->width = 30;
            $this->height = 30;
            
        }
    }


?>