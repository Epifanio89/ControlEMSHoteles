<?php

namespace App\Request;

use App\Models\PagoModel;
use App\Models\ClienteModel;
use App\Models\conceptosModel;
use App\Models\PrestamoModel;
use App\Models\PerfilModel;
class HomeRequest {
    function Agregar(){
        $Pago = new PagoModel();
        if ($_POST['id'] != 0)
            $Pago = $Pago->getById($_POST['id'],'IdPago');

            $cliente = new clienteModel();
            $cliente = $cliente->getAll('IdCliente');
            $concepto = new conceptosModel();
            $concepto = $concepto->getAll('IdConcepto');
            $Prestamo = new PrestamoModel();
            $Prestamo = $Prestamo->getAll('IdPrestamo');
            $Perfil = new PerfilModel();
            $Perfil = $Perfil->getAll('it_tipo_usuario');?>
            ?>

        <form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $Pago->IdPago; ?>">
            <div class="form-group">
              <div class="col-sm-6">
                <label for="siglas" class="control-label">Folio</label>
                  <input type="text" name="Folio" id="Folio" value="<?= $Pago->Folio; ?>" class="form-control"
                         required autocomplete="off">
              </div>
                <div class="col-sm-6">
                  <label for="nombre" class="control-label">Cliente</label>
                  <select name="Cliente" id="Cliente" class="form-control">
                      <?php foreach ($cliente as $c): ?>
                          <option value="<?=$c->IdCliente; ?>" <?=($c->IdCliente == $Pago->IdCliente) ? 'selected' : '' ?>>
                              <?= $c->Nombres.' '.$c->Apellidos; ?>
                          </option>
                      <?php endforeach; ?>
                  </select>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-6">
                <label for="siglas" class="control-label">Prestmo a pagar</label>
                <select name="IdPrestamo" id="IdPrestamo" class="form-control">
                    <?php foreach ($Prestamo as $c): ?>
                        <option value="<?=$c->IdPrestamo; ?>" <?=($c->IdPrestamo == $Pago->IdPrestamo) ? 'selected' : '' ?>>
                            <?= $c->Folio; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
              </div>

              <div class="col-sm-6">
                <label for="siglas" class="control-label">Concepto</label>
                <select name="Concepto" id="Concepto" class="form-control">
                    <?php foreach ($concepto as $c): ?>
                        <option value="<?=$c->Nombre; ?>" <?=($c->Nombre == $Pago->Concepto) ? 'selected' : '' ?>>
                            <?= $c->Nombre; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
              </div>

            </div>

            <div class="form-group">
              <div class="col-sm-6">
                <label for="siglas" class="control-label">Fecha</label>
                  <input type="date" name="Fecha" id="Fecha" value="<?= $Pago->Fecha; ?>" class="form-control"
                         required autocomplete="off">
              </div>

              <div class="col-sm-6">
                <label for="siglas" class="control-label">Pago</label>
                  <input type="text" name="Importe" id="Importe" value="<?= $Pago->Total; ?>" class="form-control"
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
        $Pago = new PagoModel();
        $Pago = $Pago->getById($_POST['id'],'IdPago'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $Pago->IdPago; ?>">
            <h5>Desea eliminar el prestamo con folio <?= $Pago->Folio; ?> ?</h5>

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
        $pres = new PagoModel();
        $Pago = $pres->getRanges($p, 10,'IdPago');
        foreach ($Pago as $c) { ?>
            <tr>
                <td><?= $c->Folio; ?></td>
                <td><?= $c->Cliente; ?></td>
                <td><?= $c->Concepto; ?></td>
                <td><?= $c->Fecha; ?></td>
                <td><?= $c->Total; ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdPago; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdPago; ?>" data-model="<?=$_POST['model']; ?>"
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
        $pres= new PagoModel();
        $Pago = $pres->getSearch('Folio', $k,'Folio');

        if (count($Pago) > 0) {
            foreach ($Pago as $c) { ?>
                <tr>
                  <td><?= $c->Folio; ?></td>
                  <td><?= $c->Cliente; ?></td>
                  <td><?= $c->Concepto; ?></td>
                  <td><?= $c->Fecha; ?></td>
                  <td><?= $c->Total; ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdPago; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdPago; ?>" data-model="<?=$_POST['model']; ?>"
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
