<nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
  <div class="container">
    <a href="/" class="navbar-brand">
      <img src="https://avatars.githubusercontent.com/u/106727010?v=4" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
      <span class="brand-text font-weight-light">General Insurance</span>
    </a>
    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <ul class="navbar-nav">
        <li class="nav-item " >
          <a href="<?= base_url('/'); ?>" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('/policy'); ?>" class="nav-link">Polis</a>
        </li>
      </ul>
    </div>

    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?= $_SESSION['name']; ?></a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="<?= base_url('/logout'); ?>" class="dropdown-item">Log Out</a></li>
          </ul>
      </li>
    </ul>
  </div>
</nav>
