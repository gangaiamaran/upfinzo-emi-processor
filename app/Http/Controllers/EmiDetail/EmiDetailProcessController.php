<?php

namespace App\Http\Controllers\EmiDetail;

use App\Http\Controllers\Controller;
use App\Repository\EmiDetailRepository;
use App\Repository\LoanDetailRepository;
use App\Services\EmiDetailMigrationService;
use App\Services\EmiDetailProcessDataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmiDetailProcessController extends Controller
{
    public function __construct(public EmiDetailRepository $emiDetailRepository) {}

    public function __invoke(Request $request): JsonResponse
    {
        $emiDetailMigrationService = new EmiDetailMigrationService;
        $emiDetailMigrationService->up();

        $emiDetailProcessDataService = new EmiDetailProcessDataService;
        $emiDetailProcessDataService->process();

        return response()->json([
            'columns' => $this->emiDetailRepository->getEmiDetailColumns(),
            'value' => $this->emiDetailRepository->getAll(),
        ]);
    }
}
