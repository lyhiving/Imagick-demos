<?php


if (defined('LOW_MEM_CLASS_LOADER') && LOW_MEM_CLASS_LOADER == true) {
    require_once('../vendor/intahwebz/lowmemoryclassloader/LowMemoryClassloader.php');
}
else {
    require_once('../vendor/autoload.php');
}



use Weaver\CompositeWeaveGenerator;

$controls = [
    ['ImagickDemo\ControlElement\Radius', 'ImagickDemo\ControlElement\Sigma', 'ImagickDemo\ControlElement\Image'],
    ['ImagickDemo\ControlElement\R', 'ImagickDemo\ControlElement\G', 'ImagickDemo\ControlElement\B', 'ImagickDemo\ControlElement\A'],

    ['ImagickDemo\ControlElement\Image', 'ImagickDemo\ControlElement\R', 'ImagickDemo\ControlElement\G', 'ImagickDemo\ControlElement\B', 'ImagickDemo\ControlElement\A'],
];

\Intahwebz\Functions::load();

foreach ($controls as $components) {
    $lazyWeaveInfo = new \Weaver\CompositeWeaveInfo(
        'ImagickDemo\Control\ControlComposite',
        $components, 
        [
            'renderFormElement' => 'string',
            'getParams' => 'array',
        ]
    );
    $weaveMethod = new CompositeWeaveGenerator($lazyWeaveInfo);
    $weaveMethod->writeClass('../var/compile/');
}



//
////This always needs to be last
//$weaver->writeClosureFactories(
//       '../generated/',
//           'Example',
//           'ClosureFactory',
//           $weaver->getClosureFactories()
//);




 