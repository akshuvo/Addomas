<?php

class AddomasTheme_Helper_Class{

	public function __construct(){
		add_action( 'addomas_footer_hook', array( $this, 'addomas_footer_menu' ), 10 );
		add_action( 'addomas_footer_hook', array( $this, 'addomas_footer_bottom' ), 10 );
		add_action( 'addomas_footer_copyright', array( $this, 'footer_copyright' ), 10 );
	}

	/**
	 * Hooked to footer action
	 */
	public function addomas_footer_menu() {
			
		if ( has_nav_menu( 'footer' ) ) : ?>
			<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'addomas' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_class'     => 'footer-menu',
						'depth'          => 1,
					)
				);
				?>
			</nav><!-- .footer-navigation -->
		<?php endif;
			
	}

	/**
	 * Hooked to footer action
	 */
	public function addomas_footer_bottom() {
		?>
		<div class="footer-bottom">
			<div class="am-container site-info">
				<?php do_action('addomas_footer_copyright'); ?>
			</div><!-- .site-info -->			
		</div><!-- .footer-bottom -->
		<?php
	}

	/**
	 * Hooked to footer action
	 */
	public function footer_copyright() {
		?>
		<a href="<?php esc_url( __( 'https://wordpress.org/', 'addomas' ) ); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf( esc_html__( 'Proudly powered by %s', 'addomas' ), 'WordPress' );
			?>
		</a>
		<?php
	}

}
new AddomasTheme_Helper_Class();
