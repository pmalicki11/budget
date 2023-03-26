<?php

namespace App;

enum ExpenseType: string
{
    case COMMUNICATION = 'communication';
    case INSURANCE = 'insurance';
    case ACCOMMODATION = 'accommodation';
    case ENERGY = 'energy';
    case INSTALLMENT = 'installment';
    case ENTERTAINMENT = 'entertainment';

    public static function color(string $type): string
    {
        return match ($type) {
            self::COMMUNICATION->value => 'success',
            self::INSURANCE->value => 'info',
            self::ACCOMMODATION->value => 'warning',
            self::ENERGY->value => 'danger',
            self::INSTALLMENT->value => 'secondary',
            self::ENTERTAINMENT->value => 'primary',
            default => 'light'
        };
    }
}
