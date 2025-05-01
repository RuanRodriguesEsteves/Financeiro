<?php

namespace App\Http\Controllers;

use App\Services\FinancasService;

class IndexController extends Controller {

    public function index() {

        $totaisMesAtual = FinancasService::totalMesAtual();
        $totaisProximoMes = FinancasService::totalProximoMes();
        $totalDespesasMesAtual = FinancasService::totalDespesaMesAtual();
        $totalDespesaProximoMes = FinancasService::totalDespesaProximoMes();

        return view('home')->with([
            'totaisMesAtual' => $totaisMesAtual,
            'totaisProximoMes' => $totaisProximoMes,
            'totaisDespesasMesAtual' => $totalDespesasMesAtual,
            'totaisDespesasProximoMes' => $totalDespesaProximoMes
        ]);

    }
    
}

?>