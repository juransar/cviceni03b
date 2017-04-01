<?php

namespace App\Model;

use Tracy\Debugger;


class StatisticModel extends BaseModel
{

    /**
     * Metoda vrací seznam všech statistik firem, záznam bude mít položky název firmz, minální plat ve firmě, maximální plat ve firmě, průměrný plat a součet všech platů.
     */
    public function listStatistic()
    {
        /** TODO */
        //return  $this->database->table('employer')->order('surname ASC')->fetchAll();
    }
  }