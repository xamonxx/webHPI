<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Remove every database table that belongs only to the deleted Calculator feature.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        foreach ($this->calculatorTables() as $table) {
            Schema::dropIfExists($table);
        }

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Calculator has been removed from the application, so rollback does not recreate
     * retired business tables with obsolete behavior.
     */
    public function down(): void
    {
        //
    }

    /**
     * @return array<int, string>
     */
    private function calculatorTables(): array
    {
        return [
            'calculator_estimates',
            'calculator_prices',
            'calculator_product_materials',
            'calculator_shipping',
            'calculator_additional_costs',
            'calculator_materials',
            'calculator_models',
            'calculator_products',
            'calculator_results',
            'calculator_histories',
            'calculator_settings',
            'calculators',
            'calculations',
            'calculation_logs',
            'kalkulator',
            'riwayat_kalkulator',
        ];
    }
};
