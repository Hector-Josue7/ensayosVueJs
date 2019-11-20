<?php
class Region extends ActiveRecord
{
    /**
     * Lista todas las regiones
     * @return array
     */
    public function all()
    {
        return $this->find('order: nombre');
    }
}