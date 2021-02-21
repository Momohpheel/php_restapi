<?php


error_reporting(0);
class FirstSolution {
    
   
    public $memo = [200][200];
    
    public function soupServings(int $n) {
       
        return $answer =  $n >= 5000 ?  1.0 : $this->getProbability(($n+24)/25, ($n+24)/25);
    }
    public function getProbability(int $a, int $b) {
                
        if ($a <= 0 && $b <= 0) return 0.5;
        if ($a <= 0) return 1;
        if ($b <= 0) return 0;
        if ($this->memo[$a][$b] > 0) return $this->memo[$a][$b];
        $this->memo[$a][$b] = 0.25 * ($this->getProbability($a - 4, $b) + $this->getProbability($a - 3, $b - 1) + $this->getProbability($a - 2, $b - 2) + $this->getProbability($a - 1, $b - 3));
        return $this->memo[$a][$b];
    }
}

$solution = new FirstSolution();
$result =  $solution->soupServings(200);
echo $result. "\n\n";


class SecondSolution{

    public $arr;
    public function findCrossOver($arr, $low, $high, $x) { 

        // x is greater than all 
        if ($arr[$high] <= $x){  
            return $high; 
        }

        // x is smaller than all 
        if ($arr[$low] > $x) {
            return $low; 
        }

        // Find the middle point 
        /* low + (high - low)/2 */
        $mid = ($low + $high)/2;  

        /* If x is same as middle  
        element, then return mid */
        if ($arr[$mid] <= $x and $arr[$mid + 1] > $x) 
            return $mid; 

        /* If x is greater than arr[mid],  
        then either arr[mid + 1] is  
        ceiling of x or ceiling lies  
        in arr[mid+1...high] */
        if($arr[$mid] < $x){
            return findCrossOver($arr, $mid + 1, $high, $x); 
        }

        return findCrossOver($arr, $low, $mid - 1, $x); 
        
    } 

        // This function prints k 
        // closest elements to x in arr[]. 
        // n is the number of elements  
        // in arr[] 
    public function printKclosest($arr, $x, $k, $n) 
    { 

        // Find the crossover point 
        $l = $this->findCrossOver($arr, 0, $n - 1, $x); 

        // Right index to search 
        $r = $l + 1; 

        // To keep track of count of 
        // elements already printed 
        $count = 0;  

        // If x is present in arr[],  
        // then reduce left index 
        // Assumption: all elements  
        // in arr[] are distinct 
        if ($arr[$l] == $x) $l--; 

        // Compare elements on left  
        // and right of crossover 
        // point to find the k  
        // closest elements 
        while ($l >= 0 && $r < $n && $count < $k) 
        { 
            if ($x - $arr[$l] < $arr[$r] - $x) 
            echo $arr[$l--]." "; 
            else
            echo $arr[$r++]." "; 
            $count++; 
        } 

        // If there are no more 
        // elements on right side, 
        // then print left elements 
        while ($count < $k && $l >= 0){
            echo $arr[$l--]." "; 
            $count++; 
        }

        // If there are no more  
        // elements on left side,  
        // then print right elements 
        while ($count < $k and $r < $n){
            echo $arr[$r++]; 
            $count++; 
        }
    } 

         
    
}

$arr = [2, 6, 22, 3, 5, 9, 4,45, 8, 0, 53, 55, 56]; 
$n = count($arr); 
$x = 35; $k = 4; 
$secondSolution = new SecondSolution();
$result2 =  $secondSolution->printKclosest($arr, $x, 4, $n); 
echo $result;
 
?> 