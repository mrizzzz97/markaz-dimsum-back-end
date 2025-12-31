<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Markaz Dimsum')</title>

  <!-- THEME INIT (ANTI NYANGKUT, ANTI BUG) -->
  <script>
    (function () {
      const savedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-theme', savedTheme);
    })();
  </script>

  @stack('styles')
</head>
<body>

  {{-- NAVBAR INCLUDE --}}
  @include('layouts.navbar')

  @yield('content')

  @stack('scripts')

  <!-- THEME ENGINE (SATU, STABIL) -->
  <script>
    function toggleTheme() {
      const html = document.documentElement;
      const current = html.getAttribute('data-theme');
      const next = current === 'dark' ? 'light' : 'dark';

      html.setAttribute('data-theme', next);
      localStorage.setItem('theme', next);

      updateThemeIcon();
    }

    function updateThemeIcon() {
      const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
      const icon = document.getElementById('themeIcon');
      if (!icon) return;

      icon.className = isDark
        ? 'bi bi-moon-stars-fill'
        : 'bi bi-sun-fill';
    }

    document.addEventListener('DOMContentLoaded', updateThemeIcon);
  </script>
</body>
</html>
