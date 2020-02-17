<?php

namespace App\Request;

use App\Models\ConceptosModel;

class ConceptosRequest {
    function Agregar(){
        $conceptos = new ConceptosModel();
        if ($_POST['id'] != 0)
            $conceptos = $conceptos->getById($_POST['id'],'IdConcepto'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/save'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $conceptos->IdConcepto; ?>">
            <div class="form-group">
                <label for="nombre" class="col-sm-1 control-label">Codigo</label>
                <div class="col-sm-3">
                    <input type="text" name="Codigo" id="Codigo" value="<?= $conceptos->Codigo; ?>"
                           class="form-control" required autocomplete="off">
                </div>

                <label for="siglas" class="col-sm-1 control-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" name="Nombre" id="Nombre" value="<?= $conceptos->Nombre; ?>" class="form-control"
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
        $conceptos = new ConceptosModel();
        $conceptos = $conceptos->getById($_POST['id'],'IdConcepto'); ?>
        <form action="<?= route('cpanel/' . $_POST['model'] . '/del'); ?>" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="<?= $conceptos->IdConcepto; ?>">
            <h5>Desea eliminar el concepto
                '<?= $conceptos->Nombre; ?>
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
        $can = new ConceptosModel();
        $concepto = $can->getRange($p, 10,'IdConcepto');
        foreach ($concepto as $c) { ?>
            <tr>
                <td><?= $c->Codigo; ?></td>
                <td><?= $c->Nombre; ?></td>
                <td class="text-right">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdConcepto; ?>" data-model="<?=$_POST['model']; ?>"
                            data-operation="Editar">
                        <i class="fa fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                            data-target="#operationModal" data-id="<?= $c->IdConcepto; ?>" data-model="<?=$_POST['model']; ?>"
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
        $can = new ConceptosModel();
        $concepto = $can->getSearch('Nombre', $k,'Nombre');

        if (count($concepto) > 0) {
            foreach ($concepto as $c) { ?>
                <tr>
                  <td><?= $c->Codigo; ?></td>
                  <td><?= $c->Nombre; ?></td>
                    <td class="text-right">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdConcepto; ?>" data-model="<?=$_POST['model']; ?>"
                                data-operation="Editar">
                            <i class="fa fa-edit"></i> Editar
                        </button>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                data-target="#operationModal" data-id="<?= $c->IdConcepto; ?>" data-model="<?=$_POST['model']; ?>"
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
