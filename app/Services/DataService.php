<?php

namespace App\Services;

class DataService {

    public static function obterMesAtual() {
        $data = new \DateTime();

        $primeiroDia = $data->format('Y-m') . '-01';
        $ultimoDia = $data->modify('last day of this month')->format('Y-m-d');

        return [
            'primeiroDia' => $primeiroDia,
            'ultimoDia' => $ultimoDia
        ];
    }

    public static function obterProximoMes() {
        $data = new \DateTime();

        $data = $data->add(new \DateInterval('P1M'));

        $primeiroDia = $data->format('Y-m') . '-01';
        $ultimoDia = $data->modify('last day of this month')->format('Y-m-d');

        return [
            'primeiroDia' => $primeiroDia,
            'ultimoDia' => $ultimoDia
        ];
    }

}

?>