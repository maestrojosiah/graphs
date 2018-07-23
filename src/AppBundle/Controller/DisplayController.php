<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DisplayController extends Controller
{
    /**
     * @Route("/show/{graph_id}/{which}", defaults={"which"="show"}, name="graphs_show")
     */
    public function showAction(Request $request, $graph_id, $which)
    {   
        ini_set('memory_limit', '-1');
    	$data = [];
    	$user = $this->user();
    	$graph = $this->em()->getRepository("AppBundle:Graph")->find($graph_id);
    	$graph_title = $graph->getTitle();
    	$timelines = $this->em()->getRepository("AppBundle:Timeline")
    		->findBy(
    			array('graph' => $graph),
    			array('id' => 'ASC')
    		);
    	$config = $this->em()->getRepository("AppBundle:Config")
    		->findBy(
    			array('user' => $user),
    			array('id' => 'ASC'),
    			1
    		);

    	if($graph->getGrouping() != 0) {
    		$chunked_timelines = array_chunk($timelines, $graph->getGrouping());
    	} else {
    		$chunked_timelines = NULL;
    	}

		$qb = $this->em()->createQueryBuilder();
		$qb = $qb
		->select( 'SUM(e.figure) as score' )
		->from( 'AppBundle:Timeline', 'e' )
		->where( $qb->expr()->andX(
			$qb->expr()->eq( 'e.graph', ':graph' )
			) )
		->setParameter( 'graph', $graph->getId() )
		->getQuery()
		;

		$score = $qb->getOneOrNullResult();

		$data['timelines'] = $timelines;
    	$data['graph'] = $graph;
    	$data['config'] = $config;
    	$data['score'] = $score;
    	$data['chunked_timelines'] = $chunked_timelines;

        if($graph->getGrouping() > 0){
            $orientation = "Landscape";
            $zoom = 1;
        } else {
            $orientation = "Portrait";
            $zoom = 1.5;
        }
        
    	if($request->query->get('p')){
    		$format = $request->query->get('p');
	        if($format == 'pdf'){
	            $appPath = $this->container->getParameter('kernel.root_dir');

	            $html = $this->renderView('AppBundle::Display/doc.html.twig', $data);

	            $filename = sprintf("{$graph_title}-%s.pdf", date('Ymd~his'));

	            return new Response(
	                $this->get('knp_snappy.pdf')->getOutputFromHtml($html, array('orientation'=>$orientation, 'zoom' => $zoom)),
	                200,
	                [
	                    'Content-Type'        => 'application/pdf',
	                    'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
	                ]
	            );

	        } else if($format == 'img') {
	            $appPath = $this->container->getParameter('kernel.root_dir');

	            $html = $this->renderView('AppBundle::Display/img.html.twig', $data);

	            $filename = sprintf("{$graph_title}-%s.jpg", date('Ymd~his'));

	            return new Response(
	                $this->get('knp_snappy.image')->getOutputFromHtml($html),
	                200,
	                [
	                    'Content-Type'        => 'image/jpg',
	                    'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
	                ]
	            );

	        }

    	} else {

            switch ($which) {
                case 'bar_one':
                    $page = 'bar_one';
                    break;
                case 'bar_two':
                    $page = 'bar_two';
                    break;
                case 'horiz':
                    $page = 'horiz';
                    break;
                case 'pie':
                    $page = 'pie';
                    break;
                default:
                    $page = 'show';
                    break;
            }
        $data['which'] = $which;
    	return $this->render("AppBundle:Display:$page.html.twig", $data);
      }
        
    } 

    private function em(){
        $em = $this->getDoctrine()->getManager();
        return $em;
    }

    private function find($entity, $id){
        $entity = $this->em()->getRepository("AppBundle:$entity")->find($id);
        return $entity;
    }

    private function findby($entity, $by, $actual){
        $query_string = "findBy$by";
        $entity = $this->em()->getRepository("AppBundle:$entity")->$query_string($actual);
        return $entity;
    }

    private function findandlimit($entity, $by, $actual, $limit, $order){
        $entity = $this->em()->getRepository("AppBundle:$entity")
            ->findBy(
                array($by => $actual),
                array('id' => $order),
                $limit
            );
        return $entity;
    }
    
    private function findbyandlimit($entity, $by, $actual, $by2, $actual2, $limit, $offset){
        $entity = $this->em()->getRepository("AppBundle:$entity")
            ->findBy(
                array($by => $actual, $by2 => $actual2),
                array('id' => 'ASC'),
                $limit,
                $offset
            );
        return $entity;
    }

    private function save($entity){
        $this->em()->persist($entity);
        $this->em()->flush();
        return true;
    }

    private function delete($entity){
        $this->em()->remove($entity);
        $this->em()->flush();
        return true;
    }

    private function user(){
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        return $user;
    }

}
