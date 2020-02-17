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
                <div class="col-sm-4">
	                <label for="codigo" class="col-sm-1 control-label">Folio</label>
	                <input type="text" name="Folio" id="Codigo" value="<?= $reserva->Folio; ?>"
                           class="form-control" required autocomplete="off">
                </div>
                <div class="col-sm-4">
	                <label for="Fecha" class="col-sm-1 control-label">Fecha</label>
	                <input type="date" name="Fecha" id="Fecha" value="<?= $reserva->Fecha; ?>"
                           class="form-control" required autocomplete="off">
                </div>
                <div class="col-sm-4">
                <label for="NumHabitacion" class="col-sm-1 control-label">Habitación</label>
                    <input type="number" name="NumHabitacion" id="NumHabitacion" value="<?= $reserva->NumHabitacion; ?>"
                           class="form-control" required autocomplete="off">
                </div>
                <div class="col-sm-4">
                <label for="Importe" class="col-sm-1 control-label">Importe</label>
                  <input type="text" name="Importe" id="Importe" value="<?= $reserva->Importe; ?>" class="form-control"
                         required autocomplete="off">
              </div>
              <div class="col-sm-8">
                <label for="Descripcion" class="col-sm-1 control-label">Descipción</label>
                
                    <input type="text" name="Descripcion" id="Nombre" value="<?= $reserva->Descripcion; ?>" class="form-control"
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
