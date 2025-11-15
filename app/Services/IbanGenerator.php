<?php

namespace App\Services;

use App\Models\Account;

class IbanGenerator
{
    /**
     * Generate a valid Swiss IBAN
     * Format: CH + 2 check digits + 5 bank code + 12 account number
     * Example: CH93 0076 2011 6238 5295 7
     */
    public static function generate(): string
    {
        // Swiss bank code (00767 for Acrevis Bank - fictional)
        $bankCode = '00767';

        // Generate 12 random digits for account number
        $accountNumber = '';
        for ($i = 0; $i < 12; $i++) {
            $accountNumber .= rand(0, 9);
        }

        // Combine bank code and account number
        $bban = $bankCode . $accountNumber;

        // Calculate check digits
        $checkDigits = self::calculateCheckDigits($bban);

        // Construct IBAN
        $iban = 'CH' . $checkDigits . $bban;

        // Ensure uniqueness
        while (Account::where('iban', $iban)->exists()) {
            // If IBAN exists, regenerate
            return self::generate();
        }

        return $iban;
    }

    /**
     * Calculate check digits for IBAN
     */
    private static function calculateCheckDigits(string $bban): string
    {
        // Move country code to end and replace letters with numbers
        // CH -> 2817, then add 00 for check digits placeholder
        $rearranged = $bban . '2817' . '00';

        // Calculate mod 97
        $mod = bcmod($rearranged, '97');

        // Check digit = 98 - mod
        $checkDigits = 98 - intval($mod);

        // Return as 2-digit string
        return str_pad((string)$checkDigits, 2, '0', STR_PAD_LEFT);
    }

    /**
     * Validate an IBAN format
     */
    public static function validate(string $iban): bool
    {
        // Remove spaces
        $iban = str_replace(' ', '', $iban);

        // Check length (Swiss IBAN = 21 characters)
        if (strlen($iban) !== 21) {
            return false;
        }

        // Check if starts with CH
        if (substr($iban, 0, 2) !== 'CH') {
            return false;
        }

        // Extract parts
        $checkDigits = substr($iban, 2, 2);
        $bban = substr($iban, 4);

        // Validate check digits
        $calculatedCheckDigits = self::calculateCheckDigits($bban);

        return $checkDigits === $calculatedCheckDigits;
    }

    /**
     * Format IBAN with spaces
     */
    public static function format(string $iban): string
    {
        // Remove existing spaces
        $iban = str_replace(' ', '', $iban);

        // Add spaces every 4 characters
        return chunk_split($iban, 4, ' ');
    }
}
