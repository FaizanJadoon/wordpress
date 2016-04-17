                </div>
            </div><!--.main-wrapper-->
		<footer class="footer">
			<div class="container clearfix">
                <div class="footer-widgets footer-columns-4">
                    <div class="footer-widget footer-widget-1">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                    <div class="footer-widget footer-widget-2">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                    <div class="footer-widget footer-widget-3">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                    <div class="footer-widget footer-widget-4 last">
                        <?php dynamic_sidebar('footer-4'); ?>
                    </div>
                </div><!-- .footer-widgets -->
			</div><!-- .container -->
		</footer>
		<div class="copyright">
			<div class="copyright-inner">
				<div class="copyright-text">
                    <?php if ( get_theme_mod( 'footer_credit', '1' ) ) { ?>
                        <?php echo sprintf( esc_html__( 'Theme by %s', 'liveblog' ), '<a href="http://themespie.com/" rel="designer">ThemesPie</a>' ); ?>
                        <span>|</span>
                        <?php printf( esc_html__( 'Proudly Powered by %s', 'liveblog' ), '<a href="http://wordpress.org/">WordPress</a>' ); ?>
                    <?php } ?>
                </div>
			</div>
		</div><!-- .copyright -->
	</div><!-- .st-pusher -->
</div><!-- .main-container -->
<?php if (get_theme_mod( 'scroll_top','show' ) == 'show') { ?>
	<div class="back-to-top"><i class="fa fa-arrow-up"></i></div>
<?php } ?>
</div><!--.st-container-->
<?php wp_footer(); ?>
</body>
</html>