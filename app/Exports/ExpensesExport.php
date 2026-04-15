<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Facades\Session;

class ExpensesExport implements FromArray
{
    protected $expenses;

    public function __construct(array $expenses)
    {
        $this->expenses = $expenses;
    }

    public function array(): array
    {
        // Headers add karne ke liye
        $data = [
            [__('general.Category'), __('general.Amount')] // Column Headers
        ];

        foreach ($this->expenses as $expense) {
            // Expense text se values extract karna
            if (preg_match('/(.+): \$(\d+(\.\d+)?)/', $expense[0], $matches)) {
                $data[] = [$matches[1], $matches[2]];
            }
        }

        return $data;
    }
}