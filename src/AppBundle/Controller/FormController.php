<?php

namespace AppBundle\Controller;

use AppBundle\Form\MyForm;
use eZ\Publish\API\Repository\LocationService;
use EzSystems\PlatformUIBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{
    /**
     * @var \eZ\Publish\API\Repository\LocationService
     */
    private $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function formAction(Request $request)
    {
        $formData = new MyForm();

        $form = $this->createFormBuilder($formData)
            ->add('locationId', IntegerType::class)
            ->add('submit', SubmitType::class)
            ->getForm()
        ;

        $form->handleRequest($request);

        $location = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $location = $this->locationService->loadLocation($formData->locationId);
        }

        return $this->render('AppBundle:admin:form.html.twig', [
            'form' => $form->createView(),
            'location' => $location,
        ]);
    }
}
