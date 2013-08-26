<?php
require_once __DIR__.'/bootstrap.php';

$app = new Silex\Application();

//configuration
$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app->register(new Silex\Provider\SwiftmailerServiceProvider());

//actions
$app->get('/', function ()  use ($app,$em) {
	$website = $em->getRepository('Daniel\Model\Site')->find("1");
		
    return $app['twig']->render('home.twig', array(
       'website' => array(
       		'title'=>$website->getSitename(),
       		'footer'=>$website->getSitefooter(),
       		
       )
	));
});

$app->post('/user', function() use ($app, $em) {
    $name = $app['request']->get('name');
    $login = $app['request']->get('name');
    $email = $app['request']->get('name');
    $user = $em->getRepository('Coderockr\Model\User')->findBy(array('login' => $login));
    if (count($user) == 0) {
        $user = new Coderockr\Model\User();
        $user->setName($name);
        $user->setLogin($login);
        $user->setEmail($email);

        $em->persist($user);
        $em->flush();
        return $app->redirect('/');
    }
    return $app['twig']->render('message.twig', array(
        'message' => 'User exists'
    ));
});