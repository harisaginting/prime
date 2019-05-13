<div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item"> 
              <a class="nav-link <?= ($this->uri->segment(1)=="dashboard")||($this->uri->segment(1)=="") ? 'active' : ''; ?>" id="menu-dashboard" href="<?= base_url(); ?>" style=" <?= ($this->uri->segment(1)=="dashboard")||($this->uri->segment(1)=="") ? 'border-top-right-radius:15px' : ''; ?>"   ><i class="nav-icon cui-dashboard"></i> <span class="nav-name">Dashboard </span> </a>
            </li>

            <li class="nav-item">
               <a class="nav-link nav-link-hgn <?= $this->uri->segment(1)=="project" ? 'active' : ''; ?>" id="menu-project-active" href="<?= base_url(); ?>project">
                <i class="nav-icon icon-rocket"></i> Projects
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url() ?>">
                <i class="nav-icon icon-docs"></i> BAST</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= base_url() ?>">
                <i class="nav-icon cui-layers"></i> WFM Data</a>
            </li>

            <li class="nav-title">Admin Menu</li>
            <li class="nav-item">
              <a class="nav-link" href="colors.html">
                <i class="nav-icon icon-people"></i> Users</a>
            </li>
            
            
          </ul>

          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>


      <main class="main">