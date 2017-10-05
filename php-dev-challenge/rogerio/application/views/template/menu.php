
<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <div class="navbar-content">
        <!-- start: SIDEBAR -->
        <div class="main-navigation navbar-collapse collapse">
            <!-- start: MAIN MENU TOGGLER BUTTON -->
            <div class="navigation-toggler">
                <i class="clip-chevron-left"></i>
                <i class="clip-chevron-right"></i>
            </div>
            <!-- end: MAIN MENU TOGGLER BUTTON -->
            <!-- start: MAIN NAVIGATION MENU -->
            <ul class="main-navigation-menu">
                <li class="<?= $this->router->fetch_class() == "main" ? "active open" : "" ?>">
                    <a href="<?= base_url() ?>"><i class="clip-home-3"></i>
                        <span class="title"> Vendas </span><span class="selected"></span>
                    </a>
                </li>

                <li class="<?= $this->router->fetch_class() == "product" ? "active open" : "" ?>">
                    <a href="<?= base_url() ?>product"><i class="clip-star-4"></i>
                        <span class="title"> Produtos </span><span class="selected"></span>
                    </a>
                </li>

            </ul>
            <!-- end: MAIN NAVIGATION MENU -->
        </div>
        <!-- end: SIDEBAR -->
    </div>
    <!-- start: PAGE -->
