<?php

namespace App\Services;

use App\Models\EmiDetail;
use App\Repository\LoanDetailRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmiDetailProcessDataService
{
    public function process(): void
    {
        $loanRepo = new LoanDetailRepository;

        collect($loanRepo->rawQuery())->each(function ($loan) {
            $emiAmount = round($loan->loan_amount / $loan->num_of_payment, 2);

            $months = collect(
                Carbon::parse($loan->first_payment_date)->startOfMonth()->monthsUntil($loan->last_payment_date)
            )->mapWithKeys(function ($date, $index) use ($emiAmount, $loan) {

                $isLastEmi = $index + 1 === $loan->num_of_payment;
                if ($isLastEmi) {
                    $principalPaid = $index * $emiAmount;
                    $emiAmount = $loan->loan_amount - $principalPaid;
                }

                return [$date->format('Y_M') => $emiAmount];
            });

            DB::table('emi_details')->insert([
                'client_id' => $loan->client_id,
                ...$months,
            ]);
        });
    }
}
