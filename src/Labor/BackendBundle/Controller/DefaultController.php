<?php

namespace Labor\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Labor\BackendBundle\Entity\Groups;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LaborBackendBundle:Default:index.html.twig');
    }
    public function registerAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
         
        $groups = $em->createQueryBuilder()
                        ->select('y')
                        ->from('LaborBackendBundle:Groups', 'y')
                        ->addOrderBy('y.id','ASC')
                        ->getQuery()
                        ->getResult();

        //$groups = $query->getResult();

        
        return $this->render('LaborBackendBundle:Default:register.html.twig', array(
            'groups' => $groups
        ));

    }    
    public function profilAction()
    {
        return $this->render('LaborBackendBundle:Default:profil.html.twig');
    }        
    public function addGroupAction(Request $request)
    {
        // create a task and give it some dummy data for this example


        
//        $groups->setName('Write a blog post');
//        $groups->setDescription('Write a blog post');
        //$group->setDescription('Write a blog post');
//        $group->setCreate_Date(new \DateTime('today'));
        $groups = new Groups();  
        $em = $this->getDoctrine()->getManager(); 
        $form = $this->createFormBuilder($groups)
            ->add('name', 'text')
            ->add('description', 'textarea')
            ->add('save', 'submit', array('label' => 'Create Post'))
            ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            //$data = $form->getData();
            if ($form->isValid()) {
                //$gdata = $form->getData();
                $gdata = $request->request->get("form");
                var_dump($gdata['description']);
                $groups->setName($gdata['name']);
                $groups->setDescription($gdata['description']);
                $groups->setCreateDate(new \DateTime('today'));
                $em->persist($groups);
                $em->flush();
                return $this->redirect($this->generateUrl('labor_backend_register'));
            }
        }
        return $this->render('LaborBackendBundle:Default:addGroup.html.twig', array(
            'form' => $form->createView(),
        ));
    }     
  
    public function removeAction($type,$id)
    {
        switch ($type) {
        case 0:
            $em = $this->getDoctrine()->getManager();
            $Groups = $em->getRepository('LaborBackendBundle:Groups')->find($id);

            if (!$Groups) {
                throw $this->createNotFoundException(
                    'No Group found for id '.$id
                );
            }

            $em->remove($Groups);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'removed',
                'Group wurde gelöscht!'
            );
            return $this->redirect($this->generateUrl('labor_backend_register'));
            break;
#        case 1:
#            $em = $this->getDoctrine()->getManager();
#            $Subtags = $em->getRepository('CubesBackendBundle:Subtag')->find($id);#

#            if (!$Subtags) {
#                throw $this->createNotFoundException(
#                    'No Subtag found for id '.$id
#                );
#            }
#            $this->get('session')->getFlashBag()->add(
#                'removed',
#                'Subtag wurde gelöscht!'
#            );
#            $em->remove($Subtags);
#            $em->flush();#

#            return $this->redirect($this->generateUrl('cubes_backend_tags'));
#            break;
#        case 2:
#            $em = $this->getDoctrine()->getManager();
#            $Mitglieder = $em->getRepository('CubesBackendBundle:Users')->find($id);#

#            if (!$Mitglieder) {
#                throw $this->createNotFoundException(
#                    'No User found for id '.$id
#                );
#            }
#            
#            $em->remove($Mitglieder);
#            $em->flush();
#            $this->get('session')->getFlashBag()->add(
#                'removed',
#                'Mitglieder wurde gelöscht!'
#            );
#            return $this->redirect($this->generateUrl('cubes_backend_mitglieder'));
#            break;
#        case 3:
#            $em = $this->getDoctrine()->getManager();
#            $Methode = $em->getRepository('CubesBackendBundle:Methode')->find($id);#

#            if (!$Methode) {
#                throw $this->createNotFoundException(
#                    'No Method found for id '.$id
#                );
#            }
#            $this->get('session')->getFlashBag()->add(
#                'removed',
#                'Method wurde gelöscht!'
#            );
#            $em->remove($Methode);
#            $em->flush();#

#            return $this->redirect($this->generateUrl('cubes_backend_methoden'));
#            break;
        }
    }  
}
