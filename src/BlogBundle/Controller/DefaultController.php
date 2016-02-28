<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Yazi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction()
    {
        /**
         *doctrine cagıralım
         */
        $em = $this->getDoctrine()->getManager();

        /**
         * yazilari bulalım
         */
        $yazi = $em->getRepository('BlogBundle:Yazi')->findAll();

        return $this->render('BlogBundle:Default:index.html.twig',array('yazilar'=>$yazi));
    }

    public function yaziEkleAction(Request $request)
    {
        /**
         * Posttan veriyi alalım..
         */

        $yazi_icerik = $request->request->get('yazi_icerik');

        /**
         *Doctrine yardımcısını çağıralım
         */

        $em=$this->getDoctrine()->getManager();

        /**
         * yeni yazıyı ekleyelim
         */

        $yeni_yazi=new Yazi();

        $yeni_yazi->setIcerik($yazi_icerik);
        $yeni_yazi->setUser($this->getUser());

        /**
         * post edilen verileri database e kaydedicez
         */

        $em->persist($yeni_yazi);
        $em->flush();

        return $this->redirectToRoute('blog_homepage');
    }

    public function yaziSilAction($id)
    {
        /**
         *doctrine cagıralım
         */
        $em = $this->getDoctrine()->getManager();

        /**
         * yaziyi bulalım
         */
        $yazi = $em->getRepository('BlogBundle:Yazi')->find($id);

        $em->remove($yazi);
        $em->flush();
        return $this->redirectToRoute('blog_homepage');
    }
}
