<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Service;

#[Route('/api', name: 'api_')]
class ServiceController extends AbstractController
{
    #[Route('/services', name: 'service_index', methods:['get'] )]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {
        $services = $doctrine
            ->getRepository(Service::class)
            ->findAll();
   
        $data = [];
   
        foreach ($services as $service) {
           $data[] = [
               'id' => $service->getId(),
               'title' => $service->getTitle(),
                'subtitle' => $service->getSubtitle(),
                'description' => $service->getSubdescription(),
                'subdescription' => $service->getSubdescription(),
                'category' => $service->getCategory(),
               'delevrytime' => $service->getDelevrytime(),
               'price' => $service->getPrice(),
               'idfreelancer' =>$service->getIdfreelancer(),
           ];
        }
        return $this->json($data);
    }
    #[Route('/services', name: 'service_create', methods:['post'] )]
    public function create(ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        
        $service = new Service();

        $service->setTitle($request->request->get('title'));
        $service->setSubtitle($request->request->get('subtitle'));
        $service->setDescription($request->request->get('description'));
        $service->setSubdescription($request->request->get('subdescription'));
        $service->setCategory($request->request->get('category'));
        $service->setPrice($request->request->get('price'));
        $service->setDelevrytime($request->request->get('delevrytime'));
        $service->setIdfreelancer($request->request->get('idfreelancer'));


        $entityManager->persist($service);
        $entityManager->flush();
   
        $data =  [
            'id' => $service->getId(),
            'title' => $service->getTitle(),
             'subtitle' => $service->getSubtitle(),
             'description' => $service->getSubdescription(),
             'subdescription' => $service->getSubdescription(),
             'category' => $service->getCategory(),
            'delevrytime' => $service->getDelevrytime(),
            'price' => $service->getPrice(),
            'idfreelancer' =>$service->getIdfreelancer(),
        ];
           
        return $this->json($data);
    }
    #[Route('/services/{id}', name: 'service_show', methods:['get'] )]
    public function show(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $service = $doctrine->getRepository(service::class)->find($id);
   
        if (!$service) {
            return $this->json('No service found for id ' . $id, 404);
        }
   
        $data =  [
            'id' => $service->getId(),
            'title' => $service->getTitle(),
             'subtitle' => $service->getSubtitle(),
             'description' => $service->getSubdescription(),
             'subdescription' => $service->getSubdescription(),
             'category' => $service->getCategory(),
            'delevrytime' => $service->getDelevrytime(),
            'price' => $service->getPrice(),
            'idfreelancer' =>$service->getIdfreelancer(),
        ];
           
        return $this->json($data);
    }
    #[Route('/services/{id}', name: 'service_update', methods: ['put', 'patch'])]
    public function update(ManagerRegistry $doctrine, int $id,Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $entityManager = $doctrine->getManager();
        $service = $entityManager->getRepository(service::class)->find($id);
        if (!$service) {
            return $this->json('No service found for id ' . $id, 404);
        }
        if($request->request->get('title'))
            $service->setTitle($request->request->get('title'));
        if($request->request->get('subtitle'))
            $service->setSubTitle($request->request->get('subtitle'));
        if($request->request->get('description'))
            $service->setDescription($request->request->get('description'));
        if($request->request->get('subdescription'))
            $service->setSubdescription($request->request->get('subdescription'));
        if($request->request->get('category'))
            $service->setCategory($request->request->get('category'));
        if($request->request->get('delevrytime'))
            $service->setDelevrytime($request->request->get('delevrytime'));
        if($request->request->get('price'))
            $service->setPrice($request->request->get('price'));
        if($request->request->get('category'))
            $service->setCategory($request->request->get('category'));
        
        $entityManager->flush();
        $data = [
            'id' => $service->getId(),
            'title' => $service->getTitle(),
             'subtitle' => $service->getSubtitle(),
             'description' => $service->getSubdescription(),
             'subdescription' => $service->getSubdescription(),
             'category' => $service->getCategory(),
            'delevrytime' => $service->getDelevrytime(),
            'price' => $service->getPrice(),
            'idfreelancer' =>$service->getIdfreelancer(),
        ];

        return $this->json($data);
    }
    #[Route('/services/{id}', name: 'service_delete', methods:['delete'] )]
    public function delete(ManagerRegistry $doctrine, int $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $service = $entityManager->getRepository(service::class)->find($id);
   
        if (!$service) {
            return $this->json('No service found for id' . $id, 404);
        }
   
        $entityManager->remove($service);
        $entityManager->flush();
   
        return $this->json('Deleted a service successfully with id ' . $id);
    }
    
}
