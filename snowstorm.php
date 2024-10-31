<?php
/*
Plugin Name: Web雪花特效
Plugin URI: https://wordpress.org/plugins/nines-snowstorm/
Description: Web网页下雪特效!!
Version:1.1
Author: 不问归期_
Author URI: https://www.aliluv.cn/
Tags: snowstorm, 特效, 下雪, 雪花, 网页特效
*/

define('NINES_SNOWSTORM_PL_URL', plugins_url('', __FILE__));
add_action('admin_init', function () {
    register_setting('nines-snowstorm-settings-group', 'snowstorm_snowColor');
    register_setting('nines-snowstorm-settings-group', 'snowstorm_snowCharacter');
    register_setting('nines-snowstorm-settings-group', 'snowstorm_usePositionFixed');
    register_setting('nines-snowstorm-settings-group', 'snowstorm_flakesMaxActive');
    register_setting('nines-snowstorm-settings-group', 'snowstorm_useTwinkleEffect');
    register_setting('nines-snowstorm-settings-group', 'snowstorm_vMaxX');
    register_setting('nines-snowstorm-settings-group', 'snowstorm_vMaxY');
});

add_action('admin_menu', function () {
    add_menu_page(
        '雪花特效设置',
        '雪花特效设置',
        'administrator',
        'nines-snowstorm',
        function () { ?>
        <div class="wrap" id="profile-page">
            <hr class="wp-header-end">
            <form action="options.php" method="post">
                <?php settings_fields('nines-snowstorm-settings-group'); ?>
                <?php do_settings_sections('nines-snowstorm-settings-group'); ?>
                <h2>插件配置</h2>
                <table class="form-table" role="presentation">
                    <tbody>
                        <tr class="user-user-login-wrap">
                            <th><label for="user_login">雪的颜色</label></th>
                            <td>
                                <input type="text" name="snowstorm_snowColor" value="<?php echo esc_attr(get_option('snowstorm_snowColor')); ?>" placeholder="#99ccff" class="regular-text">
                                <span class="description">用户名不可更改。</span>
                            </td>
                        </tr>
                        <tr class="user-first-name-wrap">
                            <th><label for="first_name">雪的形状</label></th>
                            <td><input type="text" name="snowstorm_snowCharacter" value="<?php echo esc_attr(get_option('snowstorm_snowCharacter')); ?>" placeholder="*" class="regular-text">
                                <span class="description">修改雪的形状，比如改成*</span>
                            </td>
                        </tr>

                        <tr class="user-last-name-wrap">
                            <th><label for="last_name">跟随鼠标</label></th>
                            <td><input type="text" name="snowstorm_usePositionFixed" value="<?php echo esc_attr(get_option('snowstorm_usePositionFixed')); ?>" placeholder="false" class="regular-text">
                                <span class="description">true = 关闭跟随鼠标 false = 开启跟随鼠标</span>
                            </td>
                        </tr>

                        <tr class="user-nickname-wrap">
                            <th><label for="nickname">积雪数量</label></th>
                            <td><input type="text" name="snowstorm_flakesMaxActive" value="<?php echo esc_attr(get_option('snowstorm_flakesMaxActive')); ?>" placeholder="96" class="regular-text">
                                <span class="description">一次在萤幕上显示更多积雪</span>
                            </td>
                        </tr>
                        <tr class="user-nickname-wrap">
                            <th><label for="nickname">让雪花闪烁进出视野</label></th>
                            <td><input type="text" name="snowstorm_useTwinkleEffect" value="<?php echo esc_attr(get_option('snowstorm_useTwinkleEffect')); ?>" placeholder="true" class="regular-text">
                                <span class="description">true = 关闭 false = 开启</span>
                            </td>
                        </tr>
                        <tr class="user-nickname-wrap">
                            <th><label for="nickname">X轴移动速度</label></th>
                            <td><input type="text" name="snowstorm_vMaxX" value="<?php echo esc_attr(get_option('snowstorm_vMaxX')); ?>" placeholder="8" class="regular-text">
                                <span class="description">X轴移动最大移动速度、越大越快</span>
                            </td>
                        </tr>
                        <tr class="user-nickname-wrap">
                            <th><label for="nickname">Y轴移动速度</label></th>
                            <td><input type="text" name="snowstorm_vMaxY" value="<?php echo esc_attr(get_option('snowstorm_vMaxY')); ?>" placeholder="5" class="regular-text">
                                <span class="description">Y轴移动最大移动速度、越大越快</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <p class="submit"><input type="submit" name="community-events-submit" class="button button-primary" value="保存"></p>
            </form>
        </div>
    <?php },
        'dashicons-superhero-alt'
    );
});


/**
 * 加载样式
 *
 * @return  [type]  [return description]
 */

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script(
        'nines_snowstorm',
        NINES_SNOWSTORM_PL_URL . '/snowstorm-min.js',
        array(),
        false,
        false
    );
});
add_action('wp_footer', function () { ?>
    <script>
        snowStorm.snowColor = "<?php echo (esc_attr(get_option("snowstorm_snowColor"))) ? esc_attr(get_option("snowstorm_snowColor")) : '#99ccff'; ?>";
        snowStorm.snowCharacter = "<?php echo (esc_attr(get_option("snowstorm_snowCharacter"))) ? esc_attr(get_option("snowstorm_snowCharacter")) : '*'; ?>"; //修改雪的形状，比如改成* 
        snowStorm.usePositionFixed = <?php echo (esc_attr(get_option("snowstorm_usePositionFixed"))) ? esc_attr(get_option("snowstorm_usePositionFixed")) : true; ?>; //true = 关闭跟随鼠标 false = 开启跟随鼠标 
        snowStorm.flakesMaxActive = <?php echo (esc_attr(get_option("snowstorm_flakesMaxActive"))) ? esc_attr(get_option("snowstorm_flakesMaxActive")) : 96; ?>; //一次在萤幕上显示更多积雪 
        snowStorm.useTwinkleEffect = <?php echo (esc_attr(get_option("snowstorm_useTwinkleEffect"))) ? esc_attr(get_option("snowstorm_useTwinkleEffect")) : true; ?>; //让雪花闪烁进出视野
        snowStorm.vMaxX = <?php echo (esc_attr(get_option("snowstorm_vMaxX"))) ? esc_attr(get_option("snowstorm_vMaxX")) : 8; ?>; // X轴移动最大移动速度、越大越快
        snowStorm.vMaxY = <?php echo (esc_attr(get_option("snowstorm_vMaxY"))) ? esc_attr(get_option("snowstorm_vMaxY")) : 5; ?>; // Y轴移动最大移动速度、越大越快
    </script> ';
<?php
});
