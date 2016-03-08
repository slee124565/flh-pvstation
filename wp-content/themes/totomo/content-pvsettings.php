<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package totomo
 */
    global $wpdb, $page;
    
    $t_page_url = get_permalink();
    
    #-> get inverter settings from db
    $t_sql = 'select json_data from dbconfig_appoption where app_name = "pvi"';
    $t_json_pvi = $wpdb->get_var($t_sql);
    $t_pvi_config = json_decode($t_json_pvi);
    //var_dump($t_pvi_config);
    
    #-> get serial settings from db
    $t_serial_config = $t_pvi_config[0]->serial;
    //var_dump($t_serial_config);

    #-> get location settings from db
    $t_sql = 'select json_data from dbconfig_appoption where app_name = "accuweather"';
    $t_json_location = $wpdb->get_var($t_sql);
    $t_location_config = json_decode($t_json_location);
    //var_dump($t_location_config);

    #-> get appeng settings from db
    $t_sql = 'select json_data from dbconfig_appoption where app_name = "pvappengine"';
    $t_json_appeng = $wpdb->get_var($t_sql);
    $t_appeng_config = json_decode($t_json_appeng);
    //var_dump($t_appeng_config);

    #-> initial station config
    $f_config = array('pvi' => $t_pvi_config,
                        'accuweather' => $t_location_config,
                        'pvappengine' => $t_appeng_config);
    
    if (!empty($_POST)) {
        //var_dump($f_config);
        #-> replace new field value with $f_config
        $f_config['pvi'][0]->name = $_POST['inverter_name'];
        $f_config['pvi'][0]->type = $_POST['inverter_type'];
        $f_config['pvi'][0]->modbus_id = (int)$_POST['inverter_id'];

        $f_config['pvi'][0]->serial->port = $_POST['serial_port'];
        $f_config['pvi'][0]->serial->baudrate = (int)$_POST['serial_baudrate'];
        $f_config['pvi'][0]->serial->bytesize = (int)$_POST['serial_bytesize'];
        $f_config['pvi'][0]->serial->parity = $_POST['serial_parity'];
        $f_config['pvi'][0]->serial->stopbits = (float)$_POST['serial_stopbits'];
        $f_config['pvi'][0]->serial->timeout = (float)$_POST['serial_timeout'];
        
        $f_config['accuweather']->locationkey = $_POST['accu_locationkey'];
        $f_config['accuweather']->address = $_POST['site_address'];

        $f_config['pvappengine']->kWh_carbon_save_unit_kg = (float)$_POST['kWh_carbon_save_unit_kg'];
        $f_config['pvappengine']->kWh_income_unit_ntd = (float)$_POST['kWh_income_unit_ntd'];

        //var_dump(json_encode($f_config['pvi']) . "<br/>");
        $wpdb->update( 'dbconfig_appoption', 
                        array('json_data' => json_encode($f_config['pvi'])), 
                        array('app_name' => 'pvi'));

        //var_dump(json_encode($f_config['accuweather']) . "<br/>");
        $wpdb->update( 'dbconfig_appoption', 
                        array('json_data' => json_encode($f_config['accuweather'])), 
                        array('app_name' => 'accuweather'));

        //var_dump(json_encode($f_config['pvappengine']) . "<br/>");
        $wpdb->update( 'dbconfig_appoption', 
                        array('json_data' => json_encode($f_config['pvappengine'])), 
                        array('app_name' => 'pvappengine'));
                        
        $t_pvi_config = $f_config['pvi'];
        $t_serial_config = $t_pvi_config[0]->serial;
        $t_location_config = $f_config['accuweather'];
        $t_appeng_config = $f_config['pvappengine'];
        

    } 
    

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
        <form action=<?php echo $t_page_url; ?> method="post">
        <caption><strong><?php esc_html_e( 'Inverter', 'totomo' ); ?></strong></caption>
        <div class="well">
            <div class="form-group">
                <label for="inverter_name" class="control-label"><?php esc_html_e( 'Name', 'totomo' ); ?></label>
                <input type="text" class="form-control" name="inverter_name" id="inverter_name" placeholder="Inverter Unique Name" value="<?php echo htmlspecialchars($t_pvi_config[0]->name); ?>">
            </div>
            <div class="form-group">
                <label for="inverter_type" class="control-label"><?php esc_html_e( 'Type', 'totomo' ); ?></label>
                <select class="form-control" id="inverter_type" name="inverter_type">
                    <option value="DELTA_PRI_H5" <?php ($t_pvi_config[0]->type == "DELTA_PRI_H5") ? "selected" : "" ?>>DELTA_PRI_H5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inverter_id" class="control-label"><?php esc_html_e( 'Address ID', 'totomo' ); ?></label>
                <select class="form-control" id="inverter_id" name="inverter_id">
                    <?php
                    $opt_list = '';
                    for ($i = 1; $i <= 254; $i++) {
                        if ($t_pvi_config[0]->modbus_id == $i)
                            $opt_list = $opt_list . '
                    <option value="'.$i.'" selected>'.$i.'</option>';
                        else
                            $opt_list = $opt_list . '
                    <option value="'.$i.'">'.$i.'</option>';
                    }
                    echo $opt_list;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info" name="save" value="inverter"><?php esc_html_e( 'Save', 'totomo' ); ?></button>
            </div>
        </div>
        <caption><strong><?php esc_html_e( 'Serial', 'totomo' ); ?></strong></caption>
        <div class="well">
            <div class="form-group">
                <label for="serial_port" class="control-label"><?php esc_html_e( 'Port', 'totomo' ); ?></label>
                <select class="form-control" id="serial_port" name="serial_port">
                <?php
                    $t_serial_port_list = ['/dev/ttyUSB0','/dev/ttyUSB1','/dev/ttyUSB2','/dev/ttyUSB3'];
                    if (PHP_OS != 'WINNT') {
                        $dev_usb_files = glob('/dev/ttyUSB*');
                        if (count($dev_usb_files) > 0)
                            $t_serial_port_list = $dev_usb_files;
                    }
                    foreach ($t_serial_port_list as $t_entry) {
                        if ($t_serial_config->port == $t_entry)
                            echo '<option value="'.$t_entry.'" selected>'.$t_entry.'</option>';
                        else 
                            echo '<option value="'.$t_entry.'">'.$t_entry.'</option>';
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="serial_baudrate" class="control-label"><?php esc_html_e( 'Baudrate', 'totomo' ); ?></label>
                <select class="form-control" id="serial_baudrate" name="serial_baudrate">
                <?php
                    $t_serial_baudrate_list = [9600,19200,38400,57600,115200];
                    foreach ($t_serial_baudrate_list as $t_entry) {
                        if ($t_serial_config->baudrate == $t_entry)
                            echo '<option value="'.$t_entry.'" selected>'.$t_entry.'</option>';
                        else 
                            echo '<option value="'.$t_entry.'">'.$t_entry.'</option>';
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="serial_bytesize" class="control-label"><?php esc_html_e( 'ByteSize', 'totomo' ); ?></label>
                <select class="form-control" id="serial_bytesize" name="serial_bytesize">
                <?php
                    $t_serial_bytesize_list = [5,6,7,8];
                    foreach ($t_serial_bytesize_list as $t_entry) {
                        if ($t_serial_config->bytesize == $t_entry)
                            echo '<option value="'.$t_entry.'" selected>'.$t_entry.'</option>';
                        else 
                            echo '<option value="'.$t_entry.'">'.$t_entry.'</option>';
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="serial_parity" class="control-label"><?php esc_html_e( 'Parity', 'totomo' ); ?></label>
                <select class="form-control" id="serial_parity" name="serial_parity">
                <?php
                    $t_serial_parity_list = array('None' => 'N',
                                                    'EVEN' => 'E',
                                                    'ODD' => 'O',
                                                    'MARK' => 'M',
                                                    'SPACE' => 'S');
                    foreach ($t_serial_parity_list as $t_key => $t_value) {
                        if ($t_serial_config->parity == $t_value)
                            echo '<option value="'.$t_value.'" selected>'.$t_key.'</option>';
                        else 
                            echo '<option value="'.$t_value.'">'.$t_key.'</option>';
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="serial_stopbits" class="control-label"><?php esc_html_e( 'StopBits', 'totomo' ); ?></label>
                <select class="form-control" id="serial_stopbits" name="serial_stopbits">
                <?php
                    $t_serial_stopbits_list = [1,1.5,2];
                    foreach ($t_serial_stopbits_list as $t_entry) {
                        if ($t_serial_config->stopbits == $t_entry)
                            echo '<option value="'.$t_entry.'" selected>'.$t_entry.'</option>';
                        else 
                            echo '<option value="'.$t_entry.'">'.$t_entry.'</option>';
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="serial_timeout" class="control-label"><?php esc_html_e( 'Timeout', 'totomo' ); ?></label>
                <select class="form-control" id="serial_timeout" name="serial_timeout">
                <?php
                    $t_serial_timeout_list = [0.1,0.5,1];
                    foreach ($t_serial_timeout_list as $t_entry) {
                        if ($t_serial_config->timeout == $t_entry)
                            echo '<option value="'.$t_entry.'" selected>'.$t_entry.'</option>';
                        else 
                            echo '<option value="'.$t_entry.'">'.$t_entry.'</option>';
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info" name="save" value="serial"><?php esc_html_e( 'Save', 'totomo' ); ?></button>
            </div>
        </div>

        <caption><strong><?php esc_html_e( 'Location', 'totomo' ); ?></strong></caption>
        <div class="well">
            <div class="form-group">
                <label for="accu_locationkey" class="control-label"><?php esc_html_e( 'AccuWeather Location Key', 'totomo' ); ?></label>
                <input type="text" class="form-control" id="accu_locationkey" name="accu_locationkey" value="<?php echo htmlspecialchars($t_location_config->locationkey); ?>">
            </div>
            <div class="form-group">
                <label for="site_address" class="control-label"><?php esc_html_e( 'Address', 'totomo' ); ?></label>
                <input type="text" class="form-control" id="site_address" name="site_address" value="<?php echo htmlspecialchars($t_location_config->address); ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info" name="save" value="location"><?php esc_html_e( 'Save', 'totomo' ); ?></button>
            </div>
        </div>

        <caption><strong><?php esc_html_e( 'Others', 'totomo' ); ?></strong></caption>
        <div class="well">
            <div class="form-group">
                <label for="kWh_carbon_save_unit_kg" class="control-label"><?php esc_html_e( 'Carbon Save Unit Per kWh (Kg)', 'totomo' ); ?></label>
                <input type="text" class="form-control" id="kWh_carbon_save_unit_kg" name="kWh_carbon_save_unit_kg" placeholder="0.637" value="<?php echo htmlspecialchars($t_appeng_config->kWh_carbon_save_unit_kg); ?>">
            </div>
            <div class="form-group">
                <label for="kWh_income_unit_ntd" class="control-label"><?php esc_html_e( 'Income Unit Per kWh (NTD)', 'totomo' ); ?></label>
                <input type="text" class="form-control" id="kWh_income_unit_ntd" name="kWh_income_unit_ntd" placeholder="6.8633" value="<?php echo htmlspecialchars($t_appeng_config->kWh_income_unit_ntd); ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info" name="save" value="others"><?php esc_html_e( 'Save', 'totomo' ); ?></button>
            </div>
        </div>
        </form>
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
