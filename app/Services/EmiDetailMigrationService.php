<?php

namespace App\Services;

use App\Repository\EmiDetailRepository;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmiDetailMigrationService
{
    const tableName = 'emi_details';

    public function up(): void
    {
        $emiRepo = new EmiDetailRepository;
        [$startDate, $endDate] = $emiRepo->getMinMaxEmiDates();

        $columns = collect(Carbon::parse($startDate)->monthsUntil($endDate))->map(
            fn ($date) => $date->format('Y_M')
        );

        Schema::dropIfExists(self::tableName);

        Schema::create(self::tableName, function (Blueprint $table) use ($columns) {
            $table->id();
            $table->integer('client_id');
            $columns->each(fn ($column) => $table->decimal($column)->default(0.00));
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(self::tableName);
    }
}
