<?php

function solofolio_attachment_caption($attachment) {
  if (!empty($attachment->post_excerpt)) {
    $caption = wptexturize($attachment->post_excerpt);
  } else {
    $caption = wptexturize($attachment->post_content);
  }

  return $caption;
}

?>
