<form method="get" class="searchform" action="<?php echo esc_url(home_url()); ?>/">
  <input type="text"
         value="<?php _e( 'Search', 'solofolio' ); ?>"
         name="s"
         id="s"
         onblur="if (this.value == '') {this.value = 'Search';}"
         onfocus="if (this.value == 'Search') {this.value = '';}" />
  <span><button type="submit" class="sidebar-search fa fa-search"></button></span>
</form>
