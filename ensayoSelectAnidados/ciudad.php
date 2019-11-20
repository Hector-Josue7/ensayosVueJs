<?php
class Ciudad extends ActiveRecord
{

    /**
     * Lista todas las ciudades de una comuna
     * 
     * @param int $region_id
     * @return array
     */
    public function allByComuna(int $comuna_id)//validación int de PHP7
    {
        return $this->find("comuna_id = $comuna_id", 'order: nombre');
    }
}