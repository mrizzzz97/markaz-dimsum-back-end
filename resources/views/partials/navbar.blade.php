<nav class="navbar navbar-expand-lg navbar-light fixed-top glass-navbar shadow-sm" style="top:0; transition:top 0.4s;">
  <div class="container">
    <a href="/" class="navbar-brand d-flex align-items-center">
      <img src="{{ asset('images/logo.png') }}" alt="Logo Markaz Dimsum" height="36" class="mr-2"/>
      <span class="font-weight-bold" style="font-size:1.6rem; color:#1dbf73; letter-spacing:1px;">Markaz Dimsum</span>
    </a>
    <button class="navbar-toggler ml-auto d-block" id="sidebarToggle" type="button" aria-label="Toggle navigation" style="position:absolute;right:18px;top:18px;z-index:1101;background:none;border-radius:0;box-shadow:none;transition:background 0.2s;">
      <span class="navbar-toggler-icon" id="sidebarIcon" style="filter:drop-shadow(0 2px 8px #1dbf7350);transition:all 0.3s;"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end sidebar-modern" id="mainMenu" style="display:none;">
      <div class="sidebar-content p-4 rounded-right shadow-lg animate__animated animate__fadeInRight animate__faster" style="min-height:100vh;max-width:360px;width:92vw;background:linear-gradient(135deg,#e9fbe5 0%,#fffbe0 100%);backdrop-filter:blur(18px);box-shadow:0 8px 32px #1dbf7340;position:fixed;top:0;right:0;z-index:1050;overflow-y:auto;transition:all 0.35s cubic-bezier(.77,0,.18,1);">
        <button class="close btn btn-light rounded-circle position-absolute animate__animated animate__fadeIn animate__faster" id="sidebarCloseBtn" style="top:18px;right:18px;width:38px;height:38px;z-index:1100;display:none;"></button>
        <div class="text-center mb-4 animate__animated animate__zoomIn animate__faster">
          <img src="{{ asset('images/logo.png') }}" alt="Logo Markaz Dimsum" height="56" class="mb-2" style="filter:drop-shadow(0 2px 12px #1dbf7340);"/>
          <div class="font-weight-bold" style="font-size:1.4rem;color:#1dbf73;text-shadow:0 2px 8px #fff7;">Markaz Dimsum</div>
        </div>
        <ul class="navbar-nav text-right mb-4 animate__animated animate__fadeInUp animate__faster">
          <li class="nav-item"><a href="/" class="nav-link">Beranda</a></li>
          <li class="nav-item"><a href="/tentang" class="nav-link">Tentang</a></li>
          <li class="nav-item"><a href="#kontak" class="nav-link">Kontak</a></li>
          <li class="nav-item"><a href="/login" class="nav-link font-weight-bold text-success"><i class="bi bi-person-circle mr-1"></i>Admin Login</a></li>
        </ul>
        <div class="d-flex justify-content-center mb-3">
          <button class="theme-toggle" id="themeToggleBtn" aria-label="Toggle dark mode">
            <i class="bi bi-sun-fill sun"></i>
            <i class="bi bi-moon-fill moon"></i>
          </button>
        </div>
        <hr class="animate__animated animate__fadeIn animate__faster">
      </div>
    </div>
  </div>
</nav>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  var toggler = document.getElementById('sidebarToggle');
  var menu = document.getElementById('mainMenu');
  var closeBtn = document.getElementById('sidebarCloseBtn');
  var body = document.body;
  // Navbar sidebar selalu tersembunyi saat load
  menu.style.display = 'none';
  function hideSidebar() {
    menu.classList.remove('show');
    menu.style.display = 'none';
    body.classList.remove('sidebar-open');
    closeBtn.style.display = 'none';
    toggler.setAttribute('aria-expanded', 'false');
  }
  function showSidebar() {
    menu.classList.add('show');
    menu.style.display = 'block';
    body.classList.add('sidebar-open');
    closeBtn.style.display = 'block';
    toggler.setAttribute('aria-expanded', 'true');
  }
  hideSidebar();
  toggler.addEventListener('click', function() {
    if (menu.classList.contains('show')) {
      hideSidebar();
    } else {
      showSidebar();
    }
  });
  closeBtn.addEventListener('click', function() {
    hideSidebar();
  });
  menu.querySelectorAll('a').forEach(function(link) {
    link.addEventListener('click', function() {
      hideSidebar();
    });
  });

  // Header hilang saat scroll ke bawah, muncul saat scroll ke atas
  var lastScrollTop = 0;
  var navbar = document.querySelector('.glass-navbar');
  window.addEventListener('scroll', function() {
    var st = window.pageYOffset || document.documentElement.scrollTop;
    if (st > lastScrollTop && st > 80) {
      // Scroll down
      navbar.style.top = '-80px';
    } else {
      // Scroll up
      navbar.style.top = '0';
    }
    lastScrollTop = st <= 0 ? 0 : st;
  }, false);
});
</script>
@endpush
