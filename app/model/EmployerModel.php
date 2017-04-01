<?php

namespace App\Model;

use Tracy\Debugger;


class EmployerModel extends BaseModel
{
    /**
     * Metoda vrací seznam všech zaměstanců řazené podle příjmení
     */
    public function listEmployers()
    {
        return  $this->database->table('employer')->order('surname ASC')->fetchAll();
    }

    /**
     * Metoda vrací zaměstnace se zadaným id, pokud neexistuje vrací NoDataFound.
     * @param int  $id
     */
    public function getEmployer($id)
    {
        $res = $this->database->table('employer')->where(['id' => $id])->fetch();
        if (!$res) throw new NoDataFound();
        return $res;
    }

    /**
     * Metoda vrací vloží nového zaměstnance
     * @param array  $values
     * @return $id vloženého nákupu
     */
    public function insertEmployer($values)
    {
        $row = $this->database->table('employer')->insert($values);
        return $row->id;
    }

    /**
     * Metoda edituje zaměstance, pokud neexistuje vrací NoDataFound.
     * @param int  $id
     * @param array  $values
     */
    public function updateEmployer($id, $values)
    {
        $this->getEmployer($id);
        $row = $this->database->table('employer')
            ->where(['id' => $id])
            ->update($values);
    }

    /**
     * Metoda odebere zaměstnance, pokud neexistuje vrací NoDataFound.
     * @param array  $values
     */
    public function deleteEmployer($id)
    {
        $this->getEmployer($id);
        $row = $this->database->table('employer')
            ->where(['id' => $id])
            ->delete();
    }
}