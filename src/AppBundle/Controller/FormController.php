<?php

namespace AppBundle\Controller;

use EzSystems\PlatformUIBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{
    public function formAction(Request $request)
    {
        return $this->render('AppBundle:admin:form.html.twig');
    }
}
