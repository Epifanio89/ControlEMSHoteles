<?php

namespace App\Request;

use App\Models\UsuariosModel;
use App\Models\PerfilesModel;

class UsuariosRequest {
    function Agregar(){
        $user = new UsuariosModel();
        if ($_POST['id'] != 0)
            $user = $user->getById($_POST['id'],'IdUser');

        $perfil = new PerfilesModel();
        $perfil = $perfil->getAll('id_tipo_usuario');

        ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
            <div class="row form-group">
                <div class="col-md-6 ">
                    <label for="Usuario" class="control-label">Usuario</label>
                    <input type="text" name="Usuario" id="Usuario" value="<?= $user->NombreUser; ?>"
                           class="form-control" required autocomplete="off">
                </div>
                <div class="col-md-6 ">
                    <label for="password" class="control-label">Contraseña</label>
                    <input type="password" name="password" id="password" value="<?= $user->password; ?>" class="form-control" required autocomplete="off">
                </div>

                <div class="col-sm-6">
                    <label for="Nombre" class="control-label">Nombre</label>
                    <input type="text" name="Nombre" id="Nombre" value="<?= $user->Nombres; ?>" class="form-control"
                           required autocomplete="off">
                </div>

                <div class="col-sm-6">
                    <label for="Apellidos" class="control-label">Apellidos</label>
                    <input type="text" name="Apellidos" id="Apellidos" value="<?= $user->Apellidos; ?>" class="form-control"
                           required autocomplete="off">
                </div>

                <div class="col-sm-6">
                    <label for="email" class="control-label">E-mail</label>
                    <input type="email" name="email" id="email" value="<?= $user->email; ?>" class="form-control"
                           required autocomplete="off">
                </div>
                <div class="col-sm-6">
                <label for="id_tipo_usuario" class="control-label">Perfil</label>
                <select name="id_tipo_usuario" id="id_tipo_usuario" class="form-control">
                    <?php foreach ($perfil as $c): ?>
                        <option value="<?=$c->id_tipo_usuario; ?>" <?=($c->id_tipo_usuario == $user->id_tipo_usuario) ? 'selected' : '' ?>>
                            <?= $c->descripcion; ?>
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
        $user = new UsuariosModel();
        $user = $user->getById($_POST['id'],'IdUser'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $user->IdUser; ?>">
            <h5>Desea eliminar el Usuario
                '<?= $user->NombreUser; ?>
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
        $can = new UsuariosModel();
        $user = $can->getRanges($p, 10,'NombreUser');
        foreach ($user as $c) { ?>
            <tr>
                <td><?= $c->NombreUser; ?></td>
                <td><?= $c->NombreCompleto; ?></td>
                <td><?= $c->Perfil; ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdUser; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdUser; ?>" data-model="<?=$_POST['model']; ?>"
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
        $can = new UsuariosModel();
        $user = $can->getSearchs('NombreUser', $k,'NombreUser');
        if (count($user) > 0) {
            foreach ($user as $c) { ?>
                <tr>
                  <td><?= $c->NombreUser; ?></td>
                  <td><?= $c->NombreCompleto; ?></td>
                  <td><?= $c->Perfil; ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdUser; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdUser; ?>" data-model="<?=$_POST['model']; ?>"
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
