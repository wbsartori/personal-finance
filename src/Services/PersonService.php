<?php

namespace PersonalFinance\Services;

use PersonalFinance\Entities\Person;
use PersonalFinance\Repositories\PersonRepository;

class PersonService
{
    /**
     * @var PersonRepository
     */
    private $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->setPersonRepository($personRepository);
    }

    /**
     * @param Person $person
     * @return void
     */
    public function create(Person $person)
    {

    }

    public function read()
    {
        return $this->getPersonRepository()->getAll();
    }

    public function getPersonRepository(): PersonRepository
    {
        return $this->personRepository;
    }

    public function setPersonRepository(PersonRepository $personRepository): void
    {
        $this->personRepository = $personRepository;
    }
}
