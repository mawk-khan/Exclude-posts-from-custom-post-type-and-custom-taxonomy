/**
 * Exclude posts with taxonomy 'link' from blog page and display on our bloggers recommend page.
 *
 * @param $query
 * @return void
 */
function expo_exclude_posts_from_custom_post_type_and_custom_taxonomy( $query ) {
    if ( get_the_ID() == 117298 || is_archive() ) {
        // 117298 is the id of the page where we want to display the posts of link category.
        // is_archive() is used to display the posts on archive page of link category.
        return;
    }
    $post_type = $query->get( 'post_type' );

    if ( $post_type[0] == 'blog' ) {
        $query->set( 'tax_query', array(
            array(
                'taxonomy' => 'blog_category',
                'field'    => 'slug',
                'terms'    => array( 'link' ),
                'operator' => 'NOT IN'
            )
        ) );
    }
}
add_action( 'pre_get_posts', 'expo_exclude_posts_from_custom_post_type_and_custom_taxonomy', 100 );
