<?php

namespace App\Request;

use App\Models\HabitacionModel;
use App\Models\HotelesModel;

class HabitacionRequest {
    function Agregar(){
        $habitacion = new HabitacionModel();
        if ($_POST['id'] != 0)
            $habitacion = $habitacion->getById($_POST['id'],'IdHabitacion');

            $hotel = new HotelesModel();
            $hotel = $hotel->getAll('IdHotel');?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $habitacion->IdHabitacion; ?>">
            <div class="form-group">
                <div class="col-sm-6">
                  <label for="IdHotel" class="control-label">Hotel</label>
                  <select name="IdHotel" id="IdHotel" class="form-control">
                      <?php foreach ($hotel as $c): ?>
                          <option value="<?=$c->IdHotel; ?>" <?=($c->IdHotel == $habitacion->IdHotel) ? 'selected' : '' ?>>
                              <?= $c->Nombre; ?>
                          </option>
                      <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-sm-6">
                  <label for="siglas" class="col-sm-1 control-label">Nombre</label>
                    <input type="text" name="Nombre" id="Nombre" value="<?= $habitacion->Nombre; ?>" class="form-control"
                           required autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                  <label for="siglas" class="col-sm-1 control-label">Habitaciones</label>
                    <input type="number" name="Num" id="Num" value="<?= $habitacion->Habitaciones; ?>" class="form-control"
                           required autocomplete="off">
                </div>

                <div class="col-sm-6">
                  <label for="siglas" class="col-sm-1 control-label">Descripcion</label>
                    <input type="text" name="Descripcion" id="Descripcion" value="<?= $habitacion->Descripcion; ?>" class="form-control"
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
        $habitacion = new HabitacionModel();
        $habitacion = $habitacion->getById($_POST['id'],'IdHabitacion'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $habitacion->IdHabitacion; ?>">
            <h5>Desea eliminar el concepto
                '<?= $habitacion->Nombre; ?>
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
}
