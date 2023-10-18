<?php


$stdin = fopen('data.txt', 'r');
do{
    $f = stream_get_line($stdin, 1000000, PHP_EOL);
    if($f!==false){
        $input[] = $f;
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

$R = $input[0] *2;
$N = $input[1];

for($i =2; $i < $N+2; $i++){
    $inputs = explode(' ', $input[$i]);
    $X = $inputs[0];
    $Y = $inputs[1];
    $tab[] = new Point($X, $Y);
}
$max = 0;
for($i = 0; $i < $N; $i++){
    $tabAct = [];
    $tabAct[] = $tab[$i];
    for($j = 0; $j < $N; $j++) {
        if($i != $j){
            if( $tab[$j]->bTabCheckDistance($tabAct, $R)) {
                $tabAct[] = $tab[$j];
            }
        }
    }

    if(count($tabAct) > $max){
        $max = count($tabAct);
    }
}
echo $max;
