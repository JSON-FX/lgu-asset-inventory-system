<?php

namespace App\Exports;
use App\Models\Property;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PropertiesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Property::with(['office', 'category', 'employee', 'status'])->get()->map(function ($property) {
            return [
                'ID' => $property->id,
                'Property No.' => $property->property_number,
                'Description' => $property->description,
                'Serial No.' => $property->serial_number,
                'Office' => $property->office->office_name,
                'Category' => $property->category->category_name,
                'Date of Purchase' => $property->date_purchase,
                'Accountable Person' => $property->employee->employee_name,
                'Acquisition Cost' => $property->acquisition_cost,
                'Status' => $property->status->status_name,
                'Inventory Remarks' => $property->inventory_remarks,
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Property No.',
            'Description',
            'Serial No.',
            'Office',
            'Category',
            'Date of Purchase',
            'Accountable Person',
            'Acquisition Cost',
            'Status',
            'Inventory Remarks',
        ];
    }
}
