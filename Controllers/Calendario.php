<?php 

	class Calendario extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function calendario()
		{
            $this->views->getView($this,"calendario");
		}

	}
 ?>