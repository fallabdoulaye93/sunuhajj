
<div id="page-wrapper">
    <div class="container-fluid">
        <?php require_once (ROOT . 'app/views/template/notify.php'); ?>

        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"><?php echo $this->lang['listeTransaction']; ?></h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                <ol class="breadcrumb">
                    <li><a href="<?= WEBROOT.'home/menu'; ?>">  <?php echo $this->lang['accueil']; ?></a></li>
                    <li><a href="<?= WEBROOT.'transaction/listeTransaction'; ?>">  <?php echo $this->lang['transaction']; ?></a></li>
                    <li class="active"><?php echo $this->lang['listeTransaction']; ?></li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="white-box">

                    <div class="row bg-title">
<!--                        --><?php //var_dump($bus);die(); ?>

                        <form class="form-horizontal" method="POST" action="<?php echo WEBROOT ?>transaction/listeTransaction">


                            <div class="form-group col-lg-2 col-sm-2">
                                <label for="from" class="control-label" ><?php echo $this->lang['date_deb']; ?> (*): </label>
                                <input type="text" name="datedeb"   class="form-control mydatepicker" id="from"
                                       value="<?php echo $datedeb1 ?>" placeholder="<?php echo $this->lang['date_deb']; ?>" autocomplete="off">&nbsp;&nbsp;
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="col-md-1" style="width: 4%"></div>

                            <div class="form-group col-lg-2 col-sm-2">
                                <label for="from" class="control-label" ><?php echo $this->lang['date_fin']; ?> (*): </label>
                                <input type="text" name="datefin"  class="form-control mydatepicker" id="to"
                                       value="<?php echo $datefin1 ?>" placeholder="<?php echo $this->lang['date_fin']; ?>" autocomplete="off">
                            </div>
                            <div class="col-md-1" style="width: 4%"></div>
                            <div class="form-group col-lg-2 col-sm-2">
                                <label for="from" class="control-label"><?php echo $this->lang['listeTransaction']; ?></label>
                                <select id="bus"  name="bus" class="form-control select2">
                                    <option value="0"> <?php echo $this->lang['all_bus']; ?></option>
                                    <?php foreach ($bus as $onelistetransaction) { ?>
                                        <option value="<?php echo $onelistetransaction->id; ?>"<? if ($liste == $onelistetransaction->id) echo "selected=selected" ?>>
                                            <?php echo $onelistetransaction->matricule; ?> /
                                            <?php echo $onelistetransaction->categorie; ?> /
                                            <?php echo $onelistetransaction->Places; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-1 col-lg-1" style="width: 4%"></div>
                            <div class="form-group col-lg-2 col-sm-2">
                                <label for="type" class="control-label"><?php echo $this->lang['type_paiement']; ?></label>
                                <select id="fkcarte" name="fkcarte" class="form-control select2">
                                    <option value="<?php echo $fkcarte1 ?>" > <?php echo $this->lang['select_type_paiement']; ?></option>
                                    <option value="1" <? if ($fkcarte1 == 1) echo "selected=selected" ?>> <?php echo $this->lang['card']; ?></option>
                                    <option value="0" <? if ($fkcarte1 == 0) echo "selected=selected" ?>> <?php echo $this->lang['cash']; ?></option>

                                </select>
                            </div>

                            <div class="col-md-1" style="width: 4%"></div>

                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success btn-circle btn-lg" title="Rechercher"><i
                                            class="ti-search"></i></button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="white-box">

                    <div class="panel-heading" style="height: 55px; background-color: #2f5088">
                        <div class="col-md-11"><h3 class="panel-title " > <span class="pull-left" style="color: white;"><?php echo $this->lang['listeTransaction'] ?></span><span class="pull-right" style="color: white;">CA: <?php echo \app\core\Utils::getFormatMoney($ca).' '.$this->lang['lrd']; ?>  </span></h3>
                        </div>

                       <!-- <div class="col-md-1">

                            <form method="post" id="loadform" action="<?php /*echo WEBROOT */?>transaction/printListeTransaction" target="_blank">
                                <input type="hidden" name="datedeb" value="<?/*= $datedeb1; */?>">
                                <input type="hidden" name="datefin" value="<?/*= $datefin1; */?>">
                                <input type="hidden" name="bus" value="<?/*= $liste; */?>">

                                <button name="PDF" type="submit" value="PDF" style="background-color:transparent;border: 0px;" id="topdf" title="<?php /*echo $this->lang['imprimer']; */?>">
                                    <i class="fa fa-2x fa-file-pdf-o" style="color: #e86010"></i>
                                </button>

                            </form>
                        </div>-->
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered table-hover table-responsive processing"
                                   data-url="<?= WEBROOT; ?>transaction/listeTransactionPro__/<?php echo $liste; ?>/<?php echo $datedeb; ?>/<?php echo $datefin; ?>/<?php echo $fkcarte?>">
                                <thead>
                                <tr>
                                    <th> <?php echo $this->lang['date']; ?></th>
                                    <th><?php echo $this->lang['receveurs']; ?></th>
                                    <th><?php echo $this->lang['bus']; ?></th>
                                    <th><?php echo $this->lang['ticket']; ?></th>
                                    <th><?php echo $this->lang['montant']; ?></th>
                                    <th><?php echo $this->lang['buy_to']; ?></th>
                                    <th><?php echo $this->lang['etat']; ?></th>
                                    <th><?php echo $this->lang['action']; ?></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>




<script>
    $(".select2").select2();
</script>


