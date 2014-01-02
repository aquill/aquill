<?php partial('partials/header'); ?>

    <section class="content">
        <article>
            <h1><?php _et('start.title'); ?></h1>
            <p><?php _et('start.description'); ?></p>
        </article>
        <form method="post" action="<?php echo URL::to('start'); ?>" autocomplete="off">
            <?php echo $messages; ?>
            <?php echo Form::token(); ?>
            <fieldset>
                <div class="control-group">
                    <label for="lang" class="control-label"><?php _et('start.lang'); ?></label>

                    <div class="controls">
                        <select id="lang" name="language">
                            <?php foreach ($languages as $key => $lang): ?>
                                <option value="<?php echo $key; ?>" <?php echo $key == $language ? ' selected' : '' ; ?>><?php echo $lang; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <i class="info"><?php _et('start.lang_desc'); ?></i>
                    </div>
                </div>

                <div class="control-group">
                    <label for="timezone" class="control-label"><?php _et('start.timezone'); ?></label>

                    <div class="controls">
                        <select id="timezone" name="timezone">
                            <?php $set = false; ?>
                            <?php foreach ($timezones as $zone): ?>
                                <?php $selected = ($set === false and $timezone == $zone['offset']) ? ' selected' : ''; ?>
                                <option value="<?php echo $zone['timezone_id']; ?>"<?php echo $selected; ?>>
                                    <?php echo $zone['label']; ?>
                                </option>
                                <?php if ($selected) $set = true; ?>
                            <?php endforeach; ?>
                        </select>
                        <i class="info"><?php _et('start.timezone_description'); ?></i>
                    </div>
                </div>
            </fieldset>
            
            <section class="form-actions">
                <button type="submit" class="btn"><?php _et('install.next'); ?></button>
            </section>
        </form>
    </section>

<?php partial('partials/footer'); ?>