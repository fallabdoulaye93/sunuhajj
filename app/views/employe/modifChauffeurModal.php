<form id="my-form" class="form-inline form-validator" data-type="update" role="form" name="form"
      action="<?= WEBROOT ?>employe/updateChauffeur" method="post" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo $this->lang['modifChauffeur']; ?></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="nom" class="control-label"><?php echo $this->lang['nom']; ?></label>
                        <input type="text" id="nom" name="nom" value="<?= $employe->nom ?>" class="form-control"
                               placeholder="<?php echo $this->lang['nom']; ?>" style="width: 100%">
                    </div>

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="prenom" class="control-label"><?php echo $this->lang['prenom']; ?></label>
                        <input type="text" id="prenom" name="prenom" value="<?= $employe->prenom ?>" class="form-control"
                               placeholder="<?php echo $this->lang['prenom']; ?>" style="width: 100%">
                    </div>
                    <!--<div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="sous_module" class="control-label">Sous Module</label>
                        <input type="text" id="sous_module" name="sous_module"  value="<? /*= $droit->sous_module */ ?>" class="form-control" placeholder="Sous Module" style="width: 100%">
                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="module" class="control-label">Module</label>
                        <input type="text" id="module" name="module"  value="<? /*= $droit->module */ ?>" class="form-control" placeholder="Module" style="width: 100%">
                    </div>-->

                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="controller" class="control-label"><?php echo $this->lang['adresse']; ?></label>
                        <input type="text" id="adresse" name="adresse" value="<?php echo $employe->adresse ?>"


                               class="form-control" placeholder="<?php echo $this->lang['adresse']; ?>" style="width: 100%">

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="email" class="control-label"><?php echo $this->lang['email']; ?></label>
                        <input type="text" id="email" name="email" value="<?php echo $employe->adresse ?>"
                               class="form-control" placeholder="<?php echo $this->lang['email']; ?>" style="width: 100%">

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="telephone" class="control-label"><?php echo $this->lang['telephone']; ?></label>
                        <input type="text" id="telephone" name="telephone" value="<?php echo $employe->telephone ?>"
                               class="form-control" placeholder="<?php echo $this->lang['telephone']; ?>" style="width: 100%">

                    </div>
                    <div class="form-group" style="width: 100%;padding: 10px;">
                        <label for="input-file-events" class="col-sm-4 control-label"><?php echo $this->lang['photo']; ?></label>
                        <div class="col-md-12">
<!--                        <label for="photo" class="control-label">--><?php //echo $this->lang['photo']; ?><!--</label>-->
                        <input type="file" id="photo" name="photo" value="<?php echo $employe->photo ?>"
                               class="form-control" style="width: 100%">
                        </div>
                    </div>
                    <!--                        --><?php// print $token; ?>
                    <input type="hidden" name="id" value="<?php echo base64_encode($employe->id) ?>">
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success confirm" data-form="my-form" type="submit"><i class="fa fa-check"></i> <?php echo $this->lang['btnValider']; ?>
        </button>
        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo $this->lang['btnFermer']; ?></button>
    </div>
</form>

