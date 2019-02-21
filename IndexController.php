<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class IndexController extends AbstractController
{
  

    /**
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return JsonResponse
     * @Route("/validentity" , name="valid_entity")
     */
    public function validAction(Request $request, ValidatorInterface $validator){

        $params=json_decode($request->getContent(),true);
        $field=$params["params"]["field"];
        $entityparam=$params["params"]["entity"];
        $type=$params["params"]["type"];
        $valeur=$params["params"]["value"];
        $setter="set".ucwords($field);
        $entityparam=str_replace("-","\\",$entityparam);
        $type=str_replace("-","\\",$type);

        $entity=new $entityparam();
        $formtype=get_class(new $type());

        $entity->$setter($valeur);
        $form = $this->createForm($formtype, $entity);
        $meta=$validator->getMetadataFor($form->getConfig()->getDataClass());
        //on regarde les contraints général
        $errors = $validator->validate($entity,$meta->getConstraints());
        if (count($errors) > 0) {
            $message="";
            foreach($errors as $e){
                $message.=$e->getMessageTemplate()."<br>";
            }
            return  JsonResponse::create(array("retour"=>$message),400);
        }

        $validationGroup="Default";
        $constraints=$meta->getPropertyMetadata($field)[0]->getConstraints();
        $errors = $validator->validate($valeur,$constraints);
        if (count($errors) > 0) {
            $message="";
            foreach($errors as $e){
                $message.=$e->getMessageTemplate()."<br>";
            }

            return  JsonResponse::create(array("retour"=>$message),400);
        }else{
            return  JsonResponse::create(array(),200);
        }


    }
}
