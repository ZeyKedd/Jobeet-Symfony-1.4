<!-- apps/frontend/modules/job/templates/_form.php -->
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php echo form_tag_for($form, '@job') ?>
<table id="job_form">
  <tfoot>
    <tr>
      <td colspan="2">
        <input type="submit" value="Preview your job" />
      </td>
    </tr>
  </tfoot>
  <tbody>
    <?php echo $form ?>
  </tbody>
</table>
</form>


<!--
BaseJobeetJob Modelo Doctrine: define campos según la base de datos.

BaseJobeetJobForm Clase generada automáticamente: crea campos del formulario.

JobeetJobForm Tu clase personalizada: modifica, oculta o valida esos campos.

_form.php Plantilla: muestra el formulario generado por JobeetJobForm.
-->