<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function showForm()
    {
        return view('import.form');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls|max:5120'
        ]);

        try {
            $file = $request->file('file');
            $data = Excel::toArray([], $file)[0];

            $imported = 0;
            $duplicates = 0;
            $failed = 0;

            // Get headers from first row
            $headers = array_shift($data);
            $headerMap = $this->mapHeaders($headers);

            foreach ($data as $row) {
                try {
                    // Map row data based on headers
                    $business = $this->mapRowData($row, $headerMap);

                    if (empty($business['business_name']) && empty($business['mobile_no'])) {
                        $failed++;
                        continue;
                    }

                    // Generate duplicate hash
                    $business['duplicate_hash'] = Business::generateDuplicateHash(
                        $business['business_name'] ?? '',
                        $business['area'] ?? '',
                        $business['city'] ?? '',
                        $business['address'] ?? ''
                    );

                    // Check if duplicate exists
                    $existingBusiness = Business::where('duplicate_hash', $business['duplicate_hash'])->first();
                    
                    if ($existingBusiness) {
                        $duplicates++;
                        $business['is_duplicate'] = true;
                        $business['master_id'] = $existingBusiness->id;
                    }

                    // Check if incomplete
                    $tempModel = new Business($business);
                    $business['is_incomplete'] = $tempModel->checkIfIncomplete();

                    Business::create($business);
                    $imported++;
                } catch (\Exception $e) {
                    $failed++;
                    continue;
                }
            }

            return back()->with([
                'success' => "Import completed! Imported: $imported, Duplicates: $duplicates, Failed: $failed"
            ]);
        } catch (\Exception $e) {
            return back()->with(['error' => 'Import failed: ' . $e->getMessage()])->withInput();
        }
    }

    private function mapHeaders($headers)
    {
        $headerLower = array_map('strtolower', $headers);
        $mapping = [];

        $fieldMapping = [
            'business_name' => ['business name', 'business_name', 'name', 'business'],
            'area' => ['area'],
            'city' => ['city', 'location'],
            'mobile_no' => ['mobile', 'mobile_no', 'phone', 'mobile number'],
            'category' => ['category', 'category_name'],
            'sub_category' => ['sub_category', 'subcategory', 'sub-category'],
            'address' => ['address', 'full address']
        ];

        foreach ($fieldMapping as $field => $aliases) {
            foreach ($aliases as $alias) {
                if (($key = array_search($alias, $headerLower)) !== false) {
                    $mapping[$field] = $key;
                    break;
                }
            }
        }

        return $mapping;
    }

    private function mapRowData($row, $headerMap)
    {
        $business = [];

        foreach ($headerMap as $field => $columnIndex) {
            $business[$field] = $row[$columnIndex] ?? null;
        }

        return $business;
    }
}
