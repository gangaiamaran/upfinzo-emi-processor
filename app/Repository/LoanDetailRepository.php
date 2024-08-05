<?php

namespace App\Repository;

use App\Models\LoanDetail;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\LazyCollection;

class LoanDetailRepository
{
    /**
     * Get LoanDetail query builder
     */
    public function getModel(): Builder
    {
        return LoanDetail::query();
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

    public function cursor(array $data = []): LazyCollection
    {
        $model = $this->applyFilter($data);

        return $model->cursor();
    }

    /**
     * Apply given filters to model
     *
     * @param  array  $data  Array of data to filter plans
     * @param  Builder|null  $model  (Optional) Channel Query Builder
     */
    public function applyFilter(array $data, ?Builder $model = null): ?Builder
    {
        return $model ?? $this->getModel();
    }

    /**
     * Add a new LoanDetail
     *
     * @param  array  $data  LoanDetail data
     */
    public function store(array $data): LoanDetail
    {
        $LoanDetail = new LoanDetail($data);

        $LoanDetail->save();

        return $LoanDetail;
    }

    /**
     * Edit a new LoanDetail
     *
     * @param  array  $data  LoanDetail data
     */
    public function update($id, array $data): LoanDetail
    {
        $LoanDetail = LoanDetail::find($id);

        $LoanDetail->update($data);

        return $LoanDetail;
    }

    /**
     * Delete a LoanDetail
     *
     * @param  int  $id  LoanDetail ID
     */
    public function delete(int $id): bool
    {
        return LoanDetail::whereId($id)->delete();
    }

    public function getLoanDetailById($id): ?LoanDetail
    {
        return LoanDetail::find($id);
    }

    public function isNotEmpty(): bool
    {
        return $this->getModel()->exists();
    }
}
