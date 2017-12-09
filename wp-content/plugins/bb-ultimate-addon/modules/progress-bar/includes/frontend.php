<div class="uabb-module-content uabb-pb-container">
	<ul class="uabb-pb-list <?php echo ( $settings->vertical_responsive == 'yes' ) ? 'uabb-responsive-list' : ''; ?>">
		<?php
		if( count( $settings->horizontal ) > 0 ) {
			for( $i = 0; $i < count( $settings->horizontal ); $i++ ) {
				$tmp = $settings->horizontal;
				if( is_object( $tmp[$i] ) ) {
					$style = ( $settings->layout == 'horizontal' ) ? $settings->horizontal_style : $settings->vertical_style;
					$tmp[$i]->horizontal_number = ( $tmp[$i]->horizontal_number != '' ) ? $tmp[$i]->horizontal_number : '80';
		?><li>
			<div class="uabb-progress-bar-wrapper uabb-vertical-center uabb-layout-<?php echo $settings->layout; ?> uabb-progress-bar-style-<?php echo $style; ?> uabb-progress-bar-<?php echo $i; ?>" data-number="<?php echo  ( $settings->layout != 'circular' ) ? $tmp[$i]->horizontal_number : ''; ?>">
				<?php
				if( $settings->layout == 'horizontal' ) {
					$module->render_horizontal_content( $tmp[$i], 'style1', '', $i );
					$module->render_horizontal_content( $tmp[$i], 'style4', 'above', $i );
					$module->render_horizontal_progress_bar( $tmp[$i], $i );
					$module->render_horizontal_content( $tmp[$i], 'style2', '', $i );
					$module->render_horizontal_content( $tmp[$i], 'style4', 'below', $i );
				} else if( $settings->layout == 'vertical' ) {
					$module->render_vertical_content( $tmp[$i], 'style1', $i );
					$module->render_vertical_progress_bar( $tmp[$i], $i );
					$module->render_vertical_content( $tmp[$i], 'style2', $i );
					$module->render_vertical_content( $tmp[$i], 'style3', $i );
				} else if( $settings->layout == 'circular' ) {
				?>
				<div class="uabb-percent-wrap">
					<span class="uabb-percent-before-text uabb-ba-text"><?php echo $tmp[$i]->circular_before_number; ?></span>
					<div class="uabb-percent-counter">0%</div>
					<span class="uabb-percent-after-text uabb-ba-text"><?php echo $tmp[$i]->circular_after_number; ?></span>
				</div>
				<div class="uabb-svg-wrap" data-number="<?php echo $tmp[$i]->horizontal_number; ?>">
					<?php $module->render_circle_progress_bar( $tmp[$i], $i ); ?>
				</div>
				<?php
				} else if( $settings->layout == 'semi-circular' ) {
				?>
				<div class="uabb-percent-wrap">
					
					<div class="uabb-percent-counter">0%</div>
				</div>
				<div class="uabb-svg-wrap" data-number="<?php echo $tmp[$i]->horizontal_number; ?>">
					<?php $module->render_semi_circle_progress_bar( $tmp[$i], $i ); ?>
					
				</div>
				<span class="uabb-semi-progress-before uabb-ba-text"><?php echo $tmp[$i]->circular_before_number; ?></span>
				<span class="uabb-semi-progress-after uabb-ba-text"><?php echo $tmp[$i]->circular_after_number; ?></span>
				<?php
				}
				?>
			</div>
		</li><?php
				}
			}
		}
		?></ul>
</div>		