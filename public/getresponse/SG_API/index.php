<?php    
require __DIR__.'/API_SG.php';

// $membreid       = 123456;
// $codeactivation = 'xxxxx';
$membreid       =  20195;
$codeactivation = '170720181257619525413129304312';


echo '<pre>';
//démarrage de l'api
$sgApi = new API_SG($membreid, $codeactivation);

    // ->set('listeid', 123456)

// $call = $sgApi->call('get_list');


// $sgApi
//     ->set('listeid',    142033)
//     ->set('nom',        'vira')
//     ->set('prenom',     'brather')
//     ->set('email',      'vipinks86@gmail.com')
//     ->set('champs_1',   'test111')
//     ->set('ip', $_SERVER["REMOTE_ADDR"]);

// $call = $sgApi->call('set_subscriber');
// print_r($call);
// exit();

$sgApi->set('parent', '')
	->set('detail', true);
//appel
try{
    $call = $sgApi->call('get_list');
    //retour
    $response=json_decode($call);
    // print_r($response);
    print_r($response->reponse);
    exit();

} catch (Exception $e){
//    SG Non joignable.
    die($e);
}

