<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    // Hardcoded data to match calculator.js expectations
    private $products = [
        ['id' => 1, 'slug' => 'kitchen-set', 'name' => 'Kitchen Set', 'icon' => 'countertops', 'min_price' => 2000000],
        ['id' => 2, 'slug' => 'wardrobe', 'name' => 'Lemari & Wardrobe', 'icon' => 'door_sliding', 'min_price' => 2300000],
        ['id' => 3, 'slug' => 'backdrop-tv', 'name' => 'Backdrop TV', 'icon' => 'tv', 'min_price' => 2100000],
        ['id' => 4, 'slug' => 'wallpanel', 'name' => 'Wallpanel', 'icon' => 'dashboard', 'min_price' => 850000],
        ['id' => 5, 'slug' => 'box-elektronik-dapur', 'name' => 'Box Elektronik Dapur', 'icon' => 'kitchen', 'min_price' => 2100000],
    ];

    private $materials = [
        ['id' => 1, 'product_id' => 1, 'name' => 'Multipleks 18mm (HPL)', 'grade' => 'A', 'is_waterproof' => 0, 'is_termite_resistant' => 0, 'base_price' => 2000000],
        ['id' => 2, 'product_id' => 1, 'name' => 'Blockboard 18mm (HPL)', 'grade' => 'B', 'is_waterproof' => 0, 'is_termite_resistant' => 0, 'base_price' => 1800000],
        ['id' => 3, 'product_id' => 1, 'name' => 'PVC Board (Anti Air & Rayap)', 'grade' => 'A', 'is_waterproof' => 1, 'is_termite_resistant' => 1, 'base_price' => 3500000],
        ['id' => 4, 'product_id' => 1, 'name' => 'Aluminium Composite', 'grade' => 'A', 'is_waterproof' => 1, 'is_termite_resistant' => 1, 'base_price' => 4500000],

        ['id' => 5, 'product_id' => 2, 'name' => 'Multipleks 18mm (HPL)', 'grade' => 'A', 'is_waterproof' => 0, 'is_termite_resistant' => 0, 'base_price' => 2300000],
        ['id' => 6, 'product_id' => 2, 'name' => 'Blockboard 18mm (HPL)', 'grade' => 'B', 'is_waterproof' => 0, 'is_termite_resistant' => 0, 'base_price' => 2100000],

        ['id' => 7, 'product_id' => 3, 'name' => 'Multipleks + HPL', 'grade' => 'A', 'is_waterproof' => 0, 'is_termite_resistant' => 0, 'base_price' => 2100000],
        ['id' => 8, 'product_id' => 3, 'name' => 'PVC Board + Marmer', 'grade' => 'A', 'is_waterproof' => 1, 'is_termite_resistant' => 1, 'base_price' => 3500000],

        ['id' => 9, 'product_id' => 4, 'name' => 'WPC Wood Panel', 'grade' => 'A', 'is_waterproof' => 1, 'is_termite_resistant' => 1, 'base_price' => 850000],
        ['id' => 10, 'product_id' => 4, 'name' => 'PVC Marble Sheet', 'grade' => 'B', 'is_waterproof' => 1, 'is_termite_resistant' => 1, 'base_price' => 650000],

        ['id' => 11, 'product_id' => 5, 'name' => 'Blockboard (BB)', 'grade' => 'B', 'is_waterproof' => 0, 'is_termite_resistant' => 0, 'base_price' => 2100000],
        ['id' => 12, 'product_id' => 5, 'name' => 'Multipleks (MP)', 'grade' => 'A', 'is_waterproof' => 0, 'is_termite_resistant' => 0, 'base_price' => 2100000],
    ];

    private $models = [
        ['id' => 1, 'name' => 'Minimalis Modern', 'multiplier' => 1.0],
        ['id' => 2, 'name' => 'Semi Klasik (Profil)', 'multiplier' => 1.2],
        ['id' => 3, 'name' => 'Klasik Mewah', 'multiplier' => 1.4],
        ['id' => 4, 'name' => 'Industrial / Luxury', 'multiplier' => 1.3],
    ];

    private $additionalCosts = [
        ['id' => 1, 'name' => 'Granit / Marmer Top Table', 'description' => 'Untuk Kitchen Set', 'cost_type' => 'fixed', 'cost_value' => 1500000],
        ['id' => 2, 'name' => 'Lampu LED & Strip', 'description' => 'Pencahayaan estetis', 'cost_type' => 'fixed', 'cost_value' => 500000],
        ['id' => 3, 'name' => 'Rak Piring & Sendok Stainless', 'description' => 'Aksesoris Kitchen', 'cost_type' => 'fixed', 'cost_value' => 850000],
        ['id' => 4, 'name' => 'Cermin Bevel Besar', 'description' => 'Untuk Wardrobe/Backdrop', 'cost_type' => 'fixed', 'cost_value' => 1200000],
    ];

    public function init(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'products' => $this->products,
                'materials' => $this->materials, // Initially send all or filter? calculator.js seems to filter by product later or expects empty
                'models' => $this->models,
                'additional_costs' => $this->additionalCosts,
            ]
        ]);
    }

    public function getMaterials(Request $request)
    {
        $productId = $request->input('product_id');
        $materials = array_values(array_filter($this->materials, function ($m) use ($productId) {
            return $m['product_id'] == $productId;
        }));

        return response()->json([
            'success' => true,
            'data' => $materials
        ]);
    }

    public function getPrice(Request $request)
    {
        $productId = $request->input('product_id');
        $materialId = $request->input('material_id');
        $modelId = $request->input('model_id');
        $locationType = $request->input('location_type', 'dalam_kota');

        // Find items
        $material = collect($this->materials)->firstWhere('id', $materialId);
        $model = collect($this->models)->firstWhere('id', $modelId);

        if (!$material) {
            // Fallback to min price of product if material not selected
            $product = collect($this->products)->firstWhere('id', $productId);
            return response()->json(['success' => true, 'price_per_meter' => $product['min_price'] ?? 0]);
        }

        $basePrice = $material['base_price'];
        $multiplier = $model['multiplier'] ?? 1.0;

        $pricePerMeter = $basePrice * $multiplier;

        // Location adjustment
        if ($locationType == 'luar_jabar') {
            $pricePerMeter *= 1.1; // 10% markup for outside Jabar
        }

        return response()->json([
            'success' => true,
            'price_per_meter' => round($pricePerMeter)
        ]);
    }

    public function calculate(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
            'material_id' => 'required',
            'model_id' => 'required',
            'length' => 'required|numeric',
            'height' => 'nullable|numeric',
            'location_type' => 'required',
            'additional_costs' => 'array'
        ]);

        $productId = $data['product_id'];
        $materialId = $data['material_id'];
        $modelId = $data['model_id'];
        $length = $data['length'];
        $height = $data['height'] ?? 0;

        $material = collect($this->materials)->firstWhere('id', $materialId);
        $model = collect($this->models)->firstWhere('id', $modelId);
        $product = collect($this->products)->firstWhere('id', $productId);

        if (!$material) return response()->json(['success' => false, 'error' => 'Material invalid']);

        $basePrice = $material['base_price'];
        $multiplier = $model ? $model['multiplier'] : 1.0;
        $pricePerMeter = $basePrice * $multiplier;

        if ($data['location_type'] == 'luar_jabar') {
            $pricePerMeter *= 1.1;
        }

        // Special calculation for Box Elektronik Dapur (ID 5)
        if ($productId == 5) {
            // Logic: L x H (if L < 1, count as Height only, implying L=1 effectively for min pricing, or specifically user said "tingginya aja")
            // Assuming "tingginya aja" means Area = 1 * Height.
            // If L >= 1, Area = L * Height.
            $effectiveLength = ($length < 1) ? 1 : $length;

            // If height is not provided (should be required in frontend), default to 1 to avoid zero
            $effectiveHeight = $height > 0 ? $height : 1;

            $area = $effectiveLength * $effectiveHeight;
            $subtotal = $pricePerMeter * $area;
        } else {
            // Standard linear meter calculation
            $subtotal = $pricePerMeter * $length;
        }

        // Additional costs
        $addCostTotal = 0;
        if (!empty($data['additional_costs'])) {
            foreach ($data['additional_costs'] as $costId) {
                $cost = collect($this->additionalCosts)->firstWhere('id', $costId);
                if ($cost) {
                    if ($cost['cost_type'] == 'fixed') {
                        $addCostTotal += $cost['cost_value'];
                    } else {
                        $addCostTotal += ($subtotal * $cost['cost_value'] / 100);
                    }
                }
            }
        }

        $shippingLabel = $data['location_type'] == 'dalam_kota' ? 'Gratis (Jabar)' : 'Ditanggung Pembeli';

        // Range logic for "min_total" and "max_total" (approximation for estimate)
        $total = $subtotal + $addCostTotal;
        $minTotal = $total * 0.95;
        $maxTotal = $total * 1.05;

        // Badge determination
        $badge = 'Best Value';
        if ($pricePerMeter < 1500000) $badge = 'Ekonomis';
        if ($pricePerMeter > 3000000) $badge = 'Premium';

        return response()->json([
            'success' => true,
            'data' => [
                'location_label' => $data['location_type'] == 'dalam_kota' ? 'Jawa Barat' : 'Luar Jabar',
                'product' => $product['name'],
                'material' => $material['name'],
                'model' => $model ? $model['name'] : '-',
                'length' => $length,
                'price_per_meter' => $pricePerMeter,
                'subtotal' => $subtotal,
                'shipping_label' => $shippingLabel,
                'additional_costs' => $addCostTotal,
                'min_total' => $minTotal,
                'max_total' => $maxTotal,
                'badge' => $badge,
                'summary' => 'Estimasi ini belum mengikat dan dapat berubah setelah survey lokasi.'
            ]
        ]);
    }
}
