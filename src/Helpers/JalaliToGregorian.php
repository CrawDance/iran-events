<?php
/**
 * Developer: Keivan
 * E-mail: me@keiv.ir
 * Date:
 */

namespace CrawDance\IranEvents\Helpers;


class JalaliToGregorian
{
    public static function convert($j_y, $j_m, $j_d, $mod = '')
    {
        $j_y = self::tr_num($j_y);
        $j_m = self::tr_num($j_m);
        $j_d = self::tr_num($j_d);
        $d_4 = ($j_y + 1) % 4;
        $doy_j = ($j_m < 7) ? (($j_m - 1) * 31) + $j_d : (($j_m - 7) * 30) + $j_d + 186;
        $d_33 = (int)((($j_y - 55) % 132) * .0305);
        $a = ($d_33 != 3 and $d_4 <= $d_33) ? 287 : 286;
        $b = (($d_33 == 1 or $d_33 == 2) and ($d_33 == $d_4 or $d_4 == 1)) ? 78 : (($d_33 == 3 and $d_4 == 0) ? 80 : 79);
        if ((int)(($j_y - 19) / 63) == 20) {
            $a--;
            $b++;
        }
        if ($doy_j <= $a) {
            $gy = $j_y + 621;
            $gd = $doy_j + $b;
        } else {
            $gy = $j_y + 622;
            $gd = $doy_j - $a;
        }
        foreach (array(0, 31, ($gy % 4 == 0) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31) as $gm => $v) {
            if ($gd <= $v) break;
            $gd -= $v;
        }
        return ($mod == '') ? array($gy, $gm, $gd) : $gy . $mod . $gm . $mod . $gd;
    }

    public static function tr_num($str,$mod='en',$mf='٫'){
        $num_a=array('0','1','2','3','4','5','6','7','8','9','.');
        $key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',$mf);
        return($mod=='fa')?str_replace($num_a,$key_a,$str):str_replace($key_a,$num_a,$str);
    }
}
