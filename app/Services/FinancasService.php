<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\StaticVar;

class FinancasService {

    private static string $totais = "
    WITH totais AS (
        SELECT
            COALESCE((SELECT
                COALESCE(SUM(valor), 0)
            FROM
                mensalidadecartao mc
            WHERE
                mc.datavencimento BETWEEN ? AND ?), 0) + 
            (SELECT
                COALESCE(SUM(valor), 0)
            FROM
                despesa d
            WHERE
                d.data BETWEEN ? AND ? AND id_mensalidadecartao IS NULL) despesatotal,
            (SELECT
                COALESCE(SUM(valor), 0)
            FROM
                renda r
            WHERE r.data BETWEEN ? AND ?) rendatotal
    )SELECT
        COALESCE(rendatotal, 0) rendatotal,
        COALESCE(despesatotal, 0) despesatotal,
        COALESCE(rendatotal, 0) - COALESCE(despesatotal, 0) valorrestante
    FROM
        totais
    ";

    private static string $totaisDespesas = "
    SELECT
        td.id,
        td.descricao,
        SUM(d.valor) valortotal
    FROM
        despesa d
    JOIN
        tipodespesa td ON td.id = d.id_tipodespesa
    WHERE
        td.ativo
        AND (data BETWEEN ? AND ?
            OR id_mensalidadecartao IN (
                SELECT
                    id
                FROM
                    mensalidadecartao mc
                WHERE
                    mc.datavencimento BETWEEN ? AND ?
    	    )
        )
    GROUP BY
        td.id,
        td.descricao
    ORDER BY
        td.id
    ";

    public static function totalMesAtual() {
        $primeiroDia = DataService::obterMesAtual()['primeiroDia'];
        $ultimoDia = DataService::obterMesAtual()['ultimoDia'];

        return DB::select(DB::raw(self::$totais), [
            $primeiroDia, $ultimoDia,
            $primeiroDia, $ultimoDia,
            $primeiroDia, $ultimoDia
        ]);
    }

    public static function totalProximoMes() {
        $primeiroDia = DataService::obterProximoMes()['primeiroDia'];
        $ultimoDia = DataService::obterProximoMes()['ultimoDia'];

        return DB::select(DB::raw(self::$totais), [
            $primeiroDia, $ultimoDia,
            $primeiroDia, $ultimoDia,
            $primeiroDia, $ultimoDia
        ]);
    }

    public static function totalDespesaMesAtual() {
        $primeiroDia = DataService::obterMesAtual()['primeiroDia'];
        $ultimoDia = DataService::obterMesAtual()['ultimoDia'];

        return DB::select(DB::raw(self::$totaisDespesas), [
            $primeiroDia, $ultimoDia,
            $primeiroDia, $ultimoDia
        ]);
    }

    public static function totalDespesaProximoMes() {
        $primeiroDia = DataService::obterProximoMes()['primeiroDia'];
        $ultimoDia = DataService::obterProximoMes()['ultimoDia'];

        return DB::select(DB::raw(self::$totaisDespesas), [
            $primeiroDia, $ultimoDia,
            $primeiroDia, $ultimoDia
        ]);
    }

}

?>
