<?php

namespace App\Traits;

use NumberFormatter;

trait WithCurrencyFormatter
{
    public function formatCurrency($value): string
    {
        // $formatter = new NumberFormatter('es_ES', NumberFormatter::CURRENCY);
        $formatter = new NumberFormatter(config('app.locale', 'es_ES'), NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($value, 'EUR');
    }
}
