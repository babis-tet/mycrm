<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $results = [
        'success' => 0,
        'skipped' => 0,
        'errors' => [],
    ];


    public function model(array $row)
    {
        if (Customer::where('email', $row['email'])->exists()) {
            $this->results['skipped']++;
            return null;
        }

       try {
            $this->results['success']++;
            return new Customer([
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'activity' => $row['activity'] ?? null,
                'vat' => $row['vat'] ?? null,
                'address' => $row['address'] ?? null,
            ]);
        } catch (\Exception $e) {
            $this->results['errors'][] = [
                'row' => $row,
                'error' => $e->getMessage(),
            ];
        }

        return null;
    }
}
