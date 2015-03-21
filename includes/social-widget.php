<?php
class solofolio_social_widget extends WP_Widget {

  function solofolio_social_widget() {
    parent::WP_Widget(false, $name = 'Solofolio Social Media');
  }

  function widget( $args, $i ) {
    extract( $args );
    global $wpdb;

    echo $before_widget;
    echo "<div class=\"solofolio-social\">";
      echo $this->widgetLink( $this->fNilVal( $i, 'facebook'),  $this->fNilKey( $i, 'icon_1', 'facebook'));
      echo $this->widgetLink( $this->fNilVal( $i, 'twitter'),   $this->fNilKey( $i, 'icon_2', 'twitter'));
      echo $this->widgetLink( $this->fNilVal( $i, 'instagram'), $this->fNilKey( $i, 'icon_3', 'instagram'));
      echo $this->widgetLink( $this->fNilVal( $i, 'blink'),     $this->fNilKey( $i, 'icon_4', 'map-marker'));
      echo $this->widgetLink( $this->fNilVal( $i, 'vimeo'),     $this->fNilKey( $i, 'icon_5', 'vimeo-square'));
      echo $this->widgetLink( $this->fNilVal( $i, 'linkedin'),  $this->fNilKey( $i, 'icon_6', 'linkedin'));
  	echo "</div>";
  	echo $after_widget;
  }

  function update( $new_instance, $i ) {
    foreach (array_keys($new_instance) as $key) {
      $i[$key] = strip_tags($new_instance[$key]);
    }

    return $i;
  }

  function form( $i ) {
    ?>
    <p>
      <?php echo $this->selectIcon('icon_1',    $this->fNilKey($i, 'icon_1', 'facebook')); ?>
      <?php echo $this->inputField('facebook',  $this->fNilVal($i, 'facebook')); ?>
    </p>
    <p>
      <?php echo $this->selectIcon('icon_2',    $this->fNilKey($i, 'icon_2', 'twitter')); ?>
      <?php echo $this->inputField('twitter',   $this->fNilVal($i, 'twitter')); ?>
    </p>
    <p>
      <?php echo $this->selectIcon('icon_3',    $this->fNilKey($i, 'icon_3', 'instagram')); ?>
      <?php echo $this->inputField('instagram', $this->fNilVal($i, 'instagram')); ?>
    </p>
    <p>
      <?php echo $this->selectIcon('icon_4',    $this->fNilKey($i, 'icon_4', 'map-marker')); ?>
      <?php echo $this->inputField('blink',     $this->fNilVal($i, 'blink')); ?>
    </p>
    <p>
      <?php echo $this->selectIcon('icon_5',    $this->fNilKey($i, 'icon_5', 'vimeo-square')); ?>
      <?php echo $this->inputField('vimeo',     $this->fNilVal($i, 'vimeo')); ?>
    </p>
    <p>
      <?php echo $this->selectIcon('icon_6',    $this->fNilKey($i, 'icon_6', 'linkedin')); ?>
      <?php echo $this->inputField('linkedin',  $this->fNilVal($i, 'linkedin')); ?>
    </p>
    <?php
  }

  function selectIcon( $slug, $value ) {
    ?> <select id="<?php echo $this->get_field_id($slug); ?>" name="<?php echo $this->get_field_name($slug); ?>" class="widefat">
      <?php foreach ($this->iconOptions() as $option) {
        echo '<option value="' . $option[1] . '" id="' . $option[1] . '"', $value == $option[1] ? ' selected="selected"' : '', '>', $option[0], '</option>';
      } ?>
    </select> <?php
  }

  function inputField( $slug, $value ) {
    ?><input class="widefat" id="<?php echo $this->get_field_id($slug); ?>" name="<?php echo $this->get_field_name($slug); ?>" type="text" value="<?php echo $value; ?>" /> <?php
  }

  function widgetLink( $value, $icon_slug ) {
    if (!empty($value)) {
      return "<a target=\"_blank\" href=\"" . $value . "\"><i class=\"fa fa-" . $icon_slug . "\"></i></a>";
    }
  }

  function fNilKey( $array, $key, $default ) {
    return ( array_key_exists( $key, $array ) ? esc_attr( $array[$key] ) : $default );
  }

  function fNilVal( $array, $key ) {
    if (array_key_exists( $key, $array )) {
      return apply_filters('widget_title', $array[$key]);
    } else {
      return '';
    }
  }

  function iconOptions() {
    return array( array('Facebook',      'facebook'),
                  array('Dribbble',      'dribbble'),
                  array('Google Plus',   'google-plus'),
                  array('Instagram',     'instagram'),
                  array('LinkedIn',      'linkedin'),
                  array('Blink',         'map-marker'),
                  array('Medium',        'medium'),
                  array('Pinterest',     'pinterest-p'),
                  array('Tumblr',        'tumblr'),
                  array('Twitter',       'twitter'),
                  array('Vimeo',         'vimeo-square'),
                  array('Youtube',       'youtube-play'));
  }
}
add_action('widgets_init', create_function('', 'return register_widget("solofolio_social_widget");'));
?>
