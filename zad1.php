<?php

//funckja zwracajaca sume 3 liczb, najblizsza oczekiwanej wartosci podanej jako drugi argument
function NumberInArray($arrayS, $numberX){
    //jezeli wartosc oczekiwana to nie int zwracamy blad
    if(!is_int($numberX)) return $result = ["wynik" => 'zły typ wartosci oczekiwanej'];
    //jezeli pierwszy parametr to nie tablica zwracamy blad
    if(!is_array($arrayS)) return $result = ["wynik" => 'pierwszy parametr funkcji powinien byc tablica'];
    //jezeli jest za malo argumentow w tablicy zwracamy blad
    if(count($arrayS) < 3) return $result = ["wynik" => 'za mało liczb w tablicy'];


    sort($arrayS); //sortujemy rosnaco 
    $closestSum = 1000000000; // zmienna do przechowywania najbliszej sumy

    

    for($i = 0; $i < count($arrayS) - 2; $i++){ // jako pierwsza liczbe uswatiamy najnisza 
        //ustawiamy dwa wzskazniki. Na poczatek wsakzuja na nastepny element tablicy i ostatni
        $firstPointer = $i + 1;
        $secondPointer = count($arrayS) - 1;

        //sprawdzamy wiecej par
        while($firstPointer < $secondPointer){
            //wyliczamy sume aktualnych trzech skaldowych
            $currentSum = $arrayS[$i] + $arrayS[$firstPointer] + $arrayS[$secondPointer];
            //jezeli suma jest rowna naszej oczekiwanej wartosci to zwracamy tablice wynikowa
            if($currentSum == $numberX){
                return $result = [
                    "wynik" => $currentSum,
                    "liczaPierwsza" =>$arrayS[$i],
                    "liczbaDruga" =>$arrayS[$firstPointer],
                    "liczbaTrzecia" =>$arrayS[$secondPointer]
                ];
            }

            //jezeli aktualna suma jest blizsza niz aktualnie ustawiona najblizsza suma to ona satje sie nasza nowa najblizsza suma
            if (abs($numberX - $currentSum) < abs($numberX - $closestSum)) {
                $result = [
                    "wynik" => $currentSum,
                    "liczaPierwsza" =>$arrayS[$i],
                    "liczbaDruga" =>$arrayS[$firstPointer],
                    "liczbaTrzecia" =>$arrayS[$secondPointer]
                ];
            }
            //jezeli suma jest wieksza niz nasza oczekiwana wartosc to zmniejszamy wartosc naszego drugiego wskaznika
            //dzieki czemu otrzymamy mniejsza sume
            if ($currentSum > $numberX) {
                $secondPointer--;
            } else { //w przpadku jezeli suma jest mniejsza niz wartosc oczekiwana, zwiekszamy pierwszy wskaznik 
                $firstPointer++;
            }
        }
    }
    return $result; //zwracamy nasza ostateczna najblizsza sume 
}

$tab = [-1, 2, 1, -4];
$numberX = 1;
$result = NumberInArray($tab, $numberX);
print "tablica: " .  implode(", ", $tab) . " i licza X:" . $numberX . "<br>" . "Najbliższa suma: " . $result['wynik'] . "<br>";
if(count($result) > 1) print "Szukane liczby to: " . $result["liczaPierwsza"] . ", " .$result["liczbaDruga"] . " i " . $result["liczbaTrzecia"];

?> 