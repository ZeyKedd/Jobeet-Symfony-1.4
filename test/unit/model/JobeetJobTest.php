<?php
include(dirname(__FILE__) . '/../../bootstrap/Doctrine.php');


/* 
    Metodos

ok($test)  Prueba una condición y pasa si es true
is($value1, $value2)  Compara dos valores y pasa si son iguales (==)
isnt($value1, $value2)	Compara dos valores y pasa si son distintos
like($string, $regexp)	Prueba una cadena contra una expresión regular
unlike($string, $regexp)	Comprueba que la cadena difiera de la expresión regular
is_deeply($array1, $array2)	Comprueba que dos arrays tienen los mismos valores
*/


$t = new lime_test(7);

$t->comment('->getCompanySlug()');

$job = Doctrine_Core::getTable('JobeetJob')->createQuery()->fetchOne();
$t->is($job->getCompanySlug(), Jobeet::slugify($job->getCompany()), '->getCompanySlug() return the slug for the company');

$t->comment('->save()');

$job = create_job();
$job->save();
$expiresAt = date('Y-m-d', time() + 86400 * sfConfig::get('app_active_days'));
$t->is($job->getDateTimeObject('expires_at')->format('Y-m-d'), $expiresAt, '->save() updates expires_at if not set');

$job = create_job(array('expires_at' => '2008-08-08'));
$job->save();
$t->is($job->getDateTimeObject('expires_at')->format('Y-m-d'), '2008-08-08', '->save() does not update expires_at if set');


function create_job($defalts = array())
{
    static $category = null;

    if (is_null($category)) {
        $category = Doctrine_Core::getTable('JobeetCategory')
            ->createQuery()
            ->limit(1)
            ->fetchOne();
    }

    $job = new JobeetJob();
    $job->fromArray(array_merge(array(
        'category_id'  => $category->getId(),
        'company'      => 'Sensio Labs',
        'position'     => 'Senior Tester',
        'location'     => 'Paris, France',
        'description'  => 'Testing is fun',
        'how_to_apply' => 'Send e-Mail',
        'email'        => 'job@example.com',
        'token'        => rand(1111, 9999),
        'is_activated' => true,
    ), $defalts));

    return $job;
}


$t->comment('->getForLuceneQuery()');
$job = create_job(array('position' => 'foobar', 'is_activated' => false));
$job->save();
$jobs = Doctrine_Core::getTable('JobeetJob')->getForLuceneQuery('position:foobar');
$t->is(count($jobs), 0, '::getForLuceneQuery() does not return non activated jobs');
 
$job = create_job(array('position' => 'foobar', 'is_activated' => true));
$job->save();
$jobs = Doctrine_Core::getTable('JobeetJob')->getForLuceneQuery('position:foobar');
$t->is(count($jobs), 1, '::getForLuceneQuery() returns jobs matching the criteria');
$t->is($jobs[0]->getId(), $job->getId(), '::getForLuceneQuery() returns jobs matching the criteria');
 
$job->delete();
$jobs = Doctrine_Core::getTable('JobeetJob')->getForLuceneQuery('position:foobar');
$t->is(count($jobs), 0, '::getForLuceneQuery() does not return deleted jobs');