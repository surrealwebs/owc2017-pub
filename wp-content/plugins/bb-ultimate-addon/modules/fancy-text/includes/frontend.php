<div class="uabb-module-content uabb-fancy-text-node">
<?php if( !empty($settings->effect_type) ) {?>
<?php echo '<'.$settings->text_tag_selection;?> class="uabb-fancy-text-wrap uabb-fancy-text-<?php echo $settings->effect_type; ?>"><!--
	--><span class="uabb-fancy-text-prefix"><?php echo $settings->prefix; ?></span><?php echo '<!--';?>
	<?php
		$output = '';
		
		if($settings->effect_type == 'type') { 
			$output = '';
			$output .= '--><span class="uabb-fancy-text-main uabb-typed-main-wrap">'; 
	            $output .= '<span class="uabb-typed-main">';
				$output .= '</span>'; 
			$output .= '</span><!--';
			echo $output;
		} 
		
		if( $settings->effect_type == 'slide_up') {
			$adjust_class = '';

            $order   = array("\r\n", "\n", "\r", "<br/>", "<br>");
			$replace = '|';

            $str = str_replace($order, $replace, trim( $settings->fancy_text ) );
            $lines = explode("|", $str);
            $count_lines = count($lines);
			$output = '';

			/*if( $settings->prefix != '' && $settings->suffix != '' ){ 
				$adjust_class = " uabb-adjust-width"; 
			}*/

            $output .= '--><span class="uabb-fancy-text-main  uabb-slide-main'.$adjust_class.'">';
				$output .= '<span class="uabb-slide-main_ul">';
						foreach($lines as $key => $line)
						{
							$output .= '<span class="uabb-slide-block">';
							$output .= '<span class="uabb-slide_text">'.strip_tags($line).'</span>';
							$output .= '</span>';
							if ( $count_lines == 1 ) {
								$output .= '<span class="uabb-slide-block">';
								$output .= '<span class="uabb-slide_text">'.strip_tags($line).'</span>';
								$output .= '</span>';
							}
						}
				$output .= '</span>';
			$output .= '</span><!--';
			echo $output;
		}
	?>
	
	<?php echo '-->'; ?><span class="uabb-fancy-text-suffix"><?php echo $settings->suffix; ?></span>
<?php echo '</'.$settings->text_tag_selection.'>';?>
<?php } ?>
</div>