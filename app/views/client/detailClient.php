<?php
/**
 * Created by PhpStorm.
 * User: bayedame
 * Date: 31/08/2018
 * Time: 10:57
 */
?>



<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?= $this->lang['detailClient']; ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= WEBROOT.'menu/menu'; ?>"><?= $this->lang['accueil']; ?></a></li>

                    <li><a href="<?= WEBROOT.'client/liste'; ?>"><?= $this->lang['listeClients']; ?></a></li>

                    <li class="active"><?= $this->lang['detailClient']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">

            <div class="col-md-12 col-xs-12">
                <div class="white-box">
                    <!-- .tabs -->
                    <ul class="nav nav-tabs tabs customtab">
                        <li class="active tab">
                            <a href="#info" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs"><?= $this->lang['info_client']; ?></span> </a>
                        </li>
                        <li class="tab">
                            <a href="#home" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs"><?= $this->lang['historique_rechargement']; ?></span> </a>
                        </li>


                    </ul>
                    <!-- /.tabs -->
                    <div class="tab-content">
                        <!-- .tabs3 -->

                        <div class="tab-pane " id="info">

                            <div class="white-box">
                                <!--                    <div class="user-bg"> <img width="100%" alt="user" src="../plugins/images/large/img1.jpg"> </div>-->
                                <div class="col-sm-7" align="center"> <img class="img-circle" width="200"  > </div>
                                <div class="user-btm-box">

                                    <div class="row text-center m-t-10">
                                        <div class="col-md-6 b-r"><strong><?= $this->lang['prenom']; ?></strong>
                                            <p><?= $client->prenom; ?></p>
                                        </div>
                                        <div class="col-md-6"><strong><?= $this->lang['nom']; ?></strong>
                                            <p><?= $client->nom; ?></p>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    <!-- .row -->
                                    <div class="row text-center m-t-10">
                                        <div class="col-md-6 b-r"><strong><?= $this->lang['email']; ?></strong>
                                            <p><?= $client->email; ?></p>
                                        </div>
                                        <div class="col-md-6"><strong><?= $this->lang['telephone']; ?></strong>
                                            <p><?= $client->telephone; ?></p>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                    <!-- .row -->
                                    <div class="row text-center m-t-10">
                                        <div class="col-md-6 b-r"><strong><?= $this->lang['num_serie']; ?></strong>
                                            <p><?= $client->numero_serie; ?></p>
                                        </div>
                                        <div class="col-md-6"><strong><?= $this->lang['solde_carte']; ?></strong>
                                            <p><?= \app\core\Utils::getFormatMoney($client->solde)." ".$this->lang['currency'] ; ?></p>
                                        </div>

                                    </div>

                                    <hr>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane active" id="home">

                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="panel-title pull-right">

                                        <button type="button" style="background: #33691e;" class="btn btn-warning" data-toggle="modal"
                                                data-target="#ajoutRechargement"><?= $this->lang['ajout_rechargement'] ; ?></button>

                                    </h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">

                                    <table class="table table-bordered table-hover table-responsive processing"
                                           data-url="<?= WEBROOT; ?>client/rechargementPro/<?= base64_encode($client->idCarte) ?>">
                                        <thead>
                                        <tr>
                                            <th> <?php echo $this->lang['date']; ?><?= $client->idCarte ?> <?= base64_encode($client->idCarte) ?></th>
                                            <th> <?php echo $this->lang['num_transaction']; ?></th>
                                            <th><?php echo $this->lang['montant']; ?></th>
                                            <th><?php echo $this->lang['solde_avant']; ?></th>
                                            <th><?php echo $this->lang['solde_apres']; ?></th>
                                            <th><?php echo $this->lang['fait_par']; ?></th>

                                        </tr>
                                        </thead>
                                    </table>

                                </div>
                            </div>


                        </div>
                        <!-- /.tabs3 -->
                        <!-- .tabs3 -->

                        <!-- /.tabs3 -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="ajoutRechargement" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel"><?= $this->lang['rechargement_carte'] ; ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="text-center"><?=  $this->lang['message_rechargement_carte']; ?></div>
                </div>
            </div>
            <form method="post" action="<?= WEBROOT ?>client/ajoutRechargement">
                <div class="form-group" style="width: 100%;padding: 10px;">
                    <label for="solde" class="control-label"><?php echo $this->lang['montant'].' (*) :'; ?></label>
                    <input type="number" id="montant" name="montant" class="form-control" required="required" placeholder="<?php echo $this->lang['montant']; ?>"
                           style="width: 100%">
                    <span id="msg3"></span>
                    <span class="help-block with-errors"> </span>
                    <input type="hidden" name="ancien_solde" value="<?= $client->solde ?>">
                    <input type="hidden" name="idCarte" value="<?= $client->idCarte ?>">
                    <input type="hidden" name="idClient" value="<?= $client->id ?>">
                </div>


                <div class="modal-footer">
                    <button class="btn btn-success" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?></button>
                    <button class="btn btn-default" type="button" data-dismiss="modal"> <i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>













