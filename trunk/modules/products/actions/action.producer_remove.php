<?php
	include_once('modules/products/include/class.producer.php');
	if($producer_id = $this->forms_get()->get('producer_id')
			)
	{
		if($producer = new Producer($this, $producer_id))
		{
			if(!$producer->remove())
				$this->log(LOG_ERROR, 'Can not remove producer!');
		}
		else
			$this->log(LOG_ERROR, 'Can not create object!');
	}
	else
		$this->log(LOG_ERROR, 'Can not open fields!');
?>