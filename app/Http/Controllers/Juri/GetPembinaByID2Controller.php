<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use App\Models\Pembina;
use Illuminate\Http\Request;

class GetPembinaByID2Controller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($pembina_id)
    {
        $pembina = Pembina::findOrFail($pembina_id);
        return response()->json([
            'data' => $pembina,
        ])->setStatusCode(200);
    }
}
