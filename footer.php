</div><!-- end .wrapper -->

	<footer id="footer" role="contentinfo">
		<?php 
		wp_nav_menu( array(
			'theme_location' 	=> 'utilities',
			'fallback_cb' 		=> 'majestic_menu_fallback', //define in functions.php
		) ); 
		?>


		<small>
			&copy; 2017 by <?php bloginfo('name'); ?>. All Rights Reserved.
		</small>
	</footer>
<?php wp_footer(); //HOOK. required for plugins and admin bar to work ?>
</body>
</html>