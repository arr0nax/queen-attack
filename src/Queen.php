<?php

    class Game {
        public $blackKing;
        public $blackQueen;
        public $blackBishop1;
        public $blackBishop2;
        public $blackKnight1;
        public $blackKnight2;
        public $blackRook1;
        public $blackRook2;
        public $whiteKing;
        public $whiteQueen;
        public $whiteBishop1;
        public $whiteBishop2;
        public $whiteKnight1;
        public $whiteKnight2;
        public $whiteRook1;
        public $whiteRook2;


        function __construct() {
            $this->blackKing = new King(1,8);
            $this->blackQueen = new Queen(1,7);
            $this->blackBishop1 = new Bishop(1,6);
            $this->blackBishop2 = new Bishop(1,5);
            $this->blackKnight1 = new Knight(1,4);
            $this->blackKnight2 = new Knight(1,3);
            $this->blackRook1 = new Rook(1,2);
            $this->blackRook2 = new Rook(1,1);
            $this->whiteKing = new King(8,8);
            $this->whiteQueen = new Queen(8,7);
            $this->whiteBishop1 = new Bishop(8,6);
            $this->whiteBishop2 = new Bishop(8,5);
            $this->whiteKnight1 = new Knight(8,4);
            $this->whiteKnight2 = new Knight(8,3);
            $this->whiteRook1 = new Rook(8,2);
            $this->whiteRook2 = new Rook(8,1);
        }

        // function jsonSerialize()
        // {
        //   return [
        //     'blackKing' => $this->blackKing,
        //     'active' => $this->active
        //   ];
        // }



        function selectPiece($activeX, $activeY)
        {
            foreach ($this as $piece) {
                if ($piece->xCoord == $activeX && $piece->yCoord == $activeY) {
                    if ($piece->active)
                    {
                        $piece->active = false;
                    }
                    else
                    {
                        $piece->active = true;
                    }
                }
            }
        }

        function movePiece($activeX, $activeY)
        {
            foreach ($this as $piece) {
                if ($piece->active == true && $piece->canAttack($activeX, $activeY)) {
                    $piece->xCoord = $activeX;
                    $piece->yCoord = $activeY;
                }
            }
        }
    }

    class Piece implements JsonSerializable
    {
        public $xCoord;
        public $yCoord;
        public $active;

        function __construct($xCoord,$yCoord) {
            $this->xCoord = $xCoord;
            $this->yCoord = $yCoord;
            $this->active = false;
        }

        function jsonSerialize()
        {
          return ['xCoord' => $this->xCoord, 'yCoord' => $this->yCoord, 'active' => $this->active];
        }

        function slope($targetXCoord, $targetYCoord) {
            $xSlope = $this->xCoord - $targetXCoord;
            $ySlope = $this->yCoord - $targetYCoord;
            if ($ySlope == 0) {
                return false;
            }
            $slope = abs($xSlope/$ySlope);
            return $slope;
        }

        function set_coords($xCoord, $yCoord) {
          $this->xCoord = $xCoord;
          $this->yCoord = $yCoord;
        }

        function get_coords() {
          return ['xCoord' => $this->xCoord, 'yCoord' => $this->yCoord];
        }

        function self_attack($targetXCoord, $targetYCoord) {
            if ($this->xCoord == $targetXCoord && $this->yCoord == $targetYCoord) {
                return true;
            }
        }
    }


    class Queen extends Piece
    {
        function canAttack($targetXCoord, $targetYCoord) {
            if($this->self_attack($targetXCoord, $targetYCoord)) {
                return false;
            }
            if ($this->xCoord == $targetXCoord) {
                return true;
            } elseif ($this->yCoord == $targetYCoord) {
                return true;
            } elseif ($this->slope($targetXCoord, $targetYCoord) == 1) {
                return true;
            }
        }
    }


    class Knight extends Piece
    {
        function canAttack($targetXCoord, $targetYCoord) {
            if($this->self_attack($targetXCoord, $targetYCoord)) {
                return false;
            }
            if (abs($this->xCoord - $targetXCoord) == 2 || abs($this->yCoord - $targetYCoord) == 2) {
                if (abs($this->xCoord - $targetXCoord) == 1 || abs($this->yCoord - $targetYCoord) == 1) {
                    return true;
                }
            }
        }
    }

    class Rook extends Piece
    {
        function canAttack($targetXCoord, $targetYCoord)
        {
            if($this->self_attack($targetXCoord, $targetYCoord)) {
                return false;
            }
            if ($this->xCoord == $targetXCoord) {
                return true;
            } elseif ($this->yCoord == $targetYCoord) {
                return true;
            }
        }
    }

    class Bishop extends Piece
    {
        function canAttack($targetXCoord, $targetYCoord)
        {
            if($this->self_attack($targetXCoord, $targetYCoord)) {
                return false;
            }
            if ($this->slope($targetXCoord, $targetYCoord) == 1) {
                return true;
            }
        }
    }

    class King extends Piece
    {
        function canAttack($targetXCoord, $targetYCoord)
        {
            if($this->self_attack($targetXCoord, $targetYCoord)) {
                return false;
            }
            if (abs($this->xCoord - $targetXCoord) <= 1 && abs($this->yCoord - $targetYCoord) <= 1) {
                return true;
            }
        }
    }

?>
