<?php

namespace App\Http\Controllers\EmiDetail;

use App\Http\Controllers\Controller;
use App\Repository\LoanDetailRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class EmiDetailIndexController extends Controller
{
    public function __construct(public LoanDetailRepository $loanDetailRepository) {}

    public function __invoke(): View|Factory|Application
    {
       abort_unless($this->loanDetailRepository->isNotEmpty(), Response::HTTP_NOT_FOUND, 'No Loan Data Found.');

        return view('emi_details');
    }
}
