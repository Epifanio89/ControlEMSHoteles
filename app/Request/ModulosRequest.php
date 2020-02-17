<?php

namespace App\Request;

use App\Models\UsuariosModel;
use App\Models\ModulosModel;

class ModulosRequest {
    function Agregar(){
        $Modulos = new ModulosModel();
        if ($_POST['id'] != 0)
            $Modulo = $Modulos->getById($_POST['id'],'IdModulo');
            $mod = $Modulos->getModulos();

            $user = new UsuariosModel();
            $user = $user->getAlls('IdUser');

        ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
            <div class="form-group row">
                <div class="col-sm-6">
                <label for="IdUsuario" class="control-label">Usuario</label>
                <select name="IdUsuario" id="IdUsuario" class="form-control">
                    <?php foreach ($user as $c): ?>
                        <option value="<?=$c->IdUser; ?>" <?=($c->IdUser == $Modulos->IdUsuario) ? 'selected' : '' ?>>
                            <?= $c->NombreUser; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm-6">
                  <label for="IdModulo" class="control-label">Modulo</label>
                  <select name="IdModulo" id="IdModulo" class="form-control">
                      <?php foreach ($mod as $c): ?>
                          <option value="<?=$c->IdModulo; ?>" <?=($c->IdModulo == $Modulos->IdModulo) ? 'selected' : '' ?>>
                              <?= utf8_encode($c->Nombre); ?>
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
        $mod = new ModulosModel();
        $mod = $mod->getByIdMod($_POST['id'],'IdModuloxUsuario'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $mod->IdModuloxUsuario; ?>">
            <h5>Desea eliminar el Usuario '<?= utf8_encode($mod->NombreUser); ?>' con modulo asignado '<?= $mod->NombreMod; ?> ' ?</h5>

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
        $can = new ModulosModel();
        $mod = $can->getModulosxUsuario($p, 10,'NombreUser');
        foreach ($mod as $c) { ?>
            <tr>
                <td><?= $c->NombreUser; ?></td>
                <td><?= utf8_encode($c->NombreMod); ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdModuloxUsuario; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdModuloxUsuario; ?>" data-model="<?=$_POST['model']; ?>"
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
        $can = new ModulosModel();
        $mod = $can->getSearchs('NombreUser', $k,'NombreUser');
        if (count($mod) > 0) {
            foreach ($mod as $c) { ?>
                <tr>
                  <td><?= $c->NombreUser; ?></td>
                  <td><?= utf8_encode($c->NombreMod); ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdModuloxUsuario; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdModuloxUsuario; ?>" data-model="<?=$_POST['model']; ?>"
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
