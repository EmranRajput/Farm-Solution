<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expensesheet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ranch_id');
            $table->string('variety')->nullable();
            $table->unsignedBigInteger('block_id');
            $table->float('total_acre', 8, 2);
            $table->float('summer_prune', 8, 2)->nullable();
            $table->float('ground_prune', 8, 2)->nullable();
            $table->float('alpha_prune', 8, 2)->nullable();
            $table->float('platform_prune', 8, 2)->nullable();
            $table->float('ladder_prune', 8, 2)->nullable();
            $table->float('pollen_prune', 8, 2)->nullable();
            $table->float('suckering', 8, 2)->nullable();
            $table->float('raking', 8, 2)->nullable();
            $table->float('skirt_prune', 8, 2)->nullable();
            $table->float('ground_thin', 8, 2)->nullable();
            $table->float('alpha_thin', 8, 2)->nullable();
            $table->float('platform_thin', 8, 2)->nullable();
            $table->float('ladder_thin', 8, 2)->nullable();
            $table->float('pollen_thin', 8, 2)->nullable();
            $table->float('ground_pick', 8, 2)->nullable();
            $table->float('alpha_pick', 8, 2)->nullable();
            $table->float('platform_pick', 8, 2)->nullable();
            $table->float('ladder_pick', 8, 2)->nullable();
            $table->float('pollen_pick', 8, 2)->nullable();
            $table->float('tractor_driver_ick', 8, 2)->nullable();
            $table->float('planting', 8, 2)->nullable();
            $table->float('grafting', 8, 2)->nullable();
            $table->float('paint_graft', 8, 2)->nullable();
            $table->float('collect_graft_wood', 8, 2)->nullable();
            $table->float('install_trellis', 8, 2)->nullable();
            $table->float('remove_trellis', 8, 2)->nullable();
            $table->float('roots', 8, 2)->nullable();
            $table->float('install_hose', 8, 2)->nullable();
            $table->float('remove_hose', 8, 2)->nullable();
            $table->float('put_carton', 8, 2)->nullable();
            $table->float('remove_carton', 8, 2)->nullable();
            $table->float('training', 8, 2)->nullable();
            $table->float('tying', 8, 2)->nullable();
            $table->float('prune_and_train', 8, 2)->nullable();
            $table->float('put_hail_net', 8, 2)->nullable();
            $table->float('tying_hail_net', 8, 2)->nullable();
            $table->float('remove_hail_net', 8, 2)->nullable();
            $table->float('gophers', 8, 2)->nullable();
            $table->float('apply_fertilizer', 8, 2)->nullable();
            $table->float('put_phermones', 8, 2)->nullable();
            $table->float('shovel_weeds', 8, 2)->nullable();
            $table->float('fix_trellis', 8, 2)->nullable();
            $table->float('clean_field', 8, 2)->nullable();
            $table->float('fix_hose', 8, 2)->nullable();
            $table->float('staple_hose', 8, 2)->nullable();
            $table->float('remove_tape', 8, 2)->nullable();
            $table->float('remove_wire', 8, 2)->nullable();
            $table->float('shop_labor', 8, 2)->nullable();
            $table->float('irrigation_labor', 8, 2)->nullable();
            $table->float('girdle', 8, 2)->nullable();
            $table->float('replants', 8, 2)->nullable();
            $table->float('unique_expenses_grafting', 8, 2)->nullable();
            $table->float('unique_expenses_paint_graft', 8, 2)->nullable();
            $table->float('put_reflectant', 8, 2)->nullable();
            $table->float('remove_reflectant', 8, 2)->nullable();
            $table->float('put_stakes', 8, 2)->nullable();
            $table->float('remove_stakes', 8, 2)->nullable();
            $table->float('personal', 8, 2)->nullable();
            $table->float('row_crops', 8, 2)->nullable();
            $table->float('chainsaw_deadwood', 8, 2)->nullable();
            $table->float('remove_deadwood', 8, 2)->nullable();
            $table->float('pruning', 8, 2)->nullable();
            $table->float('thinning', 8, 2)->nullable();
            $table->float('picking', 8, 2)->nullable();
            $table->float('far_expense_training', 8, 2)->nullable();
            $table->float('non_labor_hail_net', 8, 2)->nullable();
            $table->float('non_labor_replants', 8, 2)->nullable();
            $table->float('chemicals', 8, 2)->nullable();
            $table->float('fertilizers', 8, 2)->nullable();
            $table->float('trellis', 8, 2)->nullable();
            $table->float('pollination', 8, 2)->nullable();
            $table->float('electricity', 8, 2)->nullable();
            $table->float('shop_materials', 8, 2)->nullable();
            $table->float('farm_materials', 8, 2)->nullable();
            $table->float('credit_card', 8, 2)->nullable();
            $table->float('irrigation', 8, 2)->nullable();
            $table->float('diesel', 8, 2)->nullable();
            $table->float('insurance', 8, 2)->nullable();
            $table->float('consulting', 8, 2)->nullable();
            $table->float('house', 8, 2)->nullable();
            $table->float('managers', 8, 2)->nullable();
            $table->float('ripping', 8, 2)->nullable();
            $table->float('land_level', 8, 2)->nullable();
            $table->float('other_development_planting', 8, 2)->nullable();
            $table->float('pre_plant', 8, 2)->nullable();
            $table->float('other_development_install_trellis', 8, 2)->nullable();
            $table->float('overhead_principle', 8, 2)->nullable();
            $table->float('overhead_interest', 8, 2)->nullable();
            $table->float('equipment_lease', 8, 2)->nullable();
            $table->float('land_lease', 8, 2)->nullable();
            $table->float('property_tax', 8, 2)->nullable();
            $table->float('taxes', 8, 2)->nullable();
            $table->float('inventory_fertilizer', 8, 2)->nullable();
            $table->float('inventory_chemicals', 8, 2)->nullable();
            $table->float('total_amount', 8, 2)->nullable();
            $table->float('acre_amount', 8, 2)->nullable();
            $table->timestamps();
        
            // Setting up foreign keys
            $table->foreign('ranch_id')->references('id')->on('ranches')->onDelete('cascade');
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expensesheet');
    }
};
