<?php
//function for bangla translation of numbers
function banglastring($eng)
	{
	$search  = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
	$replace = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
	$bangla = str_replace($search, $replace, $eng);
	return $bangla;
}
function banglamonthstring($eng)
	{
	$search  = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
	$replace = array('জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর','নভেম্বর','ডিসেম্বর');
	$bangla = str_replace($search, $replace, $eng);
	return $bangla;
}
function optionstring($opt)
    {
    $search  = array('RUNDOWN','UP','DOWN','REST');
	$replace = array('&#8645','&#8593', '&#8595','O');
	$optr = str_replace($search, $replace, $opt);
	return $optr;
    }



function num2bangla($number)
    {
        if (($number < 0) || ($number > 999999999))
        {
            return "নাম্বারটি অতিরিক্ত বড়";
        } elseif (!is_numeric($number))
        {
            return "বৈধ নাম্বার নয়";
        }
        $Kt = floor($number / 10000000); /* Koti */
        $number -= $Kt * 10000000;
        $Gn = floor($number / 100000);  /* lakh  */
        $number -= $Gn * 100000;
        $kn = floor($number / 1000);     /* Thousands (kilo) */
        $number -= $kn * 1000;
        $Hn = floor($number / 100);      /* Hundreds (hecto) */
        $number -= $Hn * 100;
        $Dn = floor($number / 10);       /* Tens (deca) */
        $n = $number % 10;               /* Ones */
        $res = "";
        if ($Kt)
        {
            $res .= num2bangla($Kt) . " কোটি ";
        }
        if ($Gn)
        {
            $res .= num2bangla($Gn) . " লাখ";
        }
        if ($kn)
        {
            $res .= (empty($res) ? "" : " ") .
                num2bangla($kn) . " হাজার";
        }
        if ($Hn)
        {
            $res .= (empty($res) ? "" : " ") .
                num2bangla($Hn) . " শত";
        }
        $hund = ["", "এক", "দুই", "তিন", "চার", "পাঁচ", "ছয়", "সাত", "আট", "নয়", "দশ",
            "এগার", "বার", "তের", "চৌদ্দ", "পনের", "ষোল", "সতের", "আঠার", "ঊনিশ", "বিশ",
            "একোশ", "বাইশ", "তেইশ", "চব্বিশ", "পঁচিশ", "ছাব্বিশ", "সাতাশ", "আঠাশ", "ঊনত্রিশ", "ত্রিশ",
            "একত্রিশ", "বত্রিশ", "তেত্রিশ", "চৌত্রিশ", "পয়ত্রিশ", "ছত্রিশ", "সতত্রিশ", "আটত্রিশ", "ঊনচল্লিশ", "চল্লিশ",
            "একচল্লিশ", "বেয়াল্লিশ", "তেতাল্লিশ", "চোয়াল্লিশ", "পঁয়তাল্লিশ", "ছেচল্লিশ", "সতচল্লিশ", "আটচল্লিশ", "ঊনপঞ্চাশ", "পঞ্চাশ",
            "একান্ন", "বাহান্ন", "তেপান্ন", "চোয়ান্ন", "পঁঞ্চান্ন", "ছাপ্পান্ন", "সাতান্ন", "আটান্ন", "ঊনষাট", "ষাট",
            "একষট্টি", "বাষট্টি", "তেষট্টি", "চৌষট্টি", "পঁয়ষট্টি", "ছেষট্টি", "সতাষট্টি", "আটষট্টি", "ঊনসত্তর", "সত্তর",
            "একাত্তর", "বাহাত্তর", "তেহাত্তর", "চোয়াত্তর", "পঁচাত্তর", "ছিয়াত্তর", "সাতাত্তর", "আটাত্তর", "ঊনআশি", "আশি",
            "একাশি", "বিরাশি", "তিরাশি", "চোরাশি", "পঁচাশি", "ছিয়াশি", "সাতাশি", "অটাশি", "ঊননব্বই", "নব্বই",
            "একানব্বই", "বিরানব্বই", "তিরানব্বই", "চুরানব্বই", "পঁচানব্বই", "ছিয়ানব্বই", "সাতানব্বই", "আটানব্বই", "নিরানব্বই", "একশ"];
        if ($Dn || $n)
        {
            if (!empty($res))
            {
                $res .= " ";
            }
                $res .= $hund[$Dn * 10 + $n];
        }
        if (empty($res))
        {
            $res = "শূন্য";
        }
        return $res;
    }


// PHP code to find the number of days 
// between two given dates 
  
// Function to find the difference  
// between two dates. 
function dateDiffInDays($date1, $date2)  
{ 
    // Calulating the difference in timestamps 
    $diff = strtotime($date2) - strtotime($date1); 
      
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    return abs(round($diff / 86400)); 
}

?>