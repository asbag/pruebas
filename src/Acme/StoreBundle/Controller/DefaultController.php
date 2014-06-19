<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\StoreBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeStoreBundle:Default:index.html.twig', array('name' => $name));
    }


public function createAction() {
    $product = new Product();
    $product->setName('A Foo Bar');
    $product->setPrice('19.99');
    $product->setDescription('Lorem ipsum dolor');

    $em = $this->getDoctrine()->getManager();
    $em->persist($product);
    $em->flush();

    return new Response('Created product id '.$product->getId());
}

public function showAction($id)
{
    $product = $this->getDoctrine()
        ->getRepository('AcmeStoreBundle:Product')
        ->find($id);
    if (!$product) {
        throw $this->createNotFoundException('No product found for id '.$id);
    } else {
	return new Response('El nombre es ' . $product->getName() . ' y el precio es de ' . $product->getPrice());

    }

}


public function show2Action($nombre,$descripcion){
//Encontramos el registro por nombre y descripcion, que se cumplan ambas condiciones
	$product = $this->getDoctrine()
		->getRepository('AcmeStoreBundle:Product')
		->findOneBy(array('name' => $nombre, 'description' => $descripcion));
	if (!$product) {
		throw $this->createNotFoundException('No product found for name '.$nombre . ' and decription ' . $descripcion);
	} else {
		return new Response('El nombre es ' . $product->getName() . ' y el precio es de ' . $product->getPrice());
	}
}

}
