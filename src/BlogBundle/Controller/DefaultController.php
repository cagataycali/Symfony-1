<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Begeni;
use BlogBundle\Entity\Takip;
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

        $yazi = $em->createQueryBuilder()
            ->select('y') #yıldız (*) secemk için
            ->from('BlogBundle:Yazi','y') #Yazıların hepsını alıp t ye attı
            ->leftJoin('BlogBundle:Takip','t','WITH','t.takip_edilen = y.user') #butun takıp tablosunu t ye at,yazi daki user_id = BENNİM TAKİP ETTİGİM KISILERIN IDSI
            ->where('t.takip_eden =:takip_eden OR y.user=:takip_eden')
            ->setParameter('takip_eden',$this->getUser())
            ->orderBy('y.id','DESC') # TODO : HEM CREATED HEM İD
            ->getQuery()
            ->getResult();

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
        $yazi = $em->getRepository('BlogBundle:Yazi')->findOneBy(array('id'=>$id, "user"=>$this->getUser()));

        if(!$yazi)
        {
            // Flash Bag Mesajı
            $this->get('session')->getFlashBag()->set(
                'error',
                'Sadece kendi yazılarınızı silebilirsiniz!'
            );

            return $this->redirectToRoute('blog_homepage');
        }


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

        $yorum = $em->getRepository('BlogBundle:Yorum')->findOneBy(array('id'=>$id, "user"=>$this->getUser()));


        /**
         * remove fonksiyonu ile siliyoruz ve enter (flsuh) lıyoruz
         */

        $em->remove($yorum);
        $em->flush();
        return $this->redirectToRoute('blog_homepage');

    }

    public function yaziBegenAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        # $begeni=$em->getRepository('BlogBundle:Begeni')->find($id);

        $yazi = $em->getRepository('BlogBundle:Yazi')->find($id);

        $begeni=$em->getRepository('BlogBundle:Begeni')->findOneBy(array('yazi'=>$yazi, "user"=>$this->getUser()));

        if($begeni)
        {
            $em->remove($begeni);
            $em->flush();
            return $this->redirectToRoute('blog_homepage');
        }else
        {
            $yeni_begeni = new Begeni();
            $yeni_begeni -> setYazi($yazi);
            $yeni_begeni -> setUser($this->getUser());

            /**
             * verıtanaına kayıt
             */

            $em->persist($yeni_begeni);
            $em->flush();

            return $this->redirectToRoute('blog_homepage');
        }
    }


    public function profilAction($username)
    {
        /**
         * doctine çağırıyoruz
         */
        $em=$this->getDoctrine()->getManager();

        $profil=$em->getRepository('BlogBundle:User')->findOneBy(array('username'=>$username));
        $takip = $em->getRepository('BlogBundle:Takip')->findOneBy(array('takip_eden'=>$this->getUser(),'takip_edilen'=>$profil));

        if($takip)
        {
            $takip_ediyorsun = 1;

        }
        else
        {
            $takip_ediyorsun = 0;
        }


        /**
         * Profil sayfasınna üyenin profilini yolladık
         */

        return $this->render('BlogBundle:Default:profil.html.twig', array('profil'=>$profil,'takip_ediyorsun'=>$takip_ediyorsun));

    }

    public function takipAction($username)
    {
        /**
         * doctine çağırıyoruz
         */
        $em=$this->getDoctrine()->getManager();

        $profil=$em->getRepository('BlogBundle:User')->findOneBy(array('username'=>$username));
        $takip = $em->getRepository('BlogBundle:Takip')->findOneBy(array('takip_eden'=>$this->getUser(),'takip_edilen'=>$profil));

        if($takip)
        {
            $em->remove($takip);
            $em->flush();
            return $this->redirectToRoute('blog_homepage');
        }else
        {
            $yeni_takip = new Takip();
            $yeni_takip -> setTakipEden($this->getUser());
            $yeni_takip ->setTakipEdilen($profil);

            $em->persist($yeni_takip);
            $em->flush();
            return $this->redirectToRoute('blog_profil',array('username'=>$username));
        }

    }


}
