<!doctype html>
<html lang="<?php echo str_replace('_', '-', app()->getLocale()); ?>">
<head>
    <title></title>
    <meta charset=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="profile" href="https://gmpg.org/xfn/11"/>
    <?php theme_head() ?>
</head>
<body>
<div class="site-container">
    <header class="site-header">
        @yield('header')
    </header><!-- .site-header -->
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="container container-wrapper">
                <div class="content-wrapper">
                    @yield('content')
                </div><!-- .container -->
            </div><!-- .content-wrapper -->
        </main><!-- #main -->
    </div><!-- #primary -->
    <footer class="site-footer">
        <div class="footer-wrapper">
            @yield('footer')
        </div><!-- .footer-wrapper -->
    </footer><!-- .site-footer -->
</div><!-- .site-container -->
<?php theme_footer() ?>
</body>
</html>
