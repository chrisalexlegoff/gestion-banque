<?php
class DateHelper
{
    public CONST DATE_FORMAT = "d-m-Y";

    public static function toDateTime(string $dateString) : DateTime
    {
        return self::dateFromFormat(self::DATE_FORMAT, $dateString);
    }

    private static function dateFromFormat(string $dateAsString, string $dateFormat): ?DateTime
    {
        $date = \DateTime::createFromFormat($dateAsString, $dateFormat);
        if (false === $date) {
            return NULL;
        }
        list('warning_count' => $warning_count, 'error_count' => $error_count) = $date->getLastErrors();
        if (0 < $warning_count + $error_count) {
            return NULL;
        }
        return $date;
    }
}
