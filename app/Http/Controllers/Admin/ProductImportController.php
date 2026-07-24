<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), "r");
        
        $header = fgetcsv($handle, 10000, ",");
        if (!$header) {
            return redirect()->back()->with('error', 'Invalid CSV');
        }

        // Map WooCommerce headers to indexes
        $headerMap = array_flip($header);

        $defaultCategory = Category::firstOrCreate(
            ['slug' => 'uncategorized'],
            ['name' => 'Uncategorized']
        );

        while (($row = fgetcsv($handle, 10000, ",")) !== FALSE) {
            $name = isset($headerMap['Name']) ? $row[$headerMap['Name']] : null;
            if (!$name) continue;

            $sku = isset($headerMap['SKU']) ? $row[$headerMap['SKU']] : null;
            $price = isset($headerMap['Regular price']) && is_numeric($row[$headerMap['Regular price']]) 
                     ? (float)$row[$headerMap['Regular price']] : 0.00;
            $description = isset($headerMap['Description']) ? $row[$headerMap['Description']] : null;
            
            $slug = Str::slug($name);

            $product = Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $defaultCategory->id,
                    'name' => $name,
                    'sku' => $sku,
                    'price' => $price,
                    'description' => $description,
                    'stock_status' => true,
                ]
            );

            // Create/Update SeoMeta
            $product->seoMeta()->updateOrCreate(
                ['seoable_id' => $product->id, 'seoable_type' => Product::class],
                [
                    'meta_title' => $name,
                    'meta_description' => Str::limit(strip_tags((string)$description), 160),
                ]
            );
        }

        fclose($handle);

        return redirect()->back()->with('success', 'Products imported successfully.');
    }
}
