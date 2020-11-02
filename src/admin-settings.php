<?php
add_action('admin_menu', 'bb_ws_add_admin_menu');
add_action('admin_init', 'bb_ws_settings_init');

function bb_ws_add_admin_menu()
{
    add_options_page('BoxyBird WebSockets using Laravel', 'BoxyBird WebSockets', 'manage_options', 'boxybird_websockets_using_laravel', 'bb_ws_options_page');
}

function bb_ws_settings_init()
{
    register_setting('pluginPage', 'bb_ws_settings');

    add_settings_section(
        'bb_ws_pluginPage_section',
        __('Settings', 'bb_ws_text'),
        'bb_ws_settings_section_callback',
        'pluginPage'
    );

    add_settings_field(
        'bb_ws_app_id',
        __('App ID', 'bb_ws_text'),
        'bb_ws_app_id',
        'pluginPage',
        'bb_ws_pluginPage_section'
    );

    add_settings_field(
        'bb_ws_app_key',
        __('App Key', 'bb_ws_text'),
        'bb_ws_app_key',
        'pluginPage',
        'bb_ws_pluginPage_section'
    );

    add_settings_field(
        'bb_ws_app_secret',
        __('App Secret', 'bb_ws_text'),
        'bb_ws_app_secret',
        'pluginPage',
        'bb_ws_pluginPage_section'
    );

    add_settings_field(
        'bb_ws_app_cluster',
        __('App Cluster', 'bb_ws_text'),
        'bb_ws_app_cluster',
        'pluginPage',
        'bb_ws_pluginPage_section'
    );

    add_settings_field(
        'bb_ws_app_host',
        __('App Host', 'bb_ws_text'),
        'bb_ws_app_host',
        'pluginPage',
        'bb_ws_pluginPage_section'
    );

    add_settings_field(
        'bb_ws_app_host_port',
        __('App Host Port', 'bb_ws_text'),
        'bb_ws_app_host_port',
        'pluginPage',
        'bb_ws_pluginPage_section'
    );

    add_settings_field(
        'bb_ws_app_host_scheme',
        __('App Host Scheme', 'bb_ws_text'),
        'bb_ws_app_host_scheme',
        'pluginPage',
        'bb_ws_pluginPage_section'
    );

    add_settings_field(
        'bb_ws_encrypted',
        __('encrypted', 'bb_ws_text'),
        'bb_ws_encrypted',
        'pluginPage',
        'bb_ws_pluginPage_section'
    );
}

function bb_ws_app_id()
{
    $options = get_option('bb_ws_settings'); 
    $app_id  = isset($options['bb_ws_app_id']) ? $options['bb_ws_app_id'] : ''; ?>
    <input type="text" 
           name="bb_ws_settings[bb_ws_app_id]" 
           value="<?php echo $app_id; ?>" 
           required />
	<?php
}

function bb_ws_app_key()
{
    $options = get_option('bb_ws_settings'); 
    $app_key = isset($options['bb_ws_app_key']) ? $options['bb_ws_app_key'] : ''; ?>
    <input type="text" 
           name="bb_ws_settings[bb_ws_app_key]" 
           value="<?php echo $app_key; ?>" 
           required />
	<?php
}

function bb_ws_app_secret()
{
    $options    = get_option('bb_ws_settings'); 
    $app_secret = isset($options['bb_ws_app_secret']) ? $options['bb_ws_app_secret'] : ''; ?>
    <input type="password" 
           name="bb_ws_settings[bb_ws_app_secret]" 
           value="<?php echo $app_secret; ?>" 
           required />
	<?php
}

function bb_ws_app_cluster()
{
    $options     = get_option('bb_ws_settings'); 
    $app_cluster = isset($options['bb_ws_app_cluster']) ? $options['bb_ws_app_cluster'] : ''; ?>
    <input type="text" 
           name="bb_ws_settings[bb_ws_app_cluster]" 
           value="<?php echo $app_cluster; ?>" 
           required />
	<?php
}

function bb_ws_app_host()
{
    $options = get_option('bb_ws_settings'); 
    $app_host = isset($options['bb_ws_app_host']) ? $options['bb_ws_app_host'] : ''; ?>
    <input type="text" 
           name="bb_ws_settings[bb_ws_app_host]" 
           value="<?php echo $app_host; ?>" 
           required />
	<?php
}

function bb_ws_app_host_port()
{
    $options = get_option('bb_ws_settings'); 
    $host_port = isset($options['bb_ws_app_host_port']) ? $options['bb_ws_app_host_port'] : ''; ?>
    <input type="text" 
           name="bb_ws_settings[bb_ws_app_host_port]" 
           value="<?php echo $host_port; ?>" 
           required />
	<?php
}

function bb_ws_app_host_scheme()
{
    $options = get_option('bb_ws_settings'); 
    $host_scheme = isset($options['bb_ws_app_host_scheme']) ? $options['bb_ws_app_host_scheme'] : 'https'; ?>
    <select name="bb_ws_settings[bb_ws_app_host_scheme]">
        <option value="https" <?php echo $host_scheme === 'https' ? 'selected' : ''; ?>>https</option>
        <option value="http"  <?php echo $host_scheme === 'http' ? 'selected' : ''; ?>>http</option>
    </select>
	<?php
}

function bb_ws_encrypted()
{
    $options = get_option('bb_ws_settings'); ?>
    <input type="checkbox" 
           name="bb_ws_settings[bb_ws_encrypted]" 
           <?php checked(isset($options['bb_ws_encrypted']) ? $options['bb_ws_encrypted'] : 0, 1); ?>
           value="1" />
	<?php
}

function bb_ws_settings_section_callback()
{
    echo __('Pusher API Details (all fields required)', 'bb_ws_text');
}

function bb_ws_options_page()
{
    ?>
	<form action='options.php' method='post'>

		<h2>BoxyBird WebSockets using Laravel</h2>

        <?php
        settings_fields('pluginPage');
        do_settings_sections('pluginPage');
        submit_button(); 
        ?>

    </form>

    <h3>Usage</h3>
    <hr align="left" width="30%" /> 
    <h4>Arguments</h4>
    <code>
        $channel = // Laravel public channel name - Ex. 'Messenger'
    </code>
    <br />
    <br />
    <code>
        $event = // Laravel event name - Ex. 'App\Events\NewMessage' 
    </code>
    <br />
    <br />
    <code>
        $payload = // Associative array - Ex. [ 'message' => 'Hello, World' ]
    </code>
    <br />
    <br />
    <hr align="left" width="30%" /> 
    <h4>Functions</h4>
    <code>
        bb_ws_channel_info( $channel );
    </code>
    <br />
    <br />
    <code>
        bb_ws_trigger_event( $channel, $event, $payload );
    </code>
	<?php
}
