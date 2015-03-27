<?php

namespace AppBundle\Interfaces;

interface Opinionable
{
	public function addOpinion(\AppBundle\Entity\Opinion $opinions);
	
	public function removeOpinion(\AppBundle\Entity\Opinion $opinions);
	
	public function getOpinions(); 
	
	public function getOpinion($id);
}
