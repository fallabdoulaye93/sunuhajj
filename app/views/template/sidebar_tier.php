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
                <a href="#" class="waves-effect"><i class="mdi mdi-account fa-fw"></i>
                    <span class="hide-menu"><?php echo $this->lang['gestiontier']; ?><span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">

                    <li>
                        <a href="<?= WEBROOT; ?>tier/listepelerins">
                            <i data-icon="/" class="fa fa-users fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listepelerins']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= WEBROOT; ?>tier/listeguide">
                            <i data-icon="/" class="fa fa-users fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listeguide']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= WEBROOT; ?>tier/listeconseillers">
                            <i data-icon="/" class="fa fa-users fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listeconseillers']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= WEBROOT; ?>tier/listeformateurs">
                            <i data-icon="/" class="fa fa-users fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listeformateurs']; ?></span>
                        </a>
                    </li>


                </ul>
            </li>

        </ul>
    </div>
</div>
