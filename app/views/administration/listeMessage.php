

        <div id="page-wrapper">
            <div class="container-fluid">
                <?php require_once (ROOT . 'app/views/template/notify.php'); ?>
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo $this->lang['liste_message']; ?></h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">
                            <li><a href="<?= WEBROOT.'home/menu'; ?>">  <?php echo $this->lang['accueil']; ?></a></li>
                            <li><a href="<?= WEBROOT.'administration/index'; ?>">  <?php echo $this->lang['administration']; ?></a></li>
                            <li class="active"><?php echo $this->lang['liste_message']; ?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">

                            <div class="row">
                            <div class="col-lg-12">
                                <h3 class="panel-title pull-right">
                                    <button type="button" class="open-modal btn btn-success"
                                            data-modal-controller="Administration/ajoutMessageModal"
                                            data-modal-view="<?= base64_encode("administration") ?>/<?= base64_encode("ajoutMessageModal") ?>">
                                        <i class="fa fa-plus"></i> <?php echo $this->lang['add_message']; ?>
                                    </button>
                                </h3>
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered table-hover table-responsive processing" data-url="<?= WEBROOT; ?>administration/listeMessagePro">
                                    <thead>
                                    <tr>
                                        <th> <?php echo $this->lang['expediteur']; ?></th>
                                        <th><?php echo $this->lang['message']; ?></th>
                                        <th><?php echo $this->lang['modules']; ?></th>
                                        <th><?php echo $this->lang['thEtat']; ?></th>
                                        <th><?php echo $this->lang['labAction']; ?></th>
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







