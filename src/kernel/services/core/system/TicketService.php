<?php
	namespace post2people\httpkernel\services\core\system;

	class TicketService{
		private $name;
		private $sucursal;
		private $items;
		private $total;
		private static $count = 199995;

		public function newTicket(){
			++self::$count;
		}

		public function getCount(){
			return self::$count;
		}

		public function getName(){
			return $this->name;
		}

		public function setName($name){
			$this->name = $name;
		}

		public function getSucursal(){
			return $this->sucursal;
		}

		public function setSucursal($sucursal){
			$this->sucursal = $sucursal;
		}

		public function getItems(){
			return $this->items;
		}

		public function setItems($items){
			$this->items = $items;
		}

		public function getTotal(){
			return $this->total;
		}

		public function setTotal($total){
			$this->total = $total;
		}	
	}