<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validacion
 *
 * @author wilfo martel
 */
class Validacion extends \Fuel\Core\Validation {

    //put your code here

    /**
     * validación de la cédula
     * @param type $cedula
     * @return boolean
     */
    public static function _validation_cedula($cedula) {
        $cadena = array(2, 1, 2, 1, 2, 1, 2, 1, 2);
        $suma = 0;
        $veri = 0;
        $aux = 0;
        if ((substr($cedula, 0, 2) > 1) && (substr($cedula, 0, 2) < 24)) {

            for ($k = 0; $k < 9; $k++) {
                $aux = $cadena[$k] * $cedula[$k];
                if ($aux > 9)
                    $aux-=9;
                $suma+=$aux;
            }
            while ($suma % 10 != 10) {
                $suma++;
                $aux++;
            }
            if ($aux == $cedula[9])
                return true;
            else
                return false;
        } else {
            return false;
        }
    }

}
