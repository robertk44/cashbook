<span class="{{ (isset($colored) && $colored == false) ? '' : ($amount >= 0 ? 'text-success' : 'text-danger') }}"
    >{{ number_format($amount, 2, ',', '.') }} €</span>
