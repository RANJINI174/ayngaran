<?php

function toCurrency($value, $currency, $fractionDigits = 0)
{
    $acceptedCurencies = ["INR" => "en_US", "VND" => "vi_VN"];

    // if (!in_array($currency, array_keys($acceptedCurencies)))
    //     return $value;

    if (!is_numeric($value))
        return $value;

    $formatter = new NumberFormatter($acceptedCurencies[$currency], NumberFormatter::CURRENCY);
    $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $fractionDigits);
    $formattedNumber = $formatter->format($value);

    return $formattedNumber;
}

 function IND_money_format($money){

            $decimal = (string)($money - floor($money));
            $money = floor($money);
            $length = strlen($money);
            $m = '';
            $money = strrev($money);
            for($i=0;$i<$length;$i++){
                if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                    $m .=',';
                }
                $m .=$money[$i];
            }
            $result = strrev($m);
            $decimal = preg_replace("/0\./i", ".", $decimal);
            $decimal = substr($decimal, 0, 3);
            // if( $decimal != '0'){
            $result = $result.'.00';
            // }
            return $result;
        }
        
        
function rupee_format($num) {
        $explrestunits = "" ;
        if(strlen($num)>3){
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for($i=0; $i<sizeof($expunit); $i++){
                // creates each of the 2's group and adds a comma to the end
                if($i==0)
                {
                    $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                }else{
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash; // writes the final format where $currency is the currency symbol.
    }