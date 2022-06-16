<?php

namespace App\Controller;

use App\Services\AppServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AppController extends AbstractController
{
    /**
     * @Route("/", name="home")
     *
     * @return Response
     */
    
    public function Home(Request $request, AppServices $appService): Response
    {
        $postalCode = $request->get("postalCode");
        if ($postalCode != Null){
            
            $schoolList = $appService->searchByCodePostal($postalCode);

            return $this->render('searchPostalCode.html.twig', ['schoolList' =>$schoolList, 'codePostal'=>$postalCode]);

        }
       
        return $this->render('searchPostalCode.html.twig', []);
    }

}