<?php

namespace App\Request;

use App\Models\PrestamoModel;
use App\Models\ClienteModel;
use App\Models\conceptosModel;

class PrestamoRequest {
    function Agregar(){
        $prestamo = new PrestamoModel();
        if ($_POST['id'] != 0)
            $prestamo = $prestamo->getById($_POST['id'],'IdPrestamo');

            $cliente = new clienteModel();
            $cliente = $cliente->getAll('IdCliente');
            $concepto = new conceptosModel();
            $concepto = $concepto->getAll('IdConcepto'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $prestamo->IdPrestamo; ?>">
            <div class="form-group">
              <div class="col-sm-4">
                <label for="siglas" class="col-sm-1 control-label">Folio</label>
                  <input type="text" name="Folio" id="Folio" value="<?= $prestamo->Folio; ?>" class="form-control"
                         required autocomplete="off">
              </div>
                <div class="col-sm-8">
                  <label for="nombre" class="col-sm-1 control-label">Cliente</label>
                  <select name="Cliente" id="Cliente" class="form-control">
                      <?php foreach ($cliente as $c): ?>
                          <option value="<?=$c->IdCliente; ?>" <?=($c->IdCliente == $prestamo->IdCliente) ? 'selected' : '' ?>>
                              <?= $c->Nombres.' '.$c->Apellidos; ?>
                          </option>
                      <?php endforeach; ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-4">
                <label for="siglas" class="col-sm-1 control-label">Concepto</label>
                <select name="Concepto" id="Concepto" class="form-control">
                    <?php foreach ($concepto as $c): ?>
                        <option value="<?=$c->Nombre; ?>" <?=($c->Nombre == $prestamo->Concepto) ? 'selected' : '' ?>>
                            <?= $c->Nombre; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
              </div>

              <div class="col-sm-4">
                <label for="siglas" class="col-sm-1 control-label">Fecha</label>
                  <input type="date" name="Fecha" id="Fecha" value="<?= $prestamo->Fecha; ?>" class="form-control"
                         required autocomplete="off">
              </div>

              <div class="col-sm-4">
                <label for="siglas" class="col-sm-1 control-label">Importe</label>
                  <input type="text" name="Importe" id="Importe" value="<?= $prestamo->Importe; ?>" class="form-control"
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
        $prestamo = new PrestamoModel();
        $prestamo = $prestamo->getById($_POST['id'],'IdPrestamo'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $prestamo->IdPrestamo; ?>">
            <h5>Desea eliminar el prestamo con folio <?= $prestamo->Folio; ?> ?</h5>

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
        $pres = new PrestamoModel();
        $prestamo = $pres->getRanges($p, 10,'IdPrestamo');
        foreach ($prestamo as $c) { ?>
            <tr>
                <td><?= $c->Folio; ?></td>
                <td><?= $c->Cliente; ?></td>
                <td><?= $c->Concepto; ?></td>
                <td><?= $c->Fecha; ?></td>
                <td><?= $c->Importe; ?></td>
                <td><?= $c->ImporteActual; ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdPrestamo; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdPrestamo; ?>" data-model="<?=$_POST['model']; ?>"
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
        $pres= new PrestamoModel();
        $prestamo = $pres->getSearch('Folio', $k,'Folio');

        if (count($prestamo) > 0) {
            foreach ($prestamo as $c) { ?>
                <tr>
                  <td><?= $c->Folio; ?></td>
                  <td><?= $c->Cliente; ?></td>
                  <td><?= $c->Concepto; ?></td>
                  <td><?= $c->Fecha; ?></td>
                  <td><?= $c->Importe; ?></td>
                  <td><?= $c->ImporteActual; ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdPrestamo; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdPrestamo; ?>" data-model="<?=$_POST['model']; ?>"
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
