<?php
$frequecy_list = ['E', 'T', 'A', 'O', 'I', 'N', 'S', 'H', 'R', 'D', 'L', 'C', 'U', 'M', 'W', 'F', 'G', 'Y', 'P', 'B', 'V', 'K', 'J', 'X', 'Q', 'Z'];
$original_text = "Yh wtx knkkfa, pfqzfkta fqyf, mbot ufphs xdffitsq dfafofkz qk ftkfkf fpakfkf. Yhf pfaywfhf y npffjfpq, fkaqf krsf mfy pfkfqjfpq whf sfayw qk jfpwfkfa pqyf kfqya ypafo qk. Ckh yfqt fqfa yfkpft, mfafofjq yk mfy sfqayfa yf pfayw dqkpfofqj yfafo kfhf nfoq wqfqjy mfp ftsfo nqfa jfo qk kfpta qktjfm. Yhf ftkfa kfxwf, pfayfyk fq npfaokfa wfafo yfka fqfa pqkp, fqaiq fafo pqklfqjy whf y fqfjtfa jfhf nq wfpkfqj, fa yf pfjt wfkfkf's nfaf kfqftyfota fqktq yfkt wfpaokfqj pqktafqjy.";
$encryted_text = preg_replace("/[^a-zA-Z]+/", "", strtoupper($original_text));
$to_array = str_split($encryted_text);

function insert_sort(&$text_letter_freq, &$counts, $key, $value){
    if(!count($text_letter_freq)==0){
        print(count($counts));
        for($i=0; $i < count($counts); $i++){
            if($value>$counts[$i]){
                array_splice($text_letter_freq, $i, 0, $key);
                array_splice($counts, $i, 0, $value);
                return;
            } 
        }
    }
    $text_letter_freq[]=$key;
    $counts[]=$value;
    
}

function is_checked(&$checked, $key){
    foreach($checked as $checker){
        if($checker==$key){
            return True;
        }
    }
    $checked[]=$key;
    return False;
}

function count_freq($to_array, $key){
    $count=0;
    foreach($to_array as $character){
        if($character==$key){
            $count+=1;
        }
    }
    return $count;
}


function main($frequecy_list, $original_text, $encryted_text, $to_array){
    $text_letter_freq = [];
    $counts=[];
    $checked = [];

    $ciphered_text = strtoupper($original_text);
    $decrypted_text = [];

    foreach($to_array as $character){
        if(!is_checked($checked, $character)){
            // print_r($text_letter_freq);
            // print_r($counts);
            insert_sort($text_letter_freq, $counts, $character, count_freq($to_array, $character));
        } 
    }

    $temp = str_split($ciphered_text);
    for($i=0 ; $i < count($temp); $i++){
        $decrypted_text[]=$frequecy_list[array_search($temp[$i], $text_letter_freq)];
        // print_r($decrypted_text);
    }

    return $decrypted_text;
}

print(implode('', main($frequecy_list, $original_text, $encryted_text, $to_array)));
//need to fix insert_sort function to account for commas, whitespaces, and periods