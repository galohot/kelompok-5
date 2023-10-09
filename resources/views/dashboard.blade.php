<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Kemlu International Data</title>
    <script defer data-api="/stats/api/event" data-domain="preview.tabler.io" src="/stats/js/script.js"></script>
    <meta name="msapplication-TileColor" content="" />
    <meta name="theme-color" content="" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <link rel="icon" href="" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <meta name="description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!" />
    <meta name="canonical" content="https://preview.tabler.io/layout-combo.html">
    <meta name="twitter:image:src" content="https://preview.tabler.io/static/og.png">
    <meta name="twitter:site" content="@tabler_ui">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta name="twitter:description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <meta property="og:image" content="https://preview.tabler.io/static/og.png">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="640">
    <meta property="og:site_name" content="Tabler">
    <meta property="og:type" content="object">
    <meta property="og:title" content="Tabler: Premium and Open Source dashboard template with responsive and high quality UI.">
    <meta property="og:url" content="https://preview.tabler.io/static/og.png">
    <meta property="og:description" content="Tabler comes with tons of well-designed components and features. Start your adventure with Tabler and make your dashboard great again. For free!">
    <!-- CSS files -->
    <link href="{{ asset('./dist/css/tabler.css?1685973381') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/tabler-flags.min.css?1685973381') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/tabler-payments.min.css?1685973381') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/tabler-vendors.min.css?1685973381') }}" rel="stylesheet" />
    <link href="{{ asset('./dist/css/demo.min.css?1685973381') }}" rel="stylesheet" />
    <style>
      @import url('https://rsms.me/inter/inter.css');

      :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }

      body {
        font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- Add these links to your HTML layout -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

  </head>
  <body>
    <div class="page">
      <!-- Sidebar --> @include('body.sidebar')
      <!-- Navbar --> @include('body.header') <div class="page-wrapper">
        <!-- Page body --> @yield('content')
        <!--footer--> @include('body.footer')
      </div>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('./dist/libs/apexcharts/dist/apexcharts.min.js?1685973381') }}" defer></script>
    <script src="{{ asset('./dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1685973381') }}" defer></script>
    <script src="{{ asset('./dist/libs/jsvectormap/dist/maps/world.js?1685973381') }}" defer></script>
    <script src="{{ asset('./dist/libs/jsvectormap/dist/maps/world-merc.js?1685973381') }}" defer></script>
    <script src="{{ asset('./dist/js/tabler.min.js?1685973381') }}" defer></script>
    <script src="{{ asset('./dist/js/demo.min.js?1685973381') }}" defer></script>
    <script src="{{ asset('./dist/js/datatables.js?1685973381') }}" defer></script>
  </body>
</html>