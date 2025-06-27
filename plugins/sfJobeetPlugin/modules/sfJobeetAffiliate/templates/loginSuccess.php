<!-- apps/frontend/modules/affiliate/templates/loginSuccess.php -->

<h1>Affiliate Login</h1>
<!-- //D:\desarollo\lib\form\doctrine\sfJobeetPlugin\JobeetAffiliateLoginForm.class.php -->

<?php if ($sf_user->hasFlash('error')): ?>
    <div class="flash_error">
        <?php echo $sf_user->getFlash('error') ?>
    </div>
<?php endif; ?>


<div style="width: 400px; margin: 0 auto;">
    <form action="<?php echo url_for('affiliate_login') ?>" method="post">
        <table>
            <p>Remember copy your token API withot spaces</p>
            <?php echo $form ?>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Login" />
                </td>
            </tr>
        </table>
    </form>
</div>