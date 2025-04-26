<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class FinancasService {

    private static string $totais = "
    WITH totais AS (
        SELECT
            (SELECT
                SUM(valor)
            FROM
                mensalidadecartao mc
            WHERE
                mc.datavencimento BETWEEN ? AND ?) + 
            (SELECT
                SUM(valor)
            FROM
                despesa d
            WHERE
                d.data BETWEEN ? AND ? AND id_mensalidadecartao IS NULL) despesatotal,
            (SELECT
                SUM(valor)
            FROM
                renda r
            WHERE r.data BETWEEN ? AND ?) rendatotal
    )SELECT
        rendatotal,
        despesatotal,
        rendatotal - despesatotal valorrestante
    FROM
        totais
    ";

    public static function totalMesAtual() {
        $primeiroDia = DataService::obterMesAtual()['primeiroDia'];
        $ultimoDia = DataService::obterMesAtual()['ultimoDia'];

        return DB::select(DB::raw(self::$totais), [$primeiroDia, $ultimoDia,
            $primeiroDia, $ultimoDia,
            $primeiroDia, $ultimoDia
        ]);
    }

    public static function totalProximoMes() {
        $primeiroDia = DataService::obterProximoMes()['primeiroDia'];
        $ultimoDia = DataService::obterProximoMes()['ultimoDia'];

        return DB::select(DB::raw(self::$totais), [$primeiroDia, $ultimoDia,
            $primeiroDia, $ultimoDia,
            $primeiroDia, $ultimoDia
        ]);
    }

}

?>