<?php

namespace App\Request;

use App\Models\ResumenModel;

class ResumenRequest {

    function Filrar(){
        $inicial = $_POST['FechaInicial'];
        $final = $_POST['FechaFinal'];
        $resu = new ResumenModel();
        $resumen = $resu->getResumen($inicial, $final);

        if (count($resumen) > 0) {
            foreach ($resumen as $c) { ?>
                <tr>
                  <td><?= $c->Hotel; ?></td>
                  <td><?= $c->Importe; ?></td>
                </tr>
                <?php
            }
        } else { ?>
            <tr>
                <td colspan="5" class="text-center">
                    &#161;No se han encontrado coincidencias!
                </td>
            </tr>
            <?php
        }
    }
}
