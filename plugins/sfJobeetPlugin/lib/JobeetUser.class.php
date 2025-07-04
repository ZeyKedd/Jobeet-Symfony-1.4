<?php

class JobeetUser
{

    static public function methodNotFound(sfEvent $event)
    {
        if (method_exists('JobeetUser', $event['method'])) {
            $event->setReturnValue(call_user_func_array(
                array('JobeetUser', $event['method']),
                array_merge(array($event->getSubject()), $event['arguments'])
            ));
            return true;
        }
    }


    static public function addJobToHistory(sfUser $user, JobeetJob $job)
    {
        $ids = $user->getAttribute('job_history', array());

        if (!in_array($job->getId(), $ids)) {
            array_unshift($ids, $job->getId()); //unshift agrega uno o mas elementos al inicio del array

            $user->setAttribute('job_history', array_slice($ids, 0, 3)); //slice 'separa' elementos en un indice seleccionado 0, 3
        }
    }

    static public function getJobHistory(sfUser $user)
    {
        $ids = $user->getAttribute('job_history', array());

        if (!empty($ids)) {
            return Doctrine_Core::getTable('JobeetJob')
                ->createQuery('a')
                ->whereIn('a.id', $ids)
                ->execute();
        }
        return array();
    }

    static public function resetJobHistory(sfUser $user)
    {
        $user->getAttributeHolder()->remove('job_history');
    }

    static public function isFirstRequest(sfUser $user, $boolean = null)
    {
        if (is_null($boolean)) {
            return $user->getAttribute('first_request', true);
        } else {
            $user->setAttribute('first_request', $boolean);
        }
    }
}
