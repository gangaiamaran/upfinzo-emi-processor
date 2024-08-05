<?php

namespace App\Repository;

use App\Models\EmiDetail;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EmiDetailRepository
{
    /**
     * Get EmiDetail query builder
     */
    public function getModel(): Builder
    {
        return EmiDetail::query();
    }

    public function getMinMaxEmiDates(): array
    {
        $dates = DB::table('loan_details')
            ->selectRaw(
                'MIN(first_payment_date) as min_first_payment_date, MAX(last_payment_date) as max_last_payment_date'
            )
            ->first();

        return [
            Carbon::parse($dates->min_first_payment_date),
            Carbon::parse($dates->max_last_payment_date),
        ];
    }

    /**
     * Get all plans
     *
     * @param  array  $data  Array of data to filter plans
     */
    public function getAll(array $data = []): Paginator
    {
        $model = $this->applyFilter($data);

        return $model->simplePaginate(Arr::get($data, 'limit', 10));
    }

    /**
     * Apply given filters to model
     *
     * @param  array  $data  Array of data to filter plans
     * @param  Builder|null  $model  (Optional) Channel Query Builder
     */
    public function applyFilter(array $data, ?Builder $model = null): ?Builder
    {
        $model = $model ?? $this->getModel();
        return $model;
    }

    public function getEmiDetailColumns(): array
    {
        return Schema::getColumnListing((new EmiDetail())->getTable());
    }
}
