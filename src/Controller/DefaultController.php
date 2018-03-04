<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\{Response, JsonResponse, Request};
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class DefaultController extends Controller
{
    public function index()
    {
        return $this-> render('index.html.twig',['wellcome' => 'Wellcome! You are in a home page.']);
    }
    /**
     * @Route(
     *     "post/page/{number}", name="nameIndex",
     *      methods={"GET"},
     *      requirements={"number"="^(0?[1-9]|[1-9][0-9])$"},
     *     defaults={"number"=1}
     *     )
     */
    public function nameIndex($number)
    {
	return $this-> render('number.html.twig',['number' => $number]);
    }

    public function template()
    {
        return $this->render('base.html.twig');
    }

    public function rj(Request $request)
    {
        $rj = new JsonResponse($request);
        return $this->render('json.html.twig',['rj'=> $rj]);
    }
    /**
     * @Route(
     *     "set_session/{name}", name="setSession",
     *      methods={"GET"},
     *      requirements={"name"="^(0?[1-9]|[1-9][0-9])$"},
     *     defaults={"name"=1}
     *     )
     */
    public function setSession(SessionInterface $session, $name)
    {
        $session->set('number',$name);
        return $this->render('setSession.html.twig');
    }

    public function session(SessionInterface $session)
    {
        $currentNumb = $session->get('number');
        $currentId = $session->getId();

        return $this->render('session.html.twig',['currentNumb'=>$currentNumb, 'currentId'=>$currentId]);
    }

    public function google()
    {
        return $this->redirect('http://google.com');
    }

    public function menu()
    {
        $menu = [
            'item1',
            'item2' => [0,1,2=>[0,1],3],
            'item3'=>[0,1]
        ];

        return $this->render('partials/menu1.html.twig',['menu'=> $menu]);
    }


}



