<?php 
require_once dirname(__FILE__).'/../bootstrap/unit.php';

$t = new lime_test(9);
// Si descubres un fallo antes de solucionarlo pasa a ponerlo en test
// y verificar que verdaderamente falla y ahora si solucionas


/* 
    Metodos

ok($test)  Prueba una condición y pasa si es true
is($value1, $value2)  Compara dos valores y pasa si son iguales (==)
isnt($value1, $value2)	Compara dos valores y pasa si son distintos
like($string, $regexp)	Prueba una cadena contra una expresión regular
unlike($string, $regexp)	Comprueba que la cadena difiera de la expresión regular
is_deeply($array1, $array2)	Comprueba que dos arrays tienen los mismos valores
*/






// $t->is(Jobeet::slugify(''), 'n-a') // entrada -> (""), 'n-a' <- Salida
 
$t->comment('::slugify()');
if (function_exists('iconv'))
{
    $t->is(Jobeet::slugify('Développeur Web'), 'developpeur-web', '::slugify() removes accents');
}
else
{
    $t->skip('::slugify() remove accents - iconv not installed');
}
$t->is(Jobeet::slugify(''), 'n-a', '::slugify() converts the empty string to n-a');
$t->is(Jobeet::slugify(' - '), 'n-a', '::slugify() converts a string that only contains non-ASCII characters to n-a');
$t->is(Jobeet::slugify('Sensio'), 'sensio', '::slugify() converts all characters to lower case');
$t->is(Jobeet::slugify('sensio labs'), 'sensio-labs', '::slugify() replaces a white space by a -');
$t->is(Jobeet::slugify('sensio   labs'), 'sensio-labs', '::slugify() replaces several white spaces by a single -');
$t->is(Jobeet::slugify('  sensio'), 'sensio', '::slugify() removes - at the beginning of a string');
$t->is(Jobeet::slugify('sensio  '), 'sensio', '::slugify() removes - at the end of a string');
$t->is(Jobeet::slugify('paris,france'), 'paris-france', '::slugify() replaces non-ASCII characters by a -');