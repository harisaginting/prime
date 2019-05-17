<div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item"> 
              <a class="nav-link <?= ($this->uri->segment(1)=="dashboard")||($this->uri->segment(1)=="") ? 'active' : ''; ?>" id="menu-dashboard" href="<?= base_url(); ?>" style=" <?= ($this->uri->segment(1)=="dashboard")||($this->uri->segment(1)=="") ? 'border-top-right-radius:15px' : ''; ?>"   ><i class="nav-icon cui-dashboard"></i> <span class="nav-name">Dashboard </span> </a>
            </li>

           <!--  <li class="nav-item">
               <a class="nav-link nav-link-hgn <?= $this->uri->segment(1)=="belajar" ? 'active' : ''; ?>" id="menu-project-active" href="<?= base_url(); ?>belajar">
                <i class="nav-icon icon-rocket"></i> belajar
              </a>
            </li>
 -->

            <li class="nav-item">
               <a class="nav-link nav-link-hgn <?= $this->uri->segment(1)=="project" ? 'active' : ''; ?>" id="menu-project-active" href="<?= base_url(); ?>project">
                <i class="nav-icon icon-rocket"></i> Projects
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url() ?>bast">
                <i class="nav-icon icon-docs"></i> BAST</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url() ?>wfm">
                <i class="nav-icon cui-layers"></i> WFM Data</a>
            </li>

            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
              <i class="nav-icon fa fa-area-chart"></i> Monitoring</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a class="nav-link" href="<?= base_url() ?>monitoring/pm">
                  <i class="nav-icon icon-star"></i> Project Manager
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url() ?>utility">
                <i class="nav-icon fa fa-wrench"></i> Tools</a>
            </li>

            <li class="nav-title">Admin Menu</li>
             <li class="nav-item">
              <a class="nav-link" href="<?= base_url() ?>user">
                <i class="nav-icon icon-people"></i> Users</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url() ?>master/partner">
                <i class="nav-icon icon-layers"></i> Partners</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url() ?>master/customer">
                <i class="nav-icon icon-layers"></i> Customers</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url() ?>master/history">
                <i class="nav-icon fa fa-history"></i> history</a>
            </li>

           
            
            
          </ul>

          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>


      <main class="main">