<?php

namespace App\Request;

use App\Models\HotelesModel;

class HotelesRequest {
    function Agregar(){
        $hotel = new HotelesModel();
        if ($_POST['id'] != 0)
            $hotel = $hotel->getById($_POST['id'],'IdHotel'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $hotel->IdHotel; ?>">
            <div class="form-group">
                <div class="col-sm-2">
                    <label for="Codigo" class="col-sm-1 control-label">Codigo</label>
                    <input type="text" name="Codigo" id="Codigo" value="<?= $hotel->Codigo; ?>"
                           class="form-control" required autocomplete="off">
                </div>

                <div class="col-sm-6">
                    <label for="Nombre" class="col-sm-1 control-label">Nombre</label>
                    <input type="text" name="Nombre" id="Nombre" value="<?= $hotel->Nombre; ?>" class="form-control"
                           required autocomplete="off">
                </div>

                <div class="col-sm-4">
                    <label for="Rfc" class="col-sm-1 control-label">R.F.C.</label>
                    <input type="text" name="Rfc" id="Rfc" value="<?= $hotel->RFC; ?>" class="form-control"
                           required autocomplete="off">
                </div>


                <div class="col-sm-12">
                    <label for="RazonSocial" class="col-sm-1 control-label">RazonSocial</label>
                    <input type="text" name="RazonSocial" id="RazonSocial" value="<?= $hotel->RazonSocial; ?>" class="form-control"
                           required autocomplete="off">
                </div>

                <div class="col-sm-12">
                    <label for="Direccion" class="col-sm-1 control-label">Dirección</label>
                    <input type="text" name="Direccion" id="Direccion" value="<?= $hotel->Direccion; ?>" class="form-control"
                           required autocomplete="off">
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
        $hoteles = new HotelesModel();
        $hoteles = $hoteles->getById($_POST['id'],'IdHotel'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $hoteles->IdHotel; ?>">
            <h5>Desea eliminar el Hotel
                '<?= $hoteles->Nombre; ?>
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
        $can = new HotelesModel();
        $hotel = $can->getRange($p, 10,'IdHotel');
        foreach ($hotel as $c) { ?>
            <tr>
                <td><?= $c->Codigo; ?></td>
                <td><?= $c->Nombre; ?></td>
                <td><?= $c->RFC; ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdHotel; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdHotel; ?>" data-model="<?=$_POST['model']; ?>"
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
        $can = new HotelesModel();
        $hotel = $can->getSearch('Nombre', $k,'Nombre');
        if (count($hotel) > 0) {
            foreach ($hotel as $c) { ?>
                <tr>
                  <td><?= $c->Codigo; ?></td>
                  <td><?= $c->Nombre; ?></td>
                  <td><?= $c->RFC; ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdHotel; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdHotel; ?>" data-model="<?=$_POST['model']; ?>"
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
