<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 4/25/15
 * Time: 3:32 PM
 */
?>
<div class="search">

    <form class="form-search" method="get" action="<?php echo esc_url(home_url('/')) ?>">
        <input type="text" class="form-control" name="s" placeholder="<?php esc_html_e('Type To search','bs-smarty')?>" value="<?php echo get_query_var('s')?>">
        <button type="submit" class="btn search-btn"><?php esc_html_e('Search','bs-smarty')?></button>

    </form>
</div>