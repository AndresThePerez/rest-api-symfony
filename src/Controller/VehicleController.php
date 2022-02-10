<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Vehicle;

use Knp\Component\Pager\PaginatorInterface;

class VehicleController extends AbstractController
{
    /**
     * @Route("/vehicle", name="vehicle", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $search = $request->query->get('search');
        $column = $request->query->get('column');
        $sort = $request->query->get('sort');

        $vehicles = $this->getDoctrine()
            ->getRepository(Vehicle::class)
            ->searchAndSortAllQueryBuilder($search, $column, $sort);
 
        $data_paginated = [];

        $vehiclesResult = $paginator->paginate(
            // Doctrine Query, not results
            $vehicles,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            5
        );

        foreach($vehiclesResult as $vehicle) {
            $data_paginated[] = [
                'id' => $vehicle->getId(),
                'date' => $vehicle->getDate(),
                'type' => $vehicle->getType(),
                'msrp' => $vehicle->getMsrp(),
                'year' => $vehicle->getYear(),
                'make' => $vehicle->getMake(),
                'model' => $vehicle->getModel(),
                'miles' => $vehicle->getMiles(),
                'vin' => $vehicle->getVin(),
                'deleted' => $vehicle->getDeleted()
            ];
        }
        return $this->json($data_paginated);
    }

    /**
     * @Route("/vehicle", name="vehicle_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
 
        $vehicle = new Vehicle();
        $vehicle->setId($request->request->get('id'));
        $vehicle->setDate(\DateTime::createFromFormat('Y-m-d', $request->request->get('date')));
        $vehicle->setType($request->request->get('type'));
        $vehicle->setMsrp($request->request->get('msrp'));
        $vehicle->setYear($request->request->get('year'));
        $vehicle->setMake($request->request->get('make'));
        $vehicle->setModel($request->request->get('model'));
        $vehicle->setMiles($request->request->get('miles'));
        $vehicle->setVin($request->request->get('vin'));
        $vehicle->setDeleted(filter_var($request->request->get('deleted'), FILTER_VALIDATE_BOOLEAN));
 
        $entityManager->persist($vehicle);
        $entityManager->flush();
 
        return $this->json('Created new project successfully with id ' . $vehicle->getId());
    }

    /**
     * @Route("/vehicle/{id}", name="vehicle_show", methods={"GET"})
     */
    public function show(int $id) {
        $vehicle = $this->getDoctrine()
        ->getRepository(Vehicle::class)
        ->find($id);

        if (!$vehicle) {
            return $this->json('No project found for id' . $id, 404);
        }

        $data = [
            'id' => $vehicle->getId(),
            'date' => $vehicle->getDate(),
            'type' => $vehicle->getType(),
            'msrp' => $vehicle->getMsrp(),
            'year' => $vehicle->getYear(),
            'make' => $vehicle->getMake(),
            'model' => $vehicle->getModel(),
            'miles' => $vehicle->getMiles(),
            'vin' => $vehicle->getVin(),
            'deleted' => $vehicle->getDeleted()
        ];
        
        return $this->json($data);
    }


    /**
     * @Route("/vehicle/{id}", name="vehicle_edit", methods={"PATCH", "PUT"})
     */
    public function edit(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $vehicle = $entityManager->getRepository(Vehicle::class)->find($id);
 
        if (!$vehicle) {
            return $this->json('No project found for id' . $id, 404);
        }

        $vehicle->setDate(\DateTime::createFromFormat('Y-m-d', $request->request->get('date')));
        $vehicle->setType($request->request->get('type'));
        $vehicle->setMsrp($request->request->get('msrp'));
        $vehicle->setYear($request->request->get('year'));
        $vehicle->setMake($request->request->get('make'));
        $vehicle->setModel($request->request->get('model'));
        $vehicle->setMiles($request->request->get('miles'));
        $vehicle->setVin($request->request->get('vin'));
        $vehicle->setDeleted(filter_var($request->request->get('deleted'), FILTER_VALIDATE_BOOLEAN));
        $entityManager->flush();
 
        $data = [
            'id' => $vehicle->getId(),
            'date' => $vehicle->getDate(),
            'type' => $vehicle->getType(),
            'msrp' => $vehicle->getMsrp(),
            'year' => $vehicle->getYear(),
            'make' => $vehicle->getMake(),
            'model' => $vehicle->getModel(),
            'miles' => $vehicle->getMiles(),
            'vin' => $vehicle->getVin(),
            'deleted' => $vehicle->getDeleted()
        ];
        
         
        return $this->json($data);
    }

    /**
     * @Route("/vehicle/{id}", name="vehicle_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $vehicle = $entityManager->getRepository(Vehicle::class)->find($id);
 
        if (!$vehicle) {
            return $this->json('No project found for id' . $id, 404);
        }
 
        $entityManager->remove($vehicle);
        $entityManager->flush();
 
        return $this->json('Deleted a project successfully with id ' . $id);
    }
}
