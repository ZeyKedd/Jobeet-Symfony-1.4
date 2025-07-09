<?php
class mySecurityFilter extends sfFilter
{
    // public function execute($filterChain)
    // {
    //     $user = $this->getContext()->getUser();

    //     // Por ejemplo, redirigir si NO está logueado
    //     if (!$user->isAuthenticated()) {
    //         $this->getContext()->getController()->redirect('sf_guard_signin'); // o tu ruta de login
    //         return;
    //     }

    //     // Si pasa el filtro, sigue ejecutando la app
    //     $filterChain->execute();
}
