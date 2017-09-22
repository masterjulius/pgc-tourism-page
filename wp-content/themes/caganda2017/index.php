<?php get_header(); ?>

<div class="container-fluid" id="main-container-home">

	<div class="container-fluid" id="middle-content">

		<div class="class1">
			<?php if ( is_active_sidebar( 'widget-2' ) ) : ?>
				<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
					<?php dynamic_sidebar( 'widget-2' ); ?>
				</div><!-- #primary-sidebar -->
			<?php endif; ?>
		</div>
			<!-- This is the End of the Slider Widget -->

		<div class="row class2">
			<div class="card">
				<div class="col s12 m12 l12 center">
					<?php if ( is_active_sidebar( 'widget-3' ) ) : ?>
						<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
							<?php dynamic_sidebar( 'widget-3' ); ?>
						</div><!-- #primary-sidebar -->
					<?php endif; ?>
				</div>
			</div>
		</div>
			<!-- This is the End of the Main Contents Container -->
		
		<div class="row" id="cag-theme-main-contents">
			
			<div class="col s12 m9 l9">
				<?php if ( is_active_sidebar( 'widget-4' ) ) : ?>
					<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
						<?php dynamic_sidebar( 'widget-4' ); ?>
					</div><!-- #primary-sidebar -->
				<?php endif; ?>
			</div>

			<div class="col s12 m3 l3">
				<?php if ( is_active_sidebar( 'widget-5' ) ) : ?>
					<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
						<?php dynamic_sidebar( 'widget-5' ); ?>
					</div><!-- #primary-sidebar -->
				<?php endif; ?>
			</div>

		</div>

	</div>

	<!-- After Contents -->
	<div class="container-fluid">
		
		<?php if ( is_active_sidebar( 'widget-6' ) ) : ?>
			<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
				<?php dynamic_sidebar( 'widget-6' ); ?>
			</div><!-- #primary-sidebar -->
		<?php endif; ?>

	</div>
	<!-- End of After Contents -->

</div>
<?php get_footer(); ?>