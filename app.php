<?php
use Symfony\Component\HttpFoundation\Request;
use Silex\Provider;

require_once __DIR__.'/bootstrap.php';

$app = new Silex\Application();

//configuration

$website = $em->getRepository('Daniel\Model\Site')->find("1");

$app['swiftmailer.options'] = array(
        'host' => $website->getEmailServer(),
        'port' => $website->getEmailsendport(),
        'username' => $website->getEmail(),
        'password' => $website->getEmailpassword(),
        'encryption' => null,
        'auth_mode' => null
);

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
                'db.options' => array(
                'driver' => 'pdo_mysql',
                'dbhost' => 'localhost',
                'dbname' => 'danielchaves',
                'user' => 'root',
                'password' => '@p0q1o9w2',
        ),
));

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
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new Silex\Provider\SecurityServiceProvider(), array(
        'security.firewalls' => array(
                'secured_area' => array(
                        'pattern' => '^.*$',
                        'anonymous' => true,
                        'remember_me' => array(),
                        'form' => array(
                                'login_path' => '/user/login',
                                'check_path' => '/user/login_check',
                        ),
                        'logout' => array(
                                'logout_path' => '/user/logout',
                        ),
                        'users' => $app->share(function($app) { return $app['user.manager']; }),
                ),
        ),
));

$app->register(new Silex\Provider\RememberMeServiceProvider());

$userServiceProvider = new SimpleUser\UserServiceProvider();
$app->register($userServiceProvider);

// Mount SimpleUser routes.
$app->mount('/user', $userServiceProvider);

//actions
$app->get('/', function (Request $request) use ($app,$em) {
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

    $app->get('/blog', function (Request $request) use ($app,$em) {

        $blog = $em->getRepository('Daniel\Model\Posts')->findAll();
       

        return $app['twig']->render('blog.twig', array(
                'posts' => $blog,
       
        ));

    });

$app->post('/login_check',function(Request $request) use ($app,$em) {
    return "OK";

});

    $app->post('/', function (Request $request) use ($app,$em) {
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

$app->post('/contato', function() use ($app,$em) {

});

$app->get('/sys', function(Request $request) use ($app,$em) {
       return $app['twig']->render('admin.twig', array(
        'error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
});

$app->get('/login', function(Request $request) use ($app,$em) {

   $website = $em->getRepository('Daniel\Model\Site')->find("1");

    return $app['twig']->render('index.twig', array(
        'error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
        'website' => array(
                    'title'=>$website->getSitename(),
                    'footer'=>$website->getSitefooter(),

            ),
    ));

});

$app->get('/pages/{slug}', function ($slug) use ($app,$em) {

    $page = $em->getRepository('Daniel\Model\Pages')->findBy(array('slug'=>$slug));
    if (count($page) > 0) {
        $page = $page[0];
    }

    if (count($page) > 0) {
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
    } else {
        if ($slug == 'login') {
            return $app['twig']->render('login.twig');
        } elseif ($slug == 'contato') {
            $website = $em->getRepository('Daniel\Model\Site')->find("1");

            return $app['twig']->render('contato.twig',array("dados"=>$website));
        } elseif ($slug == 'blog') {
            //blog data

        } else {
            return $app['twig']->render('notfound.twig');
        }

    }

});

$app->get('/sys/pages',function() use ($app,$em) {
     $page = $em->getRepository('Daniel\Model\Pages')->findAll();

     return $app['twig']->render('pages.twig',array(
         'pages' => $page,

     ));

});

    $app->get('/sys/pages/editar/{id}',function($id) use ($app,$em) {
        $page = $em->getRepository('Daniel\Model\Pages')->find($id);

        return $app['twig']->render('pages-edit.twig',array(
             'page' => $page,

        ));

    });
    
    
    	$app->get('/blog/post/{id}',function($id) use ($app,$em) {
    		$page = $em->getRepository('Daniel\Model\Posts')->find($id);
    	
    		return $app['twig']->render('render-post.twig',array(
    				'post' => $page,
    	
    		));
    	
    	});    
    
    
    	$app->get('/sys/posts/editar/{id}',function($id) use ($app,$em) {
    		$page = $em->getRepository('Daniel\Model\Posts')->find($id);
    	
    		return $app['twig']->render('posts-edit.twig',array(
    				'page' => $page,
    	
    		));
    	
    	});

        $app->get('/sys/pages/excluir/{id}',function($id) use ($app,$em) {
            $page = $em->getRepository('Daniel\Model\Pages')->find($id);
            if (count($page) > 0) {
                $em->remove($page);
                $em->flush();
            }

             $pages = $em->getRepository('Daniel\Model\Pages')->findAll();

             return $app['twig']->render('pages.twig',array(
                     'pages' => $pages,
            ));

        });
        
        
        	$app->get('/sys/posts/excluir/{id}',function($id) use ($app,$em) {
        		$page = $em->getRepository('Daniel\Model\Posts')->find($id);
        		if (count($page) > 0) {
        			$em->remove($page);
        			$em->flush();
        		}
        	
        		$pages = $em->getRepository('Daniel\Model\Posts')->findAll();
        	
        		return $app['twig']->render('posts.twig',array(
        				'pages' => $pages,
        		));
        	
        	});

        $app->get('/sys/pages/new',function() use ($app,$em) {
            return $app['twig']->render('pages-new.twig');

        });
        
        	$app->get('/sys/posts/new',function() use ($app,$em) {
        		return $app['twig']->render('posts-new.twig');
        	
        	});

            $app->get('/sys/configs',function() use ($app,$em) {
                 $website = $em->getRepository('Daniel\Model\Site')->find("1");

                 return $app['twig']->render('config.twig',array(
                         'configs' => $website
            ));

            });

                $app->post('/sys/configs/save',function(Request $request) use ($app,$em) {
                    $website = $em->getRepository('Daniel\Model\Site')->find("1");
                    $formData = $request->get("form");
                    if (count($website) >0 ) {
                        $site = new Daniel\Model\Site();
                        $site->setId($formData['id']);
                        $site->setSitename($formData['sitename']);
                        $site->setSitefooter($formData['sitefooter']);
                        $site->setEmail($formData['email']);
                        $site->setEmailserver($formData['emailserver']);
                        $site->setEmailpassword($formData['emailpassword']);
                        $site->setEmailsendport($formData['emailsendport']);
                        $site->setFoto($formData['foto']);
                        $site->setTelefonefixo($formData['telefonefixo']);
                        $site->setTelefonecelular($formData['telefonecelular']);
                        $site->setSiteurl($formData['siteurl']);
                        $site->setEmailcontato($formData['emailcontato']);
                        $em->merge($site);
                        $em->flush();

                    }

                    return $app['twig']->render('config.twig',array(
                            'configs' => $website
                    ));

                });

        $app->post('/sys/pages/save',function(Request $request) use ($app,$em) {

            $formData = $request->get("form");

            $data = $em->getRepository('Daniel\Model\Pages');
            if (count($data->find($formData['id'])) > 0) {
                $page = new Daniel\Model\Pages();
                $page->setSlug($formData['slug']);
                $page->setId($formData['id']);
                $page->setTitle($formData['title']);
                $page->setContent($formData['content']);
                $em->merge($page);
                $em->flush();

                return  "Editado";

            } else {

                $page = new Daniel\Model\Pages();
                $page->setSlug($formData['slug']);
                $page->setTitle($formData['title']);
                $page->setContent($formData['content']);
                $em->persist($page);
                $em->flush();

                return  "Criado";
            }

        });
        
        
        	$app->post('/sys/posts/save',function(Request $request) use ($app,$em) {
        	
        		$formData = $request->get("form");
        	
        		$data = $em->getRepository('Daniel\Model\Posts');
        		if (count($data->find($formData['id'])) > 0) {
        			$page = new Daniel\Model\Posts();
        			$page->setSlug($formData['slug']);
        			$page->setId($formData['id']);
        			$page->setTitle($formData['title']);
        			$page->setContent($formData['content']);
        			$em->merge($page);
        			$em->flush();
        	
        			return  "Editado";
        	
        		} else {
        	
        			$page = new Daniel\Model\Posts();
        			$page->setSlug($formData['slug']);
        			$page->setTitle($formData['title']);
        			$page->setContent($formData['content']);
        			$page->setCreated(new DateTime('now'));
        			$em->persist($page);
        			$em->flush();
        	
        			return  "Criado";
        		}
        	
        	});

        $app->post('/send/contact',function(Request $request) use ($app,$em) {
            $formData = $request->get("form");

            try {
            $message = "Mensagen Enviada do Web Site DanielChaves.com.br\n";
            $message.= "================================================\n";
            $message.= "Enviada por: {$formData['name']} \n";
            $message.= "Email      : {$formData['email']} \n";
            $message.= "Mensagem   : \n";
            $message.= "================================================\n";
            $message.= "{$formData['message']}\n";

            $message = \Swift_Message::newInstance()
            ->setSubject('Mensagem de Contato')
            ->setFrom(array('contato@danielchaves.com.br'))
            ->setTo(array('daniel@danielchaves.com.br'))
            ->setBody($message);

            $app['mailer']->send($message);

            return true;
            } catch (Exeption $e) {
                return $e->getMessage();
            }

        });

            $app->get('/sys/blog',function() use ($app,$em) {
                $page = $em->getRepository('Daniel\Model\Posts')->findAll();

                return $app['twig']->render('posts.twig',array(
                     'pages' => $page,

                ));

            });
