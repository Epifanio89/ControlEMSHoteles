<?php

namespace App\Request;

use App\Models\UsuarioHotelModel;
use App\Models\UsuariosModel;
use App\Models\HotelesModel;

class UsuarioHotelRequest {
    function Agregar(){
        $usuhot = new UsuarioHotelModel();
        if ($_POST['id'] != 0)
            $usuhot = $usuhot->getById($_POST['id'],'IdUsuarioHotel');

            $user = new UsuariosModel();
            $user = $user->getAlls('IdUser');

            $hotel = new HotelesModel();
            $hotel = $hotel->getAll('IdHotel');
        ?>

        <form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $usuhot->IdUsuarioHotel; ?>">
        <div class="row form-group">
            <div class="col-sm-6">
                <label for="IdUsuario" class="control-label">Nombre de Usuario</label>
                <select name="IdUsuario" id="IdUsuario" class="form-control">
                    <?php foreach ($user as $c): ?>
                        <option value="<?=$c->IdUser; ?>" <?=($c->IdUser == $usuhot->IdUsuario) ? 'selected' : '' ?>>
                            <?= $c->NombreCompleto; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-sm-6">
                <label for="IdHotel" class="control-label">Hotel</label>
                <select name="IdHotel" id="IdHotel" class="form-control">
                    <?php foreach ($hotel as $c): ?>
                        <option value="<?=$c->IdHotel; ?>" <?=($c->IdHotel == $usuhot->IdHotel) ? 'selected' : '' ?>>
                            <?= $c->Nombre; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
          </div>
            <div class="clearfix"></div><hr>
            <div class="form-group">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>

        </form>
        <?php
    }

    function Eliminar(){
        $perfiles = new UsuarioHotelModel();
        $perfiles = $perfiles->getById($_POST['id'],'IdUsuarioHotel'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $perfiles->IdUsuarioHotel; ?>">
            <h5>Desea eliminar el Hotel número
                '<?= $perfiles->IdHotel; ?>
                '?</h5>

            <div class="form-group">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i> Eliminar</button>
                </div>
            </div>
        </form>
        <?php
    }

    function Paginacion(){
        $p = 10 * ($_POST['page'] - 1);
        $can = new UsuarioHotelModel();
        $usuhot = $can->getRanges($p, 10,'NombreUser');
        foreach ($usuhot as $c) { ?>
            <tr>
                <td><?= $c->Usuario; ?></td>
                <td><?= $c->NombreUsuario; ?></td>
                <td><?= $c->Hotel; ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdUsuarioHotel; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdUsuarioHotel; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Eliminar">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
            <?php
        }
    }

    function Buscar(){
        $k = $_POST['key'];
        $can = new UsuarioHotelModel();
        $usuhot = $can->getSearchs('NombreUser', $k,'NombreUser');
        if (count($usuhot) > 0) {
            foreach ($usuhot as $c) { ?>
                <tr>
                  <td><?= $c->Usuario; ?></td>
                  <td><?= $c->NombreUsuario; ?></td>
                  <td><?= $c->Hotel; ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdUsuarioHotel; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdUsuarioHotel; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Eliminar">
                            <i class="fa fa-trash"></i> Eliminar
                        </button>
                    </td>
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
