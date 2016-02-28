<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Yazi;
use BlogBundle\Entity\Yorum;
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

    public function yorumEkleAction(Request $request)
    {
        /**
         * posttan gelen veriyi yakala
         */

        $yorum=$request->request->get('yorum');
        $yazi_id=$request->request->get('yazi_id');

        /**
         * doctrine çağırıyoruz
         */

        $em=$this->getDoctrine()->getManager();

        /**
         * yazimizi yazi entitisinden buluyoruz
         */

        $yazi=$em->getRepository('BlogBundle:Yazi')->find($yazi_id);

        /**
         * yeni yorumu atıyoruz.
         */

        $yeni_yorum =new Yorum();
        $yeni_yorum->setIcerik($yorum);
        $yeni_yorum->setYazi($yazi);
        $yeni_yorum->setUser($this->getUser());

        /**
         * veri tabanına gönderiyoruz
         */

        $em->persist($yeni_yorum);
        $em->flush();

        return $this->redirectToRoute('blog_homepage');

    }

    public function yorumSilAction($id){

        /**
         * doctrini çağıralım
         */

        $em=$this->getDoctrine()->getManager();

        /**
         * hangi yorumu sileceğimizi buluyoruz
         */

        $yorum = $em->getRepository('BlogBundle:Yorum')->find($id);

        /**
         * remove fonksiyonu ile siliyoruz ve enter (flsuh) lıyoruz
         */

        $em->remove($yorum);
        $em->flush();
        return $this->redirectToRoute('blog_homepage');

    }


}
