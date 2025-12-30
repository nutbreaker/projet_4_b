<?php

namespace tomtroc\utils;

abstract class Utils
{
    /**
     * Checks if a string is empty after trimming whitespace.
     *
     * @param string $file the string to check
     * 
     * @return bool True if the string is empty, false otherwise.
     */
    public static function isEmpty(string $value): bool
    {
        return !isset($value) || !strlen(trim($value));
    }

    /**
     * Sanitizes a string for safe HTML output by decoding any existing HTML 
     * entities and then re-encoding the string to prevent XSS attacks.
     *
     * @param string $value the input string to sanitize
     * @param bool $trimSpaces if true, trims the whitespaces from the result 
     * 
     * @return string the sanitized string safe for HTML output
     */
    public static function sanitize(string $value = "", bool $trimSpaces = true): string
    {
        $encodeValue = htmlentities(html_entity_decode($value));

        if (!$trimSpaces) {
            return $encodeValue;
        }

        return trim($encodeValue);
    }

    /**
     * Returns a human-readable string representing the time elapsed since the 
     * given timestamp.
     *
     * @param int $time the past timestamp to compare with the current time
     * 
     * @return string a string describing the elapsed time
     */
    public static function getTimeAgo(int $time): string
    {
        $diff = time() - $time;

        if ($diff < 1) {
            return "moins d'une seconde";
        }
        $condition = array(
            12 * 30 * 24 * 60 * 60 =>  "année",
            30 * 24 * 60 * 60       =>  "mois",
            24 * 60 * 60            =>  "jour",
            60 * 60                 =>  "heure",
            60                      =>  "minute",
            1                       =>  "seconde",
        );

        foreach ($condition as $secs => $str) {
            $d = $diff / $secs;

            if ($d >= 1) {
                $t = round($d);

                return $t . " " . $str . ($t > 1 ? "s" : "");
            }
        }

        return "";
    }
}
