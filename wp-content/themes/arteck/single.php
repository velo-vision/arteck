<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 3/1/15
 * Time: 6:18 PM
 */
get_header();

do_action('bravo_before_main_content');

$sidebar=bravo_get_sidebar();
$class=false;
$bg=bravo_get_option('blog_background_image');
if(is_singular() and $meta=get_post_meta( get_the_ID(), '_background_image', true)) $bg=$meta;
if($bg ){
	$class=BravoAssets::build_css('
			background-image:url(\''.$bg.'\')
		');
}
while(have_posts()){
    the_post();

    ?>
    <div class="single-page <?php echo esc_attr($class) ?> <?php echo 'sitebar-'.$sidebar['position'] ?>">
        <div class="section-content bg-pattern dark-screen">
            <div class="container clearfix">

                <?php if($sidebar['position']=='left') get_sidebar(); ?>
                <div class="bravo-main-content <?php echo ($sidebar['position']=='left' or $sidebar['position']=='right')?'content-main':FALSE ?>">
                    <?php
                    if(!get_post_meta(get_the_ID(),'hide_page_title',true)){
                        echo('<h1 class="page-top-heading">'.bravo_get_option('post_blog_title','Blog').'</h1>');
                    }
                    ?>
                    <div <?php post_class('blog-layout-single')?>>
                        <article class="blog-item">
                            <div class="blog-img">
                                <?php get_template_part('single-content') ?>
                            </div>
                            <div class="blog-content clearfix">
                                <h4><?php the_title()?></h4>
                                <div class="blog-details">
                                    <?php
                                    printf(esc_html__('By %s','bs-smarty'),'<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a>');
                                    echo '<span class="delimiter-inline-alt"></span>';
                                    printf(esc_html__('In %s','bs-smarty'),get_the_term_list(get_the_ID(),'category',false,', '));
                                    if(get_comments_number()) {
                                        echo '<span class="delimiter-inline-alt"></span>';
                                        printf(esc_html__('Comments: %s', 'bs-smarty'), sprintf('<a href="%s" >%d</a>', get_comments_link(), get_comments_number()));
                                    }

                                    echo '<span class="delimiter-inline-alt"></span>';
                                    printf(esc_html__('Tags: %s','bs-smarty'),get_the_tag_list(false,', '));

                                    ?>
                                </div>

                                <?php the_content();
                                wp_link_pages( array(
                                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'bs-smarty' ) . '</span>',
                                    'after'       => '</div>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'bs-smarty' ) . ' </span>%',
                                    'separator'   => '<span class="">, </span>',
                                ) );


                                ?>


                            </div>

                        </article>
                    </div>
                    <?php
                    if(comments_open()){
                        comments_template();
                    }?>

                </div>
                <?php if($sidebar['position']=='right') get_sidebar(); ?>
            </div>
        </div>
    </div>
    <!-- BLOG PAGE TITLE -->


    <?php

}
get_footer();