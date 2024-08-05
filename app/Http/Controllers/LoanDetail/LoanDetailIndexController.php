<?php

namespace App\Http\Controllers\LoanDetail;

use App\Http\Controllers\Controller;
use App\Repository\LoanDetailRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class LoanDetailIndexController extends Controller
{
    public function __construct(public LoanDetailRepository $loanDetailRepository) {}

    public function __invoke(): View|Factory|Application
    {
        return view('dashboard')->with('loan_details', $this->loanDetailRepository->getAll());
    }
}
