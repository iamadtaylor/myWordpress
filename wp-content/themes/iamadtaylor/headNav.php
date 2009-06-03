				<div id="header" class="clearfix">
					<ol>

						<?php wp_list_pages('title_li=&sort_column=menu_order'); ?>
						<?php $cat = wp_list_categories('echo=0&include=3&title_li=&use_desc_for_title=0&style=none'); if(is_category('3')) {echo '<li class="current_page_item">';} else {echo '<li>';}  echo str_replace(array('<br/>'), '', $cat)."</li>";?>
						<?php $cat2 = wp_list_categories('echo=0&include=5&title_li=&use_desc_for_title=0&style=none'); if(is_category('5')) {echo '<li class="current_page_item">';} else {echo '<li>';} echo str_replace(array('<br/>'), '', $cat2)."</li>";?> 
						
					</ol>

				</div>
				