<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package totomo
 */
    global $wpdb;
    
    $PVI_NAME = "H5";
    $MINUTE_TIME_RAGE_QUERY = 30;
    $INPUT_REGISTER_ADDRESS_VOLTAGE = 1057;
    $INPUT_REGISTER_ADDRESS_CURRENT = 1058;
    $INPUT_REGISTER_ADDRESS_WATTAGE = 1059;
    $INPUT_REGISTER_ADDRESS_ENERGY_TODAY = 1072;
    $INPUT_REGISTER_ADDRESS_DC_LIFE_WH = 1076;
    $t_ac_output_voltage_sql = "select value from pvi_regdata where 
                address = $INPUT_REGISTER_ADDRESS_VOLTAGE
                and pvi_name = '$PVI_NAME'
                and date between date_add(now(), interval -$MINUTE_TIME_RAGE_QUERY MINUTE) and now()
                order by date desc
                limit 1";
    $t_ac_output_voltage = $wpdb->get_var($t_ac_output_voltage_sql);
    if (is_null($t_ac_output_voltage)) {
        $t_ac_output_voltage = 'N/A';
    } else {
        $t_ac_output_voltage = $t_ac_output_voltage * 0.1;
    }
    $t_ac_output_current_sql = "select value from pvi_regdata where 
                address = $INPUT_REGISTER_ADDRESS_CURRENT
                and pvi_name = '$PVI_NAME'
                and date between date_add(now(), interval -$MINUTE_TIME_RAGE_QUERY MINUTE) and now()
                order by date desc
                limit 1";
    $t_ac_output_current = $wpdb->get_var($t_ac_output_current_sql);
    if (is_null($t_ac_output_current)) {
        $t_ac_output_current = 'N/A';
    } else {
        $t_ac_output_current = $t_ac_output_current * 0.01;
    }
    $t_ac_output_wattage_sql = "select value from pvi_regdata where 
                address = $INPUT_REGISTER_ADDRESS_WATTAGE
                and pvi_name = '$PVI_NAME'
                and date between date_add(now(), interval -$MINUTE_TIME_RAGE_QUERY MINUTE) and now()
                order by date desc
                limit 1";
    $t_ac_output_wattage = $wpdb->get_var($t_ac_output_wattage_sql);
    if (is_null($t_ac_output_wattage)) {
        $t_ac_output_wattage = 'N/A';
    }
    $t_dc_life_output_wattage_sql = "select value from pvi_regdata where 
                address = $INPUT_REGISTER_ADDRESS_DC_LIFE_WH
                and pvi_name = '$PVI_NAME'
                and date between date_add(now(), interval -$MINUTE_TIME_RAGE_QUERY MINUTE) and now()
                order by date desc
                limit 1";
    $t_dc_life_output_wattage = $wpdb->get_var($t_dc_life_output_wattage_sql);
    if (is_null($t_dc_life_output_wattage)) {
        $t_dc_life_output_wattage = 'N/A';
        $t_dc_lift_carbon_low = 'N/A';
        $t_dc_life_profit = 'N/A';
    } else {
        $t_dc_life_output_wattage = $t_dc_life_output_wattage * 0.01;
        $t_dc_lift_carbon_low = $t_dc_life_output_wattage * 0.637;
        $t_dc_life_profit = $t_dc_life_output_wattage * 6.8633;
    }
    $t_energy_today_sql = "select value from pvi_regdata where 
                address = $INPUT_REGISTER_ADDRESS_ENERGY_TODAY
                and pvi_name = '$PVI_NAME'
                and date between date_add(now(), interval -$MINUTE_TIME_RAGE_QUERY MINUTE) and now()
                order by date desc
                limit 1";
    $t_energy_today = $wpdb->get_var($t_energy_today_sql);
    if (is_null($t_energy_today)) {
        $t_energy_today = 'N/A';
        $t_energy_today_carbon_low = 'N/A';
        $t_energy_today_profit = 'N/A';
    } else {
        $t_energy_today = $t_energy_today * 0.01;
        $t_energy_today_carbon_low = $t_energy_today * 0.637;
        $t_energy_today_profit = $t_energy_today * 6.8633;
    }
    //var_dump($t_dc_life_output_wattage_sql);exit;
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
                    <tr><th>總累計發電量(kWh)</th><td><?php echo sprintf("%.2f",$t_energy_today); ?></td><td>N/A</td><td><?php echo sprintf("%.2f",$t_dc_life_output_wattage); ?></td></tr>
                    <tr><th>減碳量(kg)</th><td><?php echo sprintf("%.2f", $t_energy_today_carbon_low); ?></td><td>N/A</td><td><?php echo sprintf("%.2f",$t_dc_lift_carbon_low); ?></td></tr>
                    <tr><th>收益(NTD)</th><td><?php echo sprintf("%.2f",$t_energy_today_profit); ?></td><td>N/A</td><td><?php echo sprintf("%.2f",$t_dc_life_profit); ?></td></tr>
                </tbody>
            </table>
        </div>
        
        <div class="well">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr ><th class="text-center" colspan="3">輸出</th></tr>
                        <tr><th>電壓</th><td><?php echo $t_ac_output_voltage; ?></td><th>V</th></tr>
                        <tr><th>電流</th><td><?php echo $t_ac_output_current; ?></td><th>A</th></tr>
                        <tr><th>輸出功率</th><td><?php echo $t_ac_output_wattage; ?></td><th>W</th></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr><th class="text-center" colspan="3">環境條件</th></tr>
                        <tr><th>日照強度</th><td>N/A</td><th>W/m2</th></tr>
                        <tr><th>環境溫度</th><td>N/A</td><th>C</th></tr>
                        <tr><th>模板溫度</th><td>N/A</td><th>C</th></tr>
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
