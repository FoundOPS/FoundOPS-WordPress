<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Read More Right Here Plugin Options</h2>

    <form method="post" action="options.php">
    
        <?php settings_fields(self::OPTIONS_ID); ?>
        <?php do_settings_sections(self::OPTIONS_PAGE_ID); ?>
        
        <p class="submit" style="margin-top:30px;">
            <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
            <!-- 
            <input name="SetDefaults" type="submit" class="button-primary" value="Reset Default Values" style="margin-left:50px;color:#EE9999;border-color:red;"/>
             -->
        </p>
       
    </form>

</div>