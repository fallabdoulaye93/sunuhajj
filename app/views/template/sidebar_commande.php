
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span>
                <span class="hide-menu">Navigation</span></h3></div>
        <ul class="nav" id="side-menu">


            <?php include("profil_user.php"); ?>
            <br>
            <li>
                <?php /*if($admin==1 || $this->profil->Est_autoriser(74,$profil)==1)*/ {?>
            <li>
                <a href="<?= WEBROOT; ?>commande/listeCommande">
                    <i data-icon="/" class="linea-icon linea-basic fa-fw"></i>
                    <span class="hide-menu"><?php echo $this->lang['listeCommande']; ?></span>
                </a>
            </li>

            <?php }/*if($admin==1 || $this->profil->Est_autoriser(74,$profil)==1)*/ {?>
               <li>
                    <a href="<?= WEBROOT; ?>commande/listeStatutCommande">
                        <i data-icon="/" class="linea-icon linea-basic fa-fw"></i>
                        <span class="hide-menu"><?php echo $this->lang['statutcommande']; ?></span>
                    </a>
                </li>

            <?php }/*if($admin==1 || $this->profil->Est_autoriser(74,$profil)==1)*/ {?>
              <!--  <li>
                    <a href="<?/*= WEBROOT; */?>administration /listeGroupe">
                        <i data-icon="/" class="linea-icon linea-basic fa-fw"></i>
                        <span class="hide-menu"><?php /*echo $this->lang['group']; */?></span>
                    </a>
                </li>-->

            <?php }/*if($admin==1 || $this->profil->Est_autoriser(74,$profil)==1)*/ {?>
               <!-- <li>
                    <a href="<?/*= WEBROOT; */?>administration/listeProfil">
                        <i data-icon="/" class="linea-icon linea-basic fa-fw"></i>
                        <span class="hide-menu"><?php /*echo $this->lang['profils']; */?></span>
                    </a>
                </li>-->

            <?php }/*if($admin==1 || $this->profil->Est_autoriser(74,$profil)==1)*/ {?>
                <!--<li>
                    <a href="<?/*= WEBROOT; */?>administration/listeModule">
                        <i data-icon="/" class="linea-icon linea-basic fa-fw"></i>
                        <span class="hide-menu"><?php /*echo $this->lang['modules']; */?></span>
                    </a>
                </li>-->
            <?php }?>

            </li>


            <!--<li> <a href="#" class="waves-effect"><i class="mdi mdi-apple-safari fa-fw"></i> <span class="hide-menu"><?php /*echo $this->lang['boutique']; */?><span class="fa arrow"></span> </span></a>

            </li>

            <li> <a href="#" class="waves-effect"><i class="mdi mdi-clipboard-text fa-fw"></i> <span class="hide-menu"><?php /*echo $this->lang['ged']; */?><span class="fa arrow"></span></span></a>

            </li>

            <li> <a href="#" class="waves-effect"><i class="mdi mdi-gavel fa-fw"></i> <span class="hide-menu"><?php /*echo $this->lang['reporting']; */?><span class="fa arrow"></span></span></a>

            </li>-->

        </ul>



    </div>
</div>