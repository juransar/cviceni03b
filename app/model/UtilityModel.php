<?php

namespace App\Model;

use Nette\Utils\DateTime;

class UtilityModel extends BaseModel
{
    /** @var PidModel - model pro management rc*/
    private $pidModel;

    public function setPidService(PidModel $pidModel){
        $this->pidModel=$pidModel;
    }
    /**
     * Metoda detekuje pohlaví -1 = nedefinováno, 0 - žena, 1 - muž
     * @param int  $id rodného čísla
     */
    public function isMan($id)
    {
        if(!$id) return -1;
        $pid = $this->pidModel->getPid($id);
        if(!$pid) return -1;
        $rc = substr($pid['name'],2,2);
        return $rc<50;
    }

    /**
     * Metoda detekuje datum narození
     * @param int  $id rodného čísla
     */
    public function getBirthDay($id)
    {
        if(!$id) return "unknown";
        $person=$this->pidModel->getPid($id);
        if(!$person) return "unknown";
        $rc=$person['name'];
        if(!$this->validateRC($rc)) return $rc." !!";
        $y=substr($rc,0,2);
        if($y>54) $year="19".$y;
        else $year="20".$y;
        $m=substr($rc,2,2);
        if($m[0]>=5) $m[0]=$m[0]-5;
        $d=substr($rc,4,2);
        $birthday= DateTime::createFromFormat('d.m.Y', $d.".".$m.".".$year,'Europe/Prague');
        //echo $birthday->format('d.m.Y');
        return $birthday;
    }
    public function validateRC($cislo){
        if (strlen($cislo)!=10 ||!(is_numeric($cislo))) {
            return 0;
        }
        return 1;
    }
}