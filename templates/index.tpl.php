<div id="main">
    <h2 class="head"><?=i18n::msg('Test Task') ?></h2>

    <?=i18n::msg('Description') ?>

    <div class="sep sep_main"></div>

    <div class="register-block">
        <h4><?=i18n::msg('Register') ?></h4>

        <span class="small gray">&nbsp;</span>

        <div id="register-block__result">
            <form name="register-form" id="register-form" action="/?page=register" callback="register">

                <div class="formField">
                    <label for="login">E-mail:</label>
                    <input type="text" name="email" id="email" class="f-data" value=""
                           validate="notEmpty email"
                           validate-error="<?=i18n::msg('E-mail required') ?>; <?=i18n::msg('Wrong e-mail format') ?>; <?=i18n::msg('E-mail already used') ?>" />
                </div>

                <div class="formField">
                    <label for="login"><?=i18n::msg('Password') ?>:</label>
                    <input type="password" name="password" id="password" class="f-data" value=""
                           validate="notEmpty min"
                           validate-min="6"
                           validate-error="<?=i18n::msg('Password required') ?>; <?=i18n::msg('Password min 6 symbols') ?>" />
                </div>

                <div class="formField">
                    <label for="login"><?=i18n::msg('Repeat Password') ?>:</label>
                    <input type="password" name="repassword" id="repeat" class="f-data" value=""
                           validate="equalTo"
                           validate-equal-to="password"
                           validate-error="<?=i18n::msg('Passwords do not match') ?>"/>
                </div>

                <div class="sep input-sep"></div>

                <div class="formField">
                    <label for="login"><?=i18n::msg('First Name') ?>:</label>
                    <input type="text" name="first_name" id="first_name" class="f-data" value=""
                           validate="notEmpty"
                           validate-error="<?=i18n::msg('First Name required') ?>"/>
                </div>

                <div class="formField">
                    <label for="login"><?=i18n::msg('Last Name') ?>:</label>
                    <input type="text" name="last_name" id="last_name" class="f-data" value=""
                           validate="notEmpty"
                           validate-error="<?=i18n::msg('Last Name required') ?>" />
                </div>

                <input type="submit" name="submit" class="button" value="<?=i18n::msg('Register') ?>" />

            </form>
        </div>
    </div>

    <div class="login-block">
        <h4><?=i18n::msg('Log in') ?></h4>

        <span class="small gray">&nbsp;</span>

        <form name="login-form" id="login-form" action="/?page=login" callback="login">

            <div class="formField">
                <label for="login">E-mail:</label>
                <input type="text" name="email" id="email-login" class="f-data" value=""
                       validate="notEmpty email"
                       validate-error="<?=i18n::msg('E-mail required') ?>; <?=i18n::msg('Wrong e-mail format') ?>; <?=i18n::msg('E-mail already used') ?>" />
            </div>

            <div class="formField">
                <label for="login"><?=i18n::msg('Password') ?>:</label>
                <input type="password" name="password" id="password-login" class="f-data" value=""
                       validate="notEmpty"
                       validate-error="<?=i18n::msg('Password required') ?>; <?=i18n::msg('Wrong Login or Password') ?>" />
            </div>

            <input type="submit" name="submit" class="button login-button" value="<?=i18n::msg('Log in') ?>" />
        </form>
    </div>

    <div class="clear"></div>
</div>