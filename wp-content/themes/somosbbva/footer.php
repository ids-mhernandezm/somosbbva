<?php
	/*-----------------------------------------------------------------------------------*/
	/* This template will be called by all other template files to finish 
	/* rendering the page and display the footer area/content
	/*-----------------------------------------------------------------------------------*/
?>


<footer class="site-footer">
	<div class="site-info container">
		
	</div><!-- .site-info -->
</footer><!-- #colophon .site-footer -->

<?php wp_footer(); 
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website. 
// Removing this fxn call will disable all kinds of plugins. 
// Move it if you like, but keep it around.
?>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="<?php echo bloginfo('template_url'); ?>/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo bloginfo('template_url'); ?>/js/megamenu.js" type="text/javascript"></script>
<script src="<?php echo bloginfo('template_url'); ?>/js/script.js" type="text/javascript"></script>
</html>
