<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package totomo
 */
    global $wpdb;
    
    $t_siteurl_sql = 'select option_value from wp_options where option_name = "siteurl"';
    $t_siteurl = $wpdb->get_var($t_siteurl_sql);

    $pvi_name = 'H5';
    $pvs_meta_json = file_get_contents($t_siteurl . "/appeng/pvs_meta/");
    $pvs = json_decode($pvs_meta_json);
    //var_dump($pvs->dc_output->H5);exit;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
        <div class="well">
            <caption><strong><?php esc_html_e( 'Hourly Energy Output', 'totomo' ); ?></strong></caption>
            <?php amcharts_insert( 'pvs_chart-5' ); ?>
        </div>
        <div class="well">
            <table class="table">
                <caption><strong><?php esc_html_e( 'Statistic Report', 'totomo' ); ?></strong></caption>
                <thead>
                    <tr><th></th><th><?php esc_html_e( 'Today', 'totomo' ); ?></th>
                    <th><?php esc_html_e( 'This Month', 'totomo' ); ?></th>
                    <th><?php esc_html_e( 'Until Now', 'totomo' ); ?></th></tr>
                </thead>
                <tbody>
                    <tr><th><?php esc_html_e( 'Energy Output(kWh)', 'totomo' ); ?></th>
                        <td><?php echo $pvs->pvs_static->today->total_eng_kwh; ?></td>
                        <td><?php echo $pvs->pvs_static->this_month->total_eng_kwh; ?></td>
                        <td><?php echo $pvs->pvs_static->until_now->total_eng_kwh; ?></td></tr>
                    <tr><th><?php esc_html_e( 'Carbon Saving (kg)', 'totomo' ); ?></th>
                        <td><?php echo $pvs->pvs_static->today->total_carbon_save; ?></td>
                        <td><?php echo $pvs->pvs_static->this_month->total_carbon_save; ?></td>
                        <td><?php echo $pvs->pvs_static->until_now->total_carbon_save; ?></td></tr>
                    <tr><th><?php esc_html_e( 'Profit (NTD)', 'totomo' ); ?></th>
                        <td><?php echo $pvs->pvs_static->today->total_income; ?></td>
                        <td><?php echo $pvs->pvs_static->this_month->total_income; ?></td>
                        <td><?php echo $pvs->pvs_static->until_now->total_income; ?></td></tr>
                </tbody>
            </table>
        </div>
        
        <div class="well">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr ><th class="text-center" colspan="3"><?php esc_html_e( 'Current Output', 'totomo' ); ?></th></tr>
                        <tr><th><?php esc_html_e( 'Voltage', 'totomo' ); ?></th><td><?php echo $pvs->dc_output->{$pvi_name}->voltage; ?></td><th>V</th></tr>
                        <tr><th><?php esc_html_e( 'Current', 'totomo' ); ?></th><td><?php echo $pvs->dc_output->{$pvi_name}->current; ?></td><th>A</th></tr>
                        <tr><th><?php esc_html_e( 'Power', 'totomo' ); ?></th><td><?php echo $pvs->dc_output->{$pvi_name}->wattage; ?></td><th>W</th></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr><th class="text-center" colspan="3"><?php esc_html_e( 'Environment', 'totomo' ); ?></th></tr>
                        <tr><th><?php esc_html_e( 'UV Index', 'totomo' ); ?></th><td><?php echo $pvs->environment->uv_index; ?></td><th></th></tr>
                        <tr><th><?php esc_html_e( 'Temperature', 'totomo' ); ?></th><td><?php echo $pvs->environment->temperature; ?></td><th>C</th></tr>
                        <tr><th><?php esc_html_e( 'Visibility', 'totomo' ); ?></th><td><?php echo $pvs->environment->visibility; ?></td><th>Km</th></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="well">
            <caption><strong><?php esc_html_e('Daily Energy Output', 'totomo'); ?></strong></caption>
            <?php amcharts_insert( 'energy_output_daily_trend' ); ?>
        <div>
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
