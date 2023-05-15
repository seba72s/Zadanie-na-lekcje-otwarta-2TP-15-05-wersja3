<?php
class Payments {
	private $sql1 = "SELECT customers.contactFirstName AS `Imię`, customers.contactLastName AS `Nazwisko`, 
		SUM(orderdetails.priceEach*quantityOrdered) AS  `Zamówiony towar` FROM customers
		INNER JOIN orders ON customers.customerNumber=orders.customerNumber
		INNER JOIN orderdetails On orders.orderNumber=orderdetails.orderNumber";
		
	private $sql2 = "SELECT customers.customerNumber, customers.contactFirstName,
		customers.contactLastName, SUM(payments.amount) AS `Suma płatności` FROM customers
		INNER JOIN payments ON customers.customerNumber = payments.customerNumber";
		
	private function sqlComplited1($name, $lastname) {
		if(empty($name) && empty($lastname)){
			$sqlComplited1 = $this->sql1. " GROUP BY customers.customerNumber  ORDER BY `Zamówiony towar` ASC";
		} else {
			$sqlComplited1 = $this->sql1. " WHERE contactFirstName = '".$name."' AND contactLastName = '".$lastname."'
			GROUP BY customers.customerNumber  ORDER BY `Zamówiony towar` ASC";
		}
		return $sqlComplited1;
	}
	
	private function sqlComplited2($name, $lastname) {
		if(empty($name) && empty($lastname)){
			$sqlComplited2 = $this->sql2. " GROUP BY payments.customerNumber ORDER BY `Suma płatności`";
		} else {
			/* lista płatności z pola $this->sql2, dodane filtrowanie według contactFirstName, contactLastName, grupowanie po customerNumber,
			 sortowanie po polu `Suma płatności`*/
		}
		return $sqlComplited2;
	}
	
	private function sqlComplited3($name, $lastname) {
		if(empty($name) && empty($lastname)){
			$sqlComplited3 = $this->sql1. " ORDER BY `Zamówiony towar` ASC";
		} else {
			$sqlComplited3 = $this->sql1. "  WHERE contactFirstName = '".$name."' AND contactLastName = '".$lastname."' ORDER BY `Zamówiony towar` ASC";
		}
		return $sqlComplited3;
	}
	
	private function sqlComplited4($name, $lastname) {
		if(empty($name) && empty($lastname)){
			/*.....suma płatności z pola $this->sql2 posortowana po polu 'Suma płatności'.....*/
		} else {
			$sqlComplited4 = $this->sql2. "  WHERE contactFirstName = '".$name."' AND contactLastName = '".$lastname."' ORDER BY `Suma płatności`";
		}
		return $sqlComplited4;
	}
	
	private function getConnection() {
		return new mysqli("localhost", "root", "", "classicmodels");
	}
	
	public function getSqlComplited1($name, $lastname) {
		if (is_null($name) || is_null($lastname)) {return '';}
		$conn = $this->getConnection();
		$result = $conn->query($this->sqlComplited1($name, $lastname));
		$conn->close();
		$resultHtml = '';
		$resultHtml = '<table border="1">';
		while($row = $result->fetch_array()){
			$resultHtml .= "<tr><td>".$row[0]." </td><td> ".$row[1]." </td><td> ".$row[2]." </td></tr>";
		}
		$resultHtml .= "</table>";
		return  $resultHtml;
	}
	
	public function getSqlComplited2($name, $lastname) {
		if (is_null($name) || is_null($lastname)) {return '';}
		
		/* zwrócenie zawartości zapytania $this->sqlComplited2 w postaci tabeli Html (zwróc uwagę, że zapytanie zwraca 4 kolumny) */
	}
	
	public function getSqlComplited3($name, $lastname) {
		if (is_null($name) || is_null($lastname)) {return '';}
		
		/* zwrócenie zawartości zapytania $this->sqlComplited3 w postaci niesformatowanej (zwróc uwagę, 
		że zapytanie zwraca wartość zamówionego towaru w 3 kolumnnie) */
	}
	
	public function getSqlComplited4($name, $lastname) {
		if (is_null($name) || is_null($lastname)) {return '';}
		$conn = $this->getConnection();
		$result = $conn->query($this->sqlComplited4($name, $lastname));
		$conn->close();
		while($row = $result->fetch_array()){
			$payments = $row[3];
		}
		return $payments;
	}
}