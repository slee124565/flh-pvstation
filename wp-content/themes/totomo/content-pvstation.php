<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package totomo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
        <div class="well">
            <table class="table">
                <caption>統計報告</caption>
                <thead>
                    <tr><th></th><th>今日</th><th>本月</th><th>總計</th></tr>
                </thead>
                <tbody>
                    <tr><th>總累計發電量(kWh)</th><td>181.00</td><td>2999.00</td><td>193398.00</td></tr>
                    <tr><th>減碳量(kg)</th><td>1448.00</td><td>23992.00</td><td>123456.00</td></tr>
                    <tr><th>收益(NTD)</th><td>1448.00</td><td>23992.00</td><td>123456.00</td></tr>
                </tbody>
            </table>
        </div>
        
        <div class="well">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr ><th class="text-center" colspan="3">輸出</th></tr>
                        <tr><th>電壓</th><td>235.28</td><th>V</th></tr>
                        <tr><th>電流</th><td>18.71</td><th>A</th></tr>
                        <tr><th>輸出功率</th><td>8.06</td><th>KW</th></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr><th class="text-center" colspan="3">環境條件</th></tr>
                        <tr><th>日照強度</th><td>235.28</td><th>W/m2</th></tr>
                        <tr><th>環境溫度</th><td>18.71</td><th>C</th></tr>
                        <tr><th>模板溫度</th><td>8.06</td><th>C</th></tr>
                    </table>
                </div>
            </div>
        </div>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'totomo' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'totomo' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
