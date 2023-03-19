<?php
class Account
{

    private int $userId;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private string $postalcode;
    private int $houseNumber;

	/**
	 * @return int
	 */
	public function getHouseNumber(): int {
		return $this->houseNumber;
	}
	
	/**
	 * @param int $houseNumber 
	 * @return self
	 */
	public function setHouseNumber(int $houseNumber): self {
		$this->houseNumber = $houseNumber;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPostalcode(): string {
		return $this->postalcode;
	}
	
	/**
	 * @param string $postalcode 
	 * @return self
	 */
	public function setPostalcode(string $postalcode): self {
		$this->postalcode = $postalcode;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string {
		return $this->password;
	}

	/**
	 * @param string $password 
	 * @return self
	 */
	public function setPassword(string $password): self {
		$this->password = $password;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string {
		return $this->email;
	}

	/**
	 * @param string $email 
	 * @return self
	 */
	public function setEmail(string $email): self {
		$this->email = $email;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLastname(): string {
		return $this->lastname;
	}

	/**
	 * @param string $lastname 
	 * @return self
	 */
	public function setLastname(string $lastname): self {
		$this->lastname = $lastname;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getUserId(): int {
		return $this->userId;
	}

	/**
	 * @param int $userId 
	 * @return self
	 */
	public function setUserId(int $userId): self {
		$this->userId = $userId;
		return $this;
	}
	/**
	 * @return string
	 */
	public function getFirstname(): string {
		return $this->firstname;
	}
	
	/**
	 * @param string $firstname 
	 * @return self
	 */
	public function setFirstname(string $firstname): self {
		$this->firstname = $firstname;
		return $this;
	}
}
?>