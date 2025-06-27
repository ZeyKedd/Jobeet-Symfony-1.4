<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_activate">
      <?php echo link_to(__('Activate', array(), 'messages'), 'backend_affiliate/ListActivate?id='.$jobeet_affiliate->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_desactivate">
      <?php echo link_to(__('Desactivate', array(), 'messages'), 'backend_affiliate/ListDesactivate?id='.$jobeet_affiliate->getId(), array()) ?>
    </li>
  </ul>
</td>
