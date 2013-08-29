<?php
require_once __DIR__.'/bootstrap.php';

$app = new Silex\Application();

//configuration
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
		'locale' => 'pt_BR',
		'translation.class_path' =>  __DIR__ . '/../vendor/symfony/src',
		'translator.messages' => array()
)) ;

$app->register(new Silex\Provider\SwiftmailerServiceProvider());

//actions
$app->get('/', function ()  use ($app,$em) {
	$website = $em->getRepository('Daniel\Model\Site')->find("1");
	$skils = $em->createQuery("Select u from Daniel\Model\Skills u");
	$skills = $skils->getArrayResult();
		
    return $app['twig']->render('index.twig', array(
       'website' => array(
       		'title'=>$website->getSitename(),
       		'footer'=>$website->getSitefooter(),
       		
       ),
    		'skills' =>$skills,
    		
	));
});

$app->post('/contato', function() use ($app,$em){
	
       
});

$app->get('/login', function() use ($app,$em){
	
	$website = $em->getRepository('Daniel\Model\Site')->find("1");
	
	
	$form = $app['form.factory']->createBuilder('form')
	->add('username','text')
	->add('password','password')->getForm();
	
	return $app['twig']->render('login.twig',array('form' => $form->createView(),
			'website' => array(
					'title'=>$website->getSitename(),
					'footer'=>$website->getSitefooter(),
					 
			),
	));
       
});

$app->post('/login', function() use ($app,$em){
	
	
       
});

$app->get('/pages/{slug}', function ($slug) use ($app,$em){

	$page = $em->getRepository('Daniel\Model\Pages')->findBy(array('slug'=>$slug));
	$page = $page[0];
	
	if(count($page) > 0){
	  	
    	return $app['twig']->render('normal-ajax.twig',array(
		    'Content'=>array(
				    'title' => $page->getTitle(),
				    'content' => $page->getContent(),
				    'slug' => $page->getSlug(),
				    'view' => $page->getView(),
				    'id' => $page->getId()
		            )
		       )
		    );
	}else{
		
		return $app['twig']->render('notfound.twig');
		
	}
	
       
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