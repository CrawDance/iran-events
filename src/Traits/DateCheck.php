<?php
/**
 * Developer: Keivan
 * E-mail: me@keiv.ir
 * Date:
 */
namespace CrawDance\IranEvents\Traits;

use Alkoumi\LaravelHijriDate\Hijri;
use Carbon\Carbon;
use CrawDance\IranEvents\Helpers\IranEventsRepository;
use CrawDance\IranEvents\Helpers\JalaliToGregorian;
use CrawDance\IranEvents\IranEventsInterface;

trait DateCheck
{
    public static function Check($date)
    {
        return self::check_in_events($date);
    }

    public function convertToHijri($y, $m, $d)
    {
        $gregorian_date = self::convertToGregorian($y, $m, $d);

        $hijri = Hijri::Date('Y-m-d', $gregorian_date);
        $hijri_d = (int)explode('-', $hijri)[2];
        $hijri_m = (int)explode('-', $hijri)[1];

        return [
            'd' => $hijri_d,
            'm' => $hijri_m
        ];
    }

    public function convertToGregorian($y, $m, $d)
    {
        try {
            $gregorian = JalaliToGregorian::convert($y, $m, $d);
            $gregorian_date = $gregorian[0].'-'.$gregorian[1].'-'.$gregorian[2] ;

            $gre = Carbon::createFromFormat(IranEventsInterface::FULLDATE_STRING_FORMAT, $gregorian_date.' 00:00:00')
                ->addDay(IranEventsInterface::DEFAULT_ADJUST_DAY)->format(IranEventsInterface::DEFAULT_STRING_FORMAT);
            return $gre;

        }catch(\Exceptio $exception){
            return $exception;
        }
    }

    public function check_in_events($date)
    {
        $date = explode('-', $date);

        $persian_d = (int)$date[2];
        $persian_m = (int)$date[1];
        $persian_y = (int)$date[0];

        $hijri_date = self::convertToHijri($persian_y, $persian_m, $persian_d);

        $hijri_d = $hijri_date['d'];
        $hijri_m = $hijri_date['m'];

        $events = IranEventsRepository::getIranEvents();

        foreach ($events as $key => $value)
        {
            if (($value['Day'] == $persian_d && $value['Month'] == $persian_m) || ($value['Day'] == $hijri_d && $value['Month'] == $hijri_m))
            {
                return [
                    'holiday' => true,
                    'type' => ($value['Calendar'] == 'Hijri') ? IranEventsInterface::Hijri_HOLIDDAY_LABEL : IranEventsInterface::PERSIAN_HOLIDDAY_LABEL,
                    'desc' => $value['Title']
                ];
            }
        }

        return [];
    }
}
