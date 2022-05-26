<?php
class User
{
private $username;
private $password;
private $email;
private $telefonszam;
private $birthdate;
private $kep;


    /**
     * User constructor.
     * @param $username
     * @param $password
     * @param $email
     * @param $telefonszam
     * @param $birthdate
     * @param $kep
     */
    public function __construct($username, $password, $email, $telefonszam, $birthdate, $kep)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->telefonszam = $telefonszam;
        $this->birthdate = $birthdate;
        $this->kep = $kep;
    }


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $fnev
     */
    public function setUsername($username)
    {
        $this->fnev = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->jelszo = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTelefonszam()
    {
        return $this->telefonszam;
    }

    /**
     * @param mixed $telefonszam
     */
    public function setTelefonszam($telefonszam)
    {
        $this->tel = $telefonszam;
    }

    /**
     * @return mixed
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param mixed $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->szuldatum = $birthdate;
    }

    /**
     * @return mixed
     */
    public function getKep()
    {
        return $this->kep;
    }

    /**
     * @param mixed $kep
     */
    public function setKep($kep)
    {
        $this->kep = $kep;
    }

    public function kiirfajlba(){
        $user = [
            "username" => $this->username,
            "password" => $this->password,
            "email" => $this->email,
            "telefonszam" => $this->telefonszam,
            "birthdate" => $this->birthdate,
            "kep" => $this->kep
        ];
        $file = fopen("users.txt","a"); //megnyitas hozzafuzesre
        fwrite($file, serialize($user)."\n");
        fclose($file);
    }

    public function udvozol()
    {
        echo "Szia! " . $this->username . "Itt vannak az adataid: " .  ".<br>";

    }
}