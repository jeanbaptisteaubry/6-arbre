<?php
$stdin = fopen('data.txt', 'r');

$tabIn = stream_get_line($stdin, 1000000, PHP_EOL);

list($W, $H) = explode(' ', $tabIn);
$S = stream_get_line($stdin, 1000000, PHP_EOL);
$N = stream_get_line($stdin, 1000000, PHP_EOL);

$Foret = [];
$ScoreCase = [];
$altitudeCase = [];

for($i = 0; $i< $W; $i++)
{
    $Foret[$i] = [];
    $ScoreCase[$i] = [];
    $altitudeCase[$i] = [];

    for($j = 0; $j = $H; $j++)
    {
        $Foret[$i][$j] = 0;
        $ScoreCase[$i][$j] = 0;
        $altitudeCase[$i][$j] = 0;
    }
}

do{
    $f = stream_get_line(STDIN, 1000000, PHP_EOL);
    if($f!==false){
        list($X, $Y, $H) = explode(' ', $f);
        $Foret[$X][$Y] = $H;
    }
}while($f!==false);

class Point {
    public int $x;
    public int $y;

    public function __construct(int $x, int $y){
        $this->x = $x;
        $this->y = $y;
    }

    public function distanceCarre(Point $p): int{
        return ($this->x - $p->x) *  ($this->x - $p->x) + ($this->y - $p->y)*($this->y - $p->y);
    }



    public function bCheckDistance(int $R):bool {
        return $this->x*$this->x + $this->y*$this->y <= $R*$R;
    }

    public function bTabCheckDistance(array $tabPoint, int $R): bool{
        $R2 = $R*$R;
        foreach($tabPoint as $point){
            if($this->distanceCarre($point) > $R2){
                return false;
            }
        }
        return true;
    }

    public function compare(Point $pt):bool{
        return $this->x == $pt->x && $this->y == $pt->y;
    }

}

array_push($tabPoint, new Point(0,0));
$altitudeCase[$i][$j] = $S;
while(count($tabPoint) > 0){
    $point = array_pop($tabPoint);
    $ScoreCase[$point->x][$point->y] = 1;
    $tabVoisin = [];
    if($point->x > 0){
        $tabVoisin[] = new Point($point->x-1, $point->y);
    }
    if($point->x < $W-1){
        $tabVoisin[] = new Point($point->x+1, $point->y);
    }
    if($point->y > 0){
        $tabVoisin[] = new Point($point->x, $point->y-1);
    }
    if($point->y < $H-1){
        $tabVoisin[] = new Point($point->x, $point->y+1);
    }
    foreach($tabVoisin as $voisin){
        if($Foret[$voisin->x][$voisin->y] > $Foret[$point->x][$point->y] && $ScoreCase[$voisin->x][$voisin->y] == 0){
            array_push($tabPoint, $voisin);
        }
    }
}