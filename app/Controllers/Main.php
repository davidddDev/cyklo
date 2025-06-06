<?php

namespace App\Controllers;

use App\Models\RaceModel;
use App\Models\RaceYearModel;
use App\Models\ResultModel;
use App\Models\RiderModel;

class Main extends BaseController
{
    protected $raceModel;
    protected $raceYearModel;
    protected $resultModel;
    protected $riderModel;

    public function __construct()
    {
        $this->raceModel = new RaceModel();
        $this->raceYearModel = new RaceYearModel();
        $this->resultModel = new ResultModel();
        $this->riderModel = new RiderModel();
    }

    public function index()
{
    // ziskame vsechny rocniky zavodu elite muzu, včetně jmena zavodu a typu uci tour
    $raceYears = $this->raceYearModel
        ->select('cyklo_race_year.*, cyklo_race.default_name, cyklo_race.country AS race_country, cyklo_uci_tour_type.name AS uci_tour_name')
        ->join('cyklo_race', 'cyklo_race.id = cyklo_race_year.id_race')
        ->join('cyklo_uci_tour_type', 'cyklo_uci_tour_type.id = cyklo_race_year.uci_tour', 'left')
        ->where('cyklo_race_year.category', 'E')
        ->where('cyklo_race_year.sex', 'M')
        ->orderBy('cyklo_race_year.start_date', 'DESC')
        ->findAll();

    $races = [];

    // seskupeni rocniku podle zavodu
    foreach ($raceYears as $year) {
        $raceId = $year->id_race;

        // pokud zavod jeste neni v poli, vytvorime ho
        if (!isset($races[$raceId])) {
            $races[$raceId] = (object)[
                'info' => (object)[
                    'default_name' => $year->default_name,
                    'country' => $year->race_country
                ],
                'years' => []
            ];
        }

        // pokud neni uci tour typ, nastavime pomlcku
        $year->uci_tour_name = $year->uci_tour_name ?? '-';

        // pridame rocnik k danemu zavodu
        $races[$raceId]->years[] = $year;
    }

    // predani dat do view
    return view('index', [
        'races' => $races
    ]);
}

public function rocnik($id)
{
    // ziskame detail rocniku podle id
    $year = $this->raceYearModel
        ->select('cyklo_race_year.*, cyklo_race.default_name, cyklo_race.country AS race_country')
        ->join('cyklo_race', 'cyklo_race.id = cyklo_race_year.id_race')
        ->where('cyklo_race_year.id', $id)
        ->first();

    // ziskame top 20 vysledku pro dany rocnik
    $results = $this->resultModel
        ->select('cyklo_result.*, CONCAT(cyklo_rider.first_name, " ", cyklo_rider.last_name) AS rider_name')
        ->join('cyklo_rider', 'cyklo_rider.id = cyklo_result.id_rider', 'left')
        ->where('cyklo_result.id_stage', $id)
        ->orderBy('cyklo_result.rank', 'ASC')
        ->limit(20)
        ->findAll();

    // predani dat do view
    return view('rocnik', [
        'year' => $year,
        'results' => $results
    ]);
}

}
