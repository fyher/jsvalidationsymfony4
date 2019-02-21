<?php

namespace App\Twig;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class FormExtension extends AbstractExtension
{


    private $validator;
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator=$validator;
    }

    public function getFunctions()
  {
      return array(new TwigFunction("form_extension_js_checker",[$this,'checker'],['needs_environment'=>true,'is_safe'=>['html']]));
  }

  public function checker( \Twig_Environment $environment,$form,$formtype,$id,$entity){
        

      return $environment->render("Extension/FormExtension.html.twig",array(
          "entity"=>$entity,
          "formtype"=>$formtype,
          "id"=>$id
      ));


    

  }
}
