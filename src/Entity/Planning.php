<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PlanningRepository::class)
 */
class Planning
{
    const DAYS = [
        'lundi' => 'lundi',
        'mardi' => 'mardi',
        'mercredi' => 'mercredi',
        'jeudi' => 'jeudi',
        'vendredi' => 'vendredi',
        'samedi' => 'samedi',
    ];

    const DURATION = [
        '1/4 h' => 0.25,
        '1/2 h' => 0.5,
        '3/4 h' => 0.75,
        '1h' => 1,
        '1h1/4' => 1.25,
        '1.5' => 1.5,
        '1h3/4' => 1.75,
        '2h' => 2,
        '2h1/4' => 2.25,
        '2h1/2' => 2.5,
        '2h3/4' => 2.75,
        '3h' => 3,
        '3h1/4' => 3.25,
        '3h1/2' => 3.5,
        '3h3/4' => 3.75,
        '4h' => 4,
        '4h1/4' => 4.25,
        '4h1/2' => 4.5,
        '4h3/4' => 4.75,
        '5h' => 5,
    ];

    const HOURS = [
        '8h00' => 8,
        '8h15' => 8.25,
        '8h30' => 8.5,
        '8h45' => 8.75,
        '9h00' => 9,
        '9h15' => 9.25,
        '9h30' => 9.5,
        '9h45' => 9.75,
        '10h00' => 10,
        '10h15' => 10.25,
        '10h30' => 10.5,
        '10h45' => 10.75,
        '11h00' => 11,
        '11h15' => 11.25,
        '11h30' => 11.5,
        '11h45' => 11.75,
        '12h00' => 12,
        '12h15' => 12.25,
        '12h30' => 12.5,
        '12h45' => 12.75,
        '13h00' => 13,
        '13h15' => 13.25,
        '13h30' => 13.5,
        '13h45' => 13.75,
        '14h00' => 14,
        '14h15' => 14.25,
        '14h30' => 14.5,
        '14h45' => 14.75,
        '15h00' => 15,
        '15h15' => 15.25,
        '15h30' => 15.5,
        '15h45' => 15.75,
        '16h00' => 16,
        '16h15' => 16.25,
        '16h30' => 16.5,
        '16h45' => 16.75,
        '17h00' => 17,
        '17h15' => 17.25,
        '17h30' => 17.5,
        '17h45' => 17.75,
        '18h00' => 18,
        '18h15' => 18.25,
        '18h30' => 18.5,
        '18h45' => 18.75,
        '19h00' => 19,
        '19h15' => 19.25,
        '19h30' => 19.5,
        '19h45' => 19.75,
        '20h00' => 20,
        '20h15' => 20.25,
        '20h30' => 20.5,
        '20h45' => 20.75,
        '21h00' => 21,
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="Veuillez indiquer le jour de l'activité.")
     * @Assert\Length(max=20, maxMessage="Le nom du jour ne doit pas dépasser {{ limit }} caractères.")
     */
    private $day;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(message="Veuillez indiquer l'heure de début de l'activité.")
     * @Assert\Length(max=10, maxMessage="L'heure de début d'activité ne doit pas dépasser {{ limit }} caractères.")
     */
    private $hour;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(message="Veuillez indiquer la durée de l'activité.")
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez le nom de l'activité.")
     * @Assert\Length(max=255, maxMessage="Le nom de l'activité ne doit pas dépasser {{ limit }} caractères.")
     */
    private $activity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getHour(): ?string
    {
        return $this->hour;
    }

    public function setHour(string $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getActivity(): ?string
    {
        return $this->activity;
    }

    public function setActivity(string $activity): self
    {
        $this->activity = $activity;

        return $this;
    }
}
