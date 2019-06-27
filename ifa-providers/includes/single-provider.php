<?php
/**
* WHAT: IFA PROVIDER CTP Template
* WHEN: June 2019
* WHY: Because we need one for IFA 2.
* WHO (author): Michael Wedd
* NOTES: This post type is registered in the must-use plugin "IFA Custom Post Types," located at: ../mu-plugins/ifa-post-types.php
* This template (a hack) is completely dependant on the Newspaper theme. 
* I've made efforts to reduce this templates dependency on other theme files in order to reduce complexity,
* by pulling the code from previously referenced files into this file.  
* Updates to the Newspaper theme could break this template. Fun right? TBD!
* This template uses SVG icons, so you'll need this plugin to run the template: https://wordpress.org/plugins/safe-svg/
*/
    locate_template('includes/wp_booster/td_single_template_vars.php', true);
    get_header();

    global $loop_module_id, $loop_sidebar_position, $post, $td_sidebar_position;

    $td_mod_single = new td_module_single($post);
    $td_block_11 = new td_block_11();
    $td_block_14 = new td_block_14();
    $td_block_8 = new td_block_8();
    // for trending article filter.
    $promoted_id = get_term_by('slug', 'promoted', 'category');
    $related_promoted_posts = $td_mod_single->related_promoted_posts();
?>
<!-- Styles are placed here a) to limit the scope of these modifications to this template, not all posts, since there are mods to theme-level elements, 
and b) to decouple the template as much as possible from the theme. There is some cost to load speed but nothing major.
Some tyles are declared inline to wrestle control from the theme.-->
<style>
p {
    font-size: 14px !important;
    line-height: 20px !important;
}
.wp_ulike_general_class, 
.sidebar-share-text, 
.wp-caption-text, 
.td-category, 
.td-social-sidebar, 
.td-crumb-container, 
.swp_social_panel {
  display: none !important;
}
.provider-practices-container {
    display: flex;
    margin-left: 33px;
}
.provider-practices {
    background-color: #ecf0f3; 
    color: #9b9cac; 
    display: flex; 
    border-radius: 4px; 
    font-weight: 400; 
    font-size: 14px;
    cursor: pointer; 
    margin-right: 8px;
    padding: 2px 15px;
}
.provider-practices:hover {
    background-color: #fff;
    box-shadow: 1px 1px 6px 0 rgba(0, 0, 0, 0.1);
}
.see-solutions-button {
    background-color: #22af96; 
    color: white; 
    height: 38px; 
    border: 0; 
    border-radius: 4px;
    cursor: pointer;
}
.see-solutions-button:hover {
    transform: scale(1.03);
    background-color: #1c8991;
    transition: all 250ms ease;
}
.see-solutions-link {
    text-decoration: none; 
    color: white; 
    font-size: 14px; 
    padding: 9px 15px; 
}
.gray-divider-above-top-bar {
    background-color: #edf0f3; 
    width: 100%; 
    height: 102px;
}
.provider-top-bar {
    background-color: #fff; 
    width: 100%; 
    height: 64px; 
    display: flex; 
    align-items: center;
    justify-content: space-around; 
    box-shadow: 1px 1px 3px 0 rgba(0, 0, 0, 0.1); 
}
.top-bar-content-container {
    display: flex; 
    justify-content: space-between; 
    align-items: center; 
    height: 100%; 
    width: 100%; 
    max-width: 1000px;
}
.logo-and-practices-container {
    display: flex; 
    align-items: center;
}
.provider-logo-wrapper {
    width: 52px;
    height: 52px;
}

.provider-logo-wrapper > img{
    width: 100%;
    width: 60px;
}
.provider-logo {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 75px;
    height: 75px;
    border-radius: 100px; 
    background-color: #fff; 
    box-shadow: 1px 1px 3px 0 rgba(0, 0, 0, 0.25); 
}
/* ================= */
/* PROVIDER INFO BOX */
.provider-info-box {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 160px;
    height: 130px;
    font-size: 14px;
    color: #333;
}
.provider-name-info-box {
    margin: 0;
}
.link-icon {
    width: 16px;
    height: 16px;
    margin-right: 8px;
    opacity: 1;
}
.provider-website-link:link, 
.provider-website-link:visited {
    color: #333;
}
.provider-website-link:hover,
.link-icon:hover,
.provider-website-link:active {
    transition: all 200ms ease;
    color: #05b0bd !important;
}
.provider-social-container {
    display: flex;
}
/* must give containing class otherwise other social bars on the page are affected. */
.provider-social-container .td-icon-font {
    color: black;
    size: 16px;
}
/* so that social bar is aligned with link and title... -_- */
.provider-social-container .td-social-icon-wrap:first-of-type {
    margin-left: -10px;
}
/* ================= */
/* MAIN CONTENT AREA */
.provider-main-area {
    display: flex;
    height: auto;
    margin-top: 2px;
    padding-top: 80px;
    padding-bottom: 80px;
    justify-content: center;
    background-color: #edf0f3;
}
.provider-main-content-container {
    display: flex;
    justify-content: center;
    max-width: 1000px;
    width: 100%;
    font-family: 'Open Sans', sans-serif;
    color: rgba(0, 0, 0, 0.5);
}
.provider-body-container {
    width: 550px;
    height: auto;
    padding: 24px 40px 32px;
    margin-left: 30px;
    margin-right: 30px;
    border-radius: 4px;
    background-color: #fff;
    box-shadow: 1px 1px 3px 0 rgba(0, 0, 0, 0.2);
}
.provider-name-body {
    margin-bottom: 24px;
    font-family: 'Open Sans', sans-serif;
    font-size: 16px !important;
    line-height: 24px !important;
}
.provider-featured-banner {
    border-radius: 4px;
}
/* .td-post-featured-image, 
} */
.provider-featured-banner:hover {
    transition: all 300ms ease;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    cursor: pointer; 
    transform: scale(1.01);
}
.about-provider {

}
.provider-heading-2 {
    margin-top: 0px;
    margin-bottom: 24px;
    font-family: 'Open Sans', sans-serif;
    font-size: 16px;
    line-height: 24px;
    font-weight: bold;
    color: #333;
}
  
/* OUR SOLUTIONS CUSTOM SIDEBAR */
.our-solutions-container {
    width: 240px;
    height: 300px;;
    padding-right: 16px;
    padding-bottom: 24px;
    padding-left: 16px;
    padding: 24px 40px 32px;
    border-radius: 4px;
    background-color: #fff;
    box-shadow: 1px 1px 3px 0 rgba(0, 0, 0, 0.2);
}
.our-solutions-container .td-module-meta-info, 
.our-solutions-container .entry-thumb {
    display: none !important;
}

.our-solutions-container .td_module_7 .item-details {
    margin-right: 0 !important;
    min-height: 0px;
}
.our-solutions-container .td_module_7 {
    padding-bottom: 10px !important;
}
</style>
<?php
    if (have_posts()) {
        the_post();
        $td_mod_single = new td_module_single($post);
        global $loop_sidebar_position, $part_cur_auth_obj;
        // get the author/provider object by the url route.
        $part_cur_auth_obj = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
        $providerID = get_the_author_meta('ID', $part_cur_auth_obj->ID);
        $providerName = get_the_author_meta('display_name', $providerID);
        $providerCategoriesArr = get_the_terms($post->ID, 'category' );
        $providerWebsiteLink = get_the_author_meta('user_url', $providerID);
        // echo $td_mod_single->get_social_sharing_side(); // potentially cut this out
?>
        <!-- BEGIN TOP SECTION (ABOVE BODY) -->
        <section class="td-main-content-wrap">
            <div class="gray-divider-above-top-bar"></div>
                <div class="provider-top-bar">
                    <div class="top-bar-content-container">
                    <div class="logo-and-practices-container">
                        <div class="provider-logo">
                            <div class="provider-logo-wrapper">
                                <?php 
                                    echo get_avatar($providerID);
                                ?>
                            </div> 

                        </div>
                        <div class="provider-practices-container">
                        <?php 
                            foreach ( $providerCategoriesArr as $cat ) { ?>
                                <a href="<?php echo get_term_link($cat->slug, 'category'); ?>" target="_blank">
                                    <div className="provider-practices">
                                        <?php echo $cat->name; ?>
                                    </div>
                                </a>
                        <?php } ?>

                        </div>
                    </div>
                    <button class="see-solutions-button">
                        <a href="<?php echo esc_url($providerWebsiteLink)?>" class="see-solutions-link" target="_blank">
                            See Our Solutions
                        </a>
                    </button>
                </div>
            </div>
        </section>
        <!-- This is the provider main content area div, containing everything above the filter block section -->
        <main class="provider-main-area">
            <div class="provider-main-content-container">
                <section class="provider-info-box">
                    <h2 class="provider-name-info-box">
                        <?php 
                            echo $providerName;
                        ?>
                    </h2>
                    <?php  
                        echo '<a class="provider-website-link" href="' . esc_url($providerWebsiteLink) . '" target="_blank">' . '<img class="link-icon" src="https://staging-iotforall.kinsta.cloud/wp-content/uploads/2019/06/link.svg">' . $providerName . '.com' . '</a>';
                    ?>
                    <div class="provider-social-container">
                        <?php
                            foreach (td_social_icons::$td_social_icons_array as $td_social_id => $td_social_name) {
                                $authorMeta = get_the_author_meta($td_social_id, $providerID);
                                if (!empty($authorMeta)) {
                                    echo td_social_icons::get_icon($authorMeta, $td_social_id, true );
                                }
                            }
                        ?>
                    </div>
                </section>
                <div class="provider-body-container">
                    <div class="provider-name-body">
                        <h2 class="provider-heading-2">About <?php echo $providerName; ?></h2>
                    </div>
                    <div class="about-provider">
                        <div class="provider-featured-banner">
                            <a href="<?php echo esc_url($providerWebsiteLink)?>" target="_blank">
                                <?php echo $td_mod_single->get_image(td_global::$load_featured_img_from_template); ?>
                            </a>
                        </div>
                        <?php echo $td_mod_single->get_content();?>
                    </div>
                </div>
                <div class="our-solutions-container">
                    <h2 class="provider-heading-2">Our Solutions<h2>
                    <?php echo $td_block_8->render(array('limit' => 4, 'category_ids' => -21898, -1 * $promoted_id->term_id));?>
                </div>
            </div>
        </main>
        <div class="td-pb-span12 td-main-content">

        </div>
        <div class="td-container td-post-template-default <?php echo $td_sidebar_position; ?>">
            <div class="td-crumb-container"><?php echo td_page_generator::get_single_breadcrumbs($td_mod_single->title); ?></div>
                <div class="td-pb-row">
                    <div class="td-pb-span8 td-main-content" role="main">
                        <div class="td-ss-main-content">
                            <article id="post-<?php echo $td_mod_single->post->ID;?>" class="<?php echo join(' ', get_post_class());?>" <?php echo $td_mod_single->get_item_scope();?>>
                                <footer>
                                    <div class="td-post-source-tags">
                                        <?php echo $td_mod_single->get_the_tags();?>
                                    </div>
                                </footer>
                            </article> 
<?php
    } else {
        // this else is for when there's no provider post to render. See the if() above of which this block is the else.
        echo td_page_generator::no_posts();
    }
    comments_template('', false);
?>
                    </div>
                </div>

            <!-- the div immediately below renders the "more providers" filter block, but it slides up on the right currently. -->
            <div class="wpb_wrapper td-block-title-wrap td_block_14 td_block_inner" style="margin-top: 50px;">
                <!-- This is a custom title "More providers" for the filter/block immediately below. -->
                <!-- The crazy inline bordering with the spans is to replicate Zaz's two-tone bottom border for the filter section titles -->
                <h4 class="td-block-title">
                    <span class="td-pulldown-size more-providers-block" style="font-weight: 550; display: flex;">
                        <span style="border-bottom: 2px solid #2ec9b9;">Solu</span>
                        <span style="border-bottom: 2px solid #F5F5F5; width: 100%;">tions</span>
                    </span>
                </h4>
                <!-- The td-column-3 div below renders the row of related providers immediately below the body of the post/provider  -->
                <div class="td-column-3 td-pb-span4 width100p">
                    <?php echo $td_block_14->render(array('limit' => 3,'category_ids' => 45));?>
                </div>
            </div>
            <div class="vc_row wpb_row td-pb-row td-sidebar-guide">
                <div class="wpb_column vc_column_container td-pb-span8">
                    <?php echo $td_block_11->render(array('ajax_pagination' => 'load_more', 'offset' => 3, 'category_ids' => 45));?>
                </div>
                <!-- This is a custom title "Trending" for the filter/block immediately below. -->
                <h4 class="td-block-title">
                    <span class="td-pulldown-size trending-block-title" style="font-weight: 550; display: flex; padding-left: 22px;">
                        <span style="border-bottom: 2px solid #2ec9b9;">Inte</span>
                        <span style="border-bottom: 2px solid #F5F5F5; width: 100%; margin-right: 22px;">rviews</span>
                    </span>
                </h4>
                <div class="wpb_column vc_column_container td-pb-span4">
                    <?php echo $td_block_8->render(array('limit' => 4, 'category_ids' => -21898, -1 * $promoted_id->term_id));?>
                </div>
            </div>
        </div> <!-- /.td-container -->
    </div> <!-- /.td-main-content-wrap -->
<?php
    get_footer();
?>