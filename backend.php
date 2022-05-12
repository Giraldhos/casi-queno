<?php
class Ejercicio
{
    private $periodos;
    //private $reqs;
    //private $labs;
    private $requerimientos;
    private $diasLabs;

    # VARIABLES PREDEFINIDAS
    private $costoInvent;
    private $costoFaltante;
    private $tiempoProcesamiento;
    private $numEmpleados;
    private $costoNormal;
    private $costoExtra;
    private $horasTrabajo;

    # VARIABLES LOCALES
    private $tiemDisponible;
    private $prodReal;
    private $invFinal;
    private $pTiempoExtra;
    private $cHoraExtra;
    private $costoAlmacena;
    private $costoTiempoNormal;


    #Método constructor
    public function __construct(
        $periodos,
        $requerimientos,
        $diasLabs,
        $costoInvent,
        $costoFaltante,
        $tiempoProcesamiento,
        $numEmpleados,
        $costoNormal,
        $costoExtra,
        $horasTrabajo
    ) {
        $this->periodos = $periodos;
        $this->requerimientos = $requerimientos;
        $this->diasLabs = $diasLabs;

        $this->costoInvent = $costoInvent;
        $this->costoFaltante = $costoFaltante;
        $this->tiempoProcesamiento = $tiempoProcesamiento;
        $this->numEmpleados = $numEmpleados;
        $this->costoNormal = $costoNormal;
        $this->costoExtra = $costoExtra;
        $this->horasTrabajo = $horasTrabajo;

        $this->tiemDisponible = array();
    }

    public function calcular()
    {
        $flag = false;
        $minReqs = $this->requerimientos[0];
        $invInicial = 0; //no se usa
        $totalReq = 0;
        $totalDias = 0;
        $opsMinimos = 0;
        $opsConstantes = 0;
        $numeroTrabajadores = (($this->numEmpleados + $opsConstantes + $opsMinimos) / 3) - 1;


        for ($i = 0; $i < $this->periodos; $i++) {
            if ($this->requerimientos[$i] < $minReqs) {
                $minReqs = $this->requerimientos[$i];
            }
            $totalReq += $this->requerimientos[$i];
            $totalDias += $this->diasLabs[$i];
        }
        $opsConstantes = (round((($totalReq * $this->tiempoProcesamiento) / ($totalDias * $this->horasTrabajo)),
            0,
            PHP_ROUND_HALF_UP
        ));
        $opsMinimos = (round((($minReqs * $this->tiempoProcesamiento * $this->periodos) / ($totalDias * $this->horasTrabajo)),
            0,
            PHP_ROUND_HALF_UP
        ));

        $numeroTrabajadores = (($this->numEmpleados + $opsConstantes + $opsMinimos) / 3) - 1;


        for ($i = 0; $i < $this->periodos; $i++) {
            $tDisponible[] = (float) ($this->diasLabs[$i] * $this->horasTrabajo * $numeroTrabajadores);
            $pReal[] = (round((($tDisponible[$i] / 5)), 0, PHP_ROUND_HALF_DOWN));

            if (($invInicial + $pReal[$i]) > $this->requerimientos[$i]) {
                $invFinal[] = $invInicial + $pReal[$i] - $this->requerimientos[$i];
            } else {
                $invFinal[] = $invInicial;
            }



            if (($this->requerimientos[$i] - $invFinal[$i] - $pReal[$i]) <= 0) {
                $pTiempoExtra[] = 0;
            } else {
                if (!$flag) {
                    $pTiempoExtra[] = (round(($this->requerimientos[$i] - $invFinal[$i] - $pReal[$i]), 0, PHP_ROUND_HALF_UP));
                    $flag = !$flag;
                } else {
                    $pTiempoExtra[] = (round(($this->requerimientos[$i] - $invFinal[($i - 1)] - $pReal[$i]), 0, PHP_ROUND_HALF_UP));
                }
            }

            $cHoraExtra[] = (round(($pTiempoExtra[$i] * $this->tiempoProcesamiento * $this->costoExtra),
                0,
                PHP_ROUND_HALF_UP
            ));

            $costoAlmacena[] = $invFinal[$i] * $this->costoInvent;
            $costoTiempoNormal[] = $tDisponible[$i] *  $this->costoNormal;
        }

        $this->setTiemDisponible($tDisponible);
        $this->setProdReal($pReal);
        $this->setInvFinal($invFinal);
        $this->setPTiempoExtra($pTiempoExtra);
        $this->setCHoraExtra($cHoraExtra);
        $this->setCostoAlmacena($costoAlmacena);
        $this->setCostoTiempoNormal($costoTiempoNormal);
    }



    public function getReqs()
    {
        return $this->reqs;
    }

    public function setReqs($reqs)
    {
        $this->reqs = $reqs;
    }

    public function getPeriodos()
    {
        return $this->periodos;
    }

    public function setPeriodos($periodos)
    {
        $this->periodos = $periodos;
    }

    public function getLabs()
    {
        return $this->labs;
    }

    public function setLabs($labs)
    {
        $this->labs = $labs;
    }

    public function getCostoInvent()
    {
        return $this->costoInvent;
    }

    public function setCostoInvent($costoInvent)
    {
        $this->costoInvent = $costoInvent;
    }

    public function getCostoFaltante()
    {
        return $this->costoFaltante;
    }

    public function setCostoFaltante($costoFaltante)
    {
        $this->costoFaltante = $costoFaltante;
    }

    public function getTiempoProcesamiento()
    {
        return $this->tiempoProcesamiento;
    }

    public function setTiempoProcesamiento($tiempoProcesamiento)
    {
        $this->tiempoProcesamiento = $tiempoProcesamiento;
    }

    public function getNumEmpleados()
    {
        return $this->numEmpleados;
    }

    public function setNumEmpleados($numEmpleados)
    {
        $this->numEmpleados = $numEmpleados;
    }

    public function getCostoNormal()
    {
        return $this->costoNormal;
    }

    public function setCostoNormal($costoNormal)
    {
        $this->costoNormal = $costoNormal;
    }

    public function getCostoExtra()
    {
        return $this->costoExtra;
    }

    public function setCostoExtra($costoExtra)
    {
        $this->costoExtra = $costoExtra;
    }

    public function getHorasTrabajo()
    {
        return $this->horasTrabajo;
    }

    public function setHorasTrabajo($horasTrabajo)
    {
        $this->horasTrabajo = $horasTrabajo;
    }

    public function getRequerimientos()
    {
        return $this->requerimientos;
    }

    public function setRequerimientos($requerimientos)
    {
        $this->requerimientos = $requerimientos;
    }

    public function getDiasLabs()
    {
        return $this->diasLabs;
    }

    public function setDiasLabs($diasLabs)
    {
        $this->diasLabs = $diasLabs;
    }

    public function getTiemDisponible()
    {
        return $this->tiemDisponible;
    }

    public function setTiemDisponible($tiemDisponible)
    {
        $this->tiemDisponible = $tiemDisponible;
    }

    public function getProdReal()
    {
        return $this->prodReal;
    }

    public function setProdReal($prodReal)
    {
        $this->prodReal = $prodReal;
    }

    public function getInvFinal()
    {
        return $this->invFinal;
    }

    public function setInvFinal($invFinal)
    {
        $this->invFinal = $invFinal;
    }

    public function getPTiempoExtra()
    {
        return $this->pTiempoExtra;
    }

    public function setPTiempoExtra($pTiempoExtra)
    {
        $this->pTiempoExtra = $pTiempoExtra;
    }

    public function getCHoraExtra()
    {
        return $this->cHoraExtra;
    }

    public function setCHoraExtra($cHoraExtra)
    {
        $this->cHoraExtra = $cHoraExtra;
    }

    public function getCostoAlmacena()
    {
        return $this->costoAlmacena;
    }

    public function setCostoAlmacena($costoAlmacena)
    {
        $this->costoAlmacena = $costoAlmacena;
    }

    public function getCostoTiempoNormal()
    {
        return $this->costoTiempoNormal;
    }

    public function setCostoTiempoNormal($costoTiempoNormal)
    {
        $this->costoTiempoNormal = $costoTiempoNormal;
    }
}
