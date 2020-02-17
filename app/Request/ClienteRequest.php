<?php

namespace App\Request;

use App\Models\ClienteModel;

class ClienteRequest {
    function Agregar(){
        $cliente = new ClienteModel();
        if ($_POST['id'] != 0)
            $cliente = $cliente->getById($_POST['id'],'IdCliente'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $cliente->IdCliente; ?>">
            <div class="form-group">
                <div class="col-sm-4">
                  <label for="nombre" class="col-sm-1 control-label">Nombre</label>
                    <input type="text" name="Nombres" id="Nombres" value="<?= $cliente->Nombres; ?>"
                           class="form-control" required autocomplete="off">
                </div>

                <div class="col-sm-4">
                  <label for="siglas" class="col-sm-1 control-label">Apellidos</label>
                    <input type="text" name="Apellidos" id="Apellidos" value="<?= $cliente->Apellidos; ?>" class="form-control"
                           required autocomplete="off">
                </div>

                <div class="col-sm-4">
                  <label for="siglas" class="col-sm-1 control-label">Telefono</label>
                    <input type="text" name="Telefono" id="Telefono" value="<?= $cliente->Telefono; ?>" class="form-control"
                           required autocomplete="off">
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-4">
                <label for="siglas" class="col-sm-1 control-label">Correo</label>
                  <input type="text" name="Correo" id="Correo" value="<?= $cliente->Correo; ?>" class="form-control"
                         required autocomplete="off">
              </div>

                <div class="col-sm-8">
                  <label for="nombre" class="col-sm-1 control-label">Direccion</label>
                    <input type="text" name="Direccion" id="Direccion" value="<?= $cliente->Direccion; ?>"
                           class="form-control" required autocomplete="off">
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
        $cliente = new ClienteModel();
        $cliente = $cliente->getById($_POST['id'],'IdCliente'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $cliente->IdCliente; ?>">
            <h5>Desea eliminar el cliente <?= $cliente->Nombres; ?> ?</h5>

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
        $can = new ClienteModel();
        $concepto = $can->getRange($p, 10,'IdCliente');
        foreach ($concepto as $c) { ?>
            <tr>
                <td><?= $c->Nombres; ?></td>
                <td><?= $c->Apellidos; ?></td>
                <td><?= $c->Direccion; ?></td>
                <td><?= $c->Telefono; ?></td>
                <td><?= $c->Correo; ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdCliente; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdCliente; ?>" data-model="<?=$_POST['model']; ?>"
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
        $clie = new ClienteModel();
        $cliente = $clie->getSearch('Nombres', $k,'Nombres');

        if (count($cliente) > 0) {
            foreach ($cliente as $c) { ?>
                <tr>
                  <td><?= $c->Nombres; ?></td>
                  <td><?= $c->Apellidos; ?></td>
                  <td><?= $c->Direccion; ?></td>
                  <td><?= $c->Telefono; ?></td>
                  <td><?= $c->Correo; ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdCliente; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdCliente; ?>" data-model="<?=$_POST['model']; ?>"
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
