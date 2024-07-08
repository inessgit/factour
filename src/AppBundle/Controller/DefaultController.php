<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\LigneVente;
use AppBundle\Entity\Vente;

class DefaultController extends Controller
{
    /**
     * @Route("/sanspu", name="sans_pu")
     */
    public function sansPuAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/", name="home")
     */
    public function homeAction(Request $request)
    {
        return $this->render('default/avec_pu.html.twig');
    }
    
    /**
     * @Route("/liste", name="vente_liste")
     */
    public function listeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ventes = $em->getRepository("AppBundle:Vente")->findBy([], ["date" => "desc"]);
        return $this->render('default/liste.html.twig', array("ventes" => $ventes));
    }
    
    /**
     * @Route("/liste/{id}", name="display_facture")
     */
    public function displayFactureAction(Vente $vente)
    {
        $em = $this->getDoctrine()->getManager();
        $lignes = $em->getRepository("AppBundle:LigneVente")->findByVente($vente);

        if( $vente->getAvecPu() == true ){
        	return $this->render('default/pdf.html.twig', array(
	            'vente' => $vente,
	            'lignes' => $lignes,
	        ));   
        }

        return $this->render('default/facture.html.twig', array(
            "lignes" => $lignes,
            "vente" => $vente,
        ));
    }

    /**
     * @Route("/test", name="testpage")
     */
    public function testAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/pdf.html.twig');
    }

    /**
     * @Route("/pdf", name="pdfpage")
     */
    public function pdfAction(Request $request)
    {
        
        if($request->isMethod('POST')){
            $vente = new Vente();
            //dump($request);exit;
            $array = [];
            
            $nb = $request->request->get('nb-articles');
            $remise = $request->request->get('remise');
            $montantRemise = $request->request->get('montantRemise');
            $tva = $request->request->get('tva');
            $montantTva = $request->request->get('montantTva');
            $netCom = $request->request->get('netCom');
            $total = $request->request->get('total');
            
            $nom_client = $request->request->get('nom_client');
            $adr_client = $request->request->get('adr_client');
            $tel_client = $request->request->get('tel_client');
            
            $avec_pu = $request->request->get('avec_pu');

            $array['nb'] = $nb;
            $array['remise'] = $remise;
            $array['montantRemise'] = $montantRemise;
            $array['tva'] = $tva;
            $array['montantTva'] = $montantTva;
            $array['netCom'] = $netCom;
            $array['total'] = $total;
            
            $array['nom_client'] = $nom_client;
            $array['tel_client'] = $tel_client;
            $array['adr_client'] = $adr_client;
            $date = new \DateTime();
            $array['date'] = $date;
            
            $em = $this->getDoctrine()->getManager();
            
            if($avec_pu != "" and $avec_pu == "oui"){
            	$vente->setAvecPu(true);
            }
            else{
            	$vente->setAvecPu(false);
            }

            $vente->setAdresseClient($adr_client);
            $vente->setNomClient($nom_client);
            $vente->setTelClient($tel_client);
            $vente->setDate($date);
            $vente->setRemise($remise);
            $vente->setMontantRemise($montantRemise);
            $vente->setNetCom($netCom);
            $vente->setTva($tva);
            $vente->setMontantTva($montantTva);
            $vente->setTotal($total);
            
            $em->persist($vente);
            $em->flush();
            
            //dump($request->request); exit;
            if( $nb > 0 ){
                $articles = [];
                for ($i = 1; $i <= $nb; $i++) {
                    if($request->request->get('nom'.$i) != ""){
                        $ligne = [];
                        $ligne["nom"] = $request->request->get('nom'.$i);
                        $ligne["qte"] = $request->request->get('qte'.$i);
                        $ligne["montant"] = $request->request->get('montant'.$i);
                        
                        $ligneVente = new LigneVente();
                        $ligneVente->setArticle($ligne['nom']);
                        $ligneVente->setQuantite($ligne['qte']);
                        $ligneVente->setMontant($ligne["montant"]);
                        $ligneVente->setVente($vente);

                        if( $vente->getAvecPu() == true ){
                        	$ligne["pu"] = $request->request->get('pu'.$i);
                        	$ligneVente->setPu( $ligne["pu"] );
                        }
                        else{
                    		$ligneVente->setPu( null );
                        }
                        
                        $articles[] = $ligne;

                        $em->persist($ligneVente);
                        $em->flush();
                    }
                    
                }
                $array["articles"] = $articles;
            }
        $lignes = $em->getRepository('AppBundle:LigneVente')->findByVente($vente);
       /* $html2pdf = $this->get('app.html2pdf');
        // replace this example code with whatever you need
        $template = $this->renderView('default/pdf.html.twig', ['array' => $array]);
        //dump($template); exit;
        $html2pdf->create('P', 'A4', 'fr');

        return $html2pdf->generatePdf($template, "facture");*/
        
        if( $vente->getAvecPu() == true ){
        	return $this->render('default/pdf.html.twig', array(
	            'array' => $array,
	            'vente' => $vente,
	            'lignes' => $lignes,
	        ));   
        }

        return $this->render('default/facture.html.twig', array(
            'array' => $array,
            'vente' => $vente,
            'lignes' => $lignes,
        ));   
        }
        
    }
}