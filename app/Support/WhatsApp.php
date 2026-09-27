<?php

namespace App\Support;

class WhatsApp
{
    public const EGYPT = '20';
    public const SAUDI_ARABIA = '966';

    /**
     * Turn a number as typed in the dashboard ("01111778114", "+20 111 177 8114",
     * "0106… - 0100…") into the format wa.me needs: digits only, with a country code.
     */
    public static function number(?string $raw, string $countryCode): ?string
    {
        $digits = preg_replace('/\D/', '', (string) static::firstPart($raw));

        if (strlen($digits) < 7) {
            return null;
        }

        if (str_starts_with($digits, '00')) {
            return substr($digits, 2);
        }

        // local format (01111778114) needs the country code instead of the leading zero
        if (str_starts_with($digits, '0')) {
            return $countryCode . ltrim($digits, '0');
        }

        return $digits;
    }

    /**
     * A settings field sometimes holds more than one number ("0106… - 0100…", "0106, 0100"),
     * so keep the first one. Separators inside a number ("+20 111 177 8114") are left alone.
     */
    public static function firstPart(?string $raw): ?string
    {
        $raw = trim((string) $raw);

        if ($raw === '') {
            return null;
        }

        return trim(preg_split('/\s*[,\/|]\s*|\s+[-–]\s+|\s{2,}/u', $raw)[0]);
    }

    /** Full wa.me link, or null when no usable number was set. */
    public static function link(?string $raw, string $countryCode, ?string $message = null): ?string
    {
        $number = static::number($raw, $countryCode);

        if (! $number) {
            return null;
        }

        return 'https://wa.me/' . $number . ($message ? '?text=' . urlencode($message) : '');
    }
}
