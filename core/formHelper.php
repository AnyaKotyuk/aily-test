<?php
/**
 * Class FormHelper make form creation easier
 *
 */

class FormHelper {

    /**
     * Show text input form element
     *
     * @param string $name
     * @param string $value
     * @param string $attrs
     */
    public static function textInput($name = null, $label = null, $value = null, $attrs = null)
    {
        ?>
        <label class="control-label" for="<?php echo $name; ?>"><?php echo $label; ?></label>
        <input id="<?php echo $name; ?>" class="form-control" type="text" name="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php echo $attrs; ?>>
        <?
    }

    /**
     * Show email input form element
     *
     * @param string $name
     * @param string $value
     * @param string $attrs
     */
    public static function emailInput($name = null, $label, $value = null, $attrs = null)
    {
        ?>
        <label class="control-label" for="<?php echo $name; ?>"><?php echo $label; ?></label>
        <input id="<?php echo $name; ?>" class="form-control" type="email" name="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php echo $attrs; ?>>
        <?
    }

    /**
     * Show textarea form element
     *
     * @param string $name
     * @param string $value
     * @param string $attrs
     */
    public static function textarea($name = null, $label, $value, $attrs = null)
    {
        ?>
        <label class="control-label" for="<?php echo $name; ?>"><?php echo $label; ?></label>
        <textarea rows="3" id="<?php echo $name; ?>" class="form-control" name="<?php echo $name; ?>" <?php echo $attrs; ?>><?php echo $value; ?></textarea>
        <?
    }

    /**
     * Show submit button form element
     *
     * @param null $name
     * @param null $attrs
     */
    public static function submit($value = 'Submit', $attrs = null)
    {
        ?>
        <button class="form-control" <?php echo $attrs; ?>><?php echo $value;?></button>
        <?
    }

    /**
     * Show captcha form element
     *
     * @param null $name
     * @param null $attrs
     */
    public static function captcha()
    {
        ?>
        <label class="control-label">Captcha</label>
        <div class="captcha">
            <img src = "<?php echo URL.'/libs/captcha/captcha.php'; ?>" />
            <input class="form-control" type = "text" name = "kapcha" placeholder="Enter symbols from image" />
        </div>
        <?
    }
}