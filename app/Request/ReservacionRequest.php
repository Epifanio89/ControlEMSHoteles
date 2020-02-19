<?php 
namespace App\Request;

use App\Models\ReservacionModel;

class ReservacionRequest{
	function Agregar(){
		$reserva = new ReservacionModel();
		if ($_POST['id'] != 0)
			$reserva = $reserva->getById($_POST['id'],'IdReservacion'); ?>

		<form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $reserva->IdReservacion; ?>">
            <div class="form-group">
                <div class="col-sm-3">
	                <label for="codigo" class=" control-label">Folio</label>
	                <input type="text" name="Folio" id="Codigo" value="<?= $reserva->Folio; ?>"
                           class="form-control" required autocomplete="off">
                </div>
                <div class="col-sm-3">
	                <label for="Fecha" class=" control-label">Fecha</label>
	                <input type="date" name="Fecha" id="Fecha" value="<?= $reserva->Fecha; ?>"
                           class="form-control" required autocomplete="off">
                </div>
                <div class="col-sm-6">
                <label for="IdHabitacion" class=" control-label">Habitación</label>
                    <input type="number" name="IdHabitacion" id="IdHabitacion" value="<?= $reserva->IdHabitacion; ?>"
                           class="form-control" required autocomplete="off">
                </div>

                <div class="col-sm-8">
                <label for="Nombre" class="control-label">Nombre</label>
                    <input type="text" name="Nombre" id="Nombre" value="<?= $reserva->Nombre; ?>"
                           class="form-control" required autocomplete="off">
                </div>
                <div class="col-sm-4">
                <label for="NPersonas" class=" control-label">Num. Personas</label>
                    <input type="number" name="NPersonas" id="NPersonas" value="<?= $reserva->NPersonas; ?>"
                           class="form-control" required autocomplete="off">
                </div>

                <div class="col-sm-3">
                <label for="Efectivo" class=" control-label">Efectivo</label>
                  <input type="text" name="Efectivo" id="Efectivo" value="<?= $reserva->Efectivo; ?>" class="form-control"
                         required autocomplete="off">
                </div>
                <div class="col-sm-3">
                <label for="TPVArcos" class=" control-label">TPV Arcos</label>
                  <input type="text" name="TPVArcos" id="TPVArcos" value="<?= $reserva->TPVArcos; ?>" class="form-control"
                         required autocomplete="off">
                </div>
                <div class="col-sm-3">
                <label for="TPVReal" class=" control-label">TPV Real</label>
                  <input type="text" name="TPVReal" id="TPVReal" value="<?= $reserva->TPVReal; ?>" class="form-control"
                         required autocomplete="off">
                </div>
                <div class="col-sm-3">
                <label for="Depositos" class=" control-label">Depositos</label>
                  <input type="text" name="Depositos" id="Depositos" value="<?= $reserva->Depositos; ?>" class="form-control"
                         required autocomplete="off">
                </div>
                
                <div class="col-sm-3">
                <label for="Commerce" class="control-label">E-Commerce</label>
                  <input type="text" name="Commerce" id="Commerce" value="<?= $reserva->Commerce; ?>" class="form-control"
                         required autocomplete="off">
                </div>
                <div class="col-sm-9">
                <label for="Guia" class=" control-label">Nombre Guia</label>
                    <input type="text" name="Guia" id="Guia" value="<?= $reserva->Guia; ?>" class="form-control"
                           required autocomplete="off">
                </div>

                <div class="col-sm-12">
                <label for="Descripcion" class="control-label">Descripción</label>
                
                    <input type="text" name="Descripcion" id="Descripcion" value="<?= $reserva->Descripcion; ?>" class="form-control"
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
        $reserva = new ReservacionModel();
        $reserva = $reserva->getById($_POST['id'],'IdReservacion'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $reserva->IdReservacion; ?>">
            <h5>Desea eliminar el concepto
                '<?= $reserva->Folio; ?>
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
        $can = new ReservacionModel();
        $reserva = $can->getRange($p, 10,'IdReservacion');
        foreach ($reserva as $c) { ?>
            <tr>
                <td><?= $c->Folio; ?></td>
                <td><?= $c->Fecha; ?></td>
                <td class="text-center"><?= $c->NumHabitacion; ?></td>
                <td class="text-right"><?= $c->Importe; ?></td>
                <td><?= $c->Descripcion; ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdReservacion; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdReservacion; ?>" data-model="<?=$_POST['model']; ?>"
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
        $can = new ReservacionModel();
        $reserva = $can->getSearch('Descripcion', $k,'Descripcion');

        if (count($reserva) > 0) {
            foreach ($reserva as $c) { ?>
                <tr>
                    <td><?= $c->Folio; ?></td>
                    <td><?= $c->Fecha; ?></td>
                    <td class="text-center"><?= $c->NumHabitacion; ?></td>
                    <td class="text-right"><?= $c->Importe; ?></td>
                    <td><?= $c->Descripcion; ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdReservacion; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdReservacion; ?>" data-model="<?=$_POST['model']; ?>"
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
