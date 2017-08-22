<?php
add_filter('post_gallery', 'my_post_gallery', 10, 2);

function my_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr)); 
    $id = intval($id);

    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'ord    er' => $order, 'orderby' => $orderby));
        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    $output = "<div id='gallery-container' class=\"gallery-container\" ";
    $output .= "data-images=\"" . count ( $attachments ) . "\" ";
    $output .= "data-img-show-count=\"" .get_option('mc_17_showphotoscount') . "\">\n";
  
    foreach ($attachments as $id => $attachment) {

        $img = wp_get_attachment_image_src($id, 'thumbnail');
        $linkToFullImg = wp_get_attachment_image_src($id, 'full');
        $imgAlt = get_post_meta($id,'_wp_attachment_image_alt', true);
        $imgDesc = $attachment->post_content;
        $imgTitle = $attachment->post_title;
        $imgCaption = $attachment->post_excerpt;
        $output .= "<div class='gallery-thumb'>\n";
        $output .= "<a class='link-to-full-img' href=\"{$linkToFullImg[0]}\">";
        $output .= "<img src=\"{$img[0]}\" alt=\"{$imgAlt}\" ";
        $output .= "data-description=\"{$imgDesc}\" ";
        $output .= "data-show-description=\"".get_option('mc_17_showdescription')."\" ";
        $output .= "data-title=\"{$imgTitle}\" ";
        $output .= "data-caption=\"{$imgCaption}\" ";
        $output .= "/>\n";
        $output .= "</a>";
        $output .= "</div>\n";
    }

    $output .= "</div>\n";

    return $output;
} 