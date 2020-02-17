<?php

namespace App\Request;

use App\Models\PerfilesModel;

class PerfilesRequest {
    function Agregar(){
        $perfil = new PerfilesModel();
        if ($_POST['id'] != 0)
            $perfil = $perfil->getById($_POST['id'],'id_tipo_usuario'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $perfil->id_tipo_usuario; ?>">
            <div class="row form-group">

                <div class="col-sm-4">
                  <label for="codigo" class="col-sm-1 control-label">Codigo</label>
                    <input type="text" name="codigo" id="Codigo" value="<?= $perfil->codigo; ?>"
                           class="form-control" required autocomplete="off">
                </div>


                <div class="col-sm-8">
                  <label for="descripcion" class="col-sm-1 control-label">Descipción</label>
                    <input type="text" name="descripcion" id="Nombre" value="<?= $perfil->descripcion; ?>" class="form-control"
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
        $perfiles = new PerfilesModel();
        $perfiles = $perfiles->getById($_POST['id'],'id_tipo_usuario'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $perfiles->id_tipo_usuario; ?>">
            <h5>Desea eliminar el concepto
                '<?= $perfiles->descripcion; ?>
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
        $can = new PerfilesModel();
        $perfil = $can->getRange($p, 10,'id_tipo_usuario');
        foreach ($perfil as $c) { ?>
            <tr>
                <td><?= $c->codigo; ?></td>
                <td><?= $c->descripcion; ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->id_tipo_usuario; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->id_tipo_usuario; ?>" data-model="<?=$_POST['model']; ?>"
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
        $can = new PerfilesModel();
        $concepto = $can->getSearc('descripcion', $k,'descripcion');
        if (count($concepto) > 0) {
            foreach ($concepto as $c) { ?>
                <tr>
                  <td><?= $c->codigo; ?></td>
                  <td><?= $c->descripcion; ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->id_tipo_usuario; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->id_tipo_usuario; ?>" data-model="<?=$_POST['model']; ?>"
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
