<?php

namespace App\Request;

use App\Models\ModulosModel;

class SiderbarRequest {
    function siderbar(){
      session_start();
      $Modu = new ModulosModel();
      $datos = $Modu->getModulosUser('IdUsuario',$_SESSION['IdUser']);
        ?>
        <br><br><br>
        <nav class="navbar navbar-default"  role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <div class="brand-wrapper">
                    <!-- Hamburger -->
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Brand -->
                    <div class="brand-name-wrapper">
                        <a class="navbar-brand" href="home">
                            EMS Hoteles
                        </a>
                    </div>
                </div>

            </div>

            <!-- Main Menu -->
            <div class="side-menu-container">
                <ul class="nav navbar-nav">
                    <li><a href="home"><i class="fa fa-home"></i> Inicio </a></li>
                    <li class="panel panel-default" id="dropdown">
                         <a data-toggle="collapse" href="#dropdown-lvl1"> <!-- va por niveles #dropdown-lvl1-->
                            <i class="fa fa-folder-open"></i> Opciones <span class="caret"></span>
                        </a>
                        <!-- Dropdown level 1 -->
                        <div id="dropdown-lvl1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">
                                  <?php foreach ($datos as $d){

                                      if($d->Principal == 'Opciones'){ ?>
                                      <li><a href="<?= $d->Ruta ?>"><i class="<?= $d->Icon ?>"></i> <?= utf8_encode($d->NombreMod) ?></a></li>
                                  <?php } }?>

                                </ul>
                            </div>
                        </div>
                    </li>

                    <!-- Dropdown-->
                    <li class="panel panel-default" id="dropdown">
                        <a data-toggle="collapse" href="#dropdown-lvl2">
                            <i class="fa fa-bars"></i> Catálogos <span class="caret"></span>
                        </a>

                        <!-- Dropdown level 2 -->
                        <div id="dropdown-lvl2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">
                                  <?php foreach ($datos as $d){

                                      if($d->Principal == 'Catalogos'){ ?>
                                      <li><a href="<?= $d->Ruta ?>"><i class="<?= $d->Icon ?>"></i> <?= utf8_encode($d->NombreMod) ?></a></li>
                                  <?php } }?>
                                </ul>
                          </div>
                        </div>
                    </li>

                    <!-- Dropdown-->
                    <li class="panel panel-default" id="dropdown">
                        <a data-toggle="collapse" href="#dropdown-lvl3">
                            <i class="fa fa-cogs"></i> Configuración<span class="caret"></span>
                        </a>

                        <!-- Dropdown level 2 -->
                        <div id="dropdown-lvl3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">
                                  <?php foreach ($datos as $d){

                                      if($d->Principal == 'Configuracion'){ ?>
                                      <li><a href="<?= $d->Ruta ?>"><i class="<?= $d->Icon ?>"></i> <?= utf8_encode($d->NombreMod) ?></a></li>
                                  <?php } }?>
                                  </ul>
                          </div>
                        </div>
                    </li>


                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
        <?php
    }

}
