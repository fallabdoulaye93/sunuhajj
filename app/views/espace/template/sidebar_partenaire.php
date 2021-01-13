<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3>
                <span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i>
                    <i class="ti-close visible-xs"></i>
                </span>
                <span class="hide-menu">Navigation</span>
            </h3>
        </div>
        <?php include("profil_user.php"); ?>
        <ul class="nav" id="side-menu">
            <li>
                <a href="#" class="waves-effect"><i class="mdi mdi-account-multiple fa-fw"></i> <span class="hide-menu"><?php echo $this->lang['gestion_partenaires']; ?><span
                                class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">

                    <li>
                        <a href="<?php echo WEBROOT; ?>partenaire/listePartenaire">
                            <i data-icon="/" class="linea-icon linea-basic fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['partenaires']; ?></span>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
</div>
