<form id="validation" class="form-inline form-validator" data-type="update" role="form" name="form" action="<?= WEBROOT ?>administration/ajoutMessage" method="post">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['add_message']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="droit" class="control-label"><?php echo $this->lang['expediteur']; ?></label>
                        <input type="text" id="expediteur" name="expediteur" class="form-control" placeholder="Expéditeur" style="width: 100%" required>
                        <span class="help-block with-errors"> </span>
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="controller" class="control-label"><?php echo $this->lang['message']; ?></label>
                        <textarea id="messenger" name="txt_messenger" class="form-control" style="width: 100%" required></textarea>
                        <span class="help-block with-errors"> </span>
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="module" class="control-label"><?php echo $this->lang['listeModule']; ?> </label>

                        <select class="select2 form-control" id="fk_module" name="fk_module" style="width: 100%" required>
                            <option value="" selected="selected"><?php echo $this->lang['select_all']; ?></option>
                            <?php foreach ($module as $oneModule) { ?>
                                <option value="<?php echo $oneModule->id; ?>"><?php echo $oneModule->libelle; ?></option>
                            <?php }  ?>
                        </select>

                    </div>


                    <? print $token; ?>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?></button>
        <button class="btn btn-default" type="button" data-dismiss="modal"> <i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?> </button>
    </div>
</form>

<script>
    $(".select2").select2();
</script>