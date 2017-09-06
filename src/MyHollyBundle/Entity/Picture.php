<?php

namespace MyHollyBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Picture
 */
class Picture
{
    /**
     * Attribut permetant de stocker le nom de mon fichier en preRemove
     * @var string $tempName
     *
     */
    private $tempName;

    /**
     * @var UploadedFile $file
     *
     */
    private $file;

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        if ($this->src != null){
            $this->tempName = $this->src;

            $this->src = null;
            $this->alt = null;

        }
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function preUpload()
    {
        if ($this->tempName != null) {
            unlink($this->getUploadDir() . $this->tempName);
        }
        $this->src = uniqid() . '.' . $this->file->guessExtension(); //On créer un id(nom) unique pour le fichier, puis on recupere l'extension du fichier
        $alt = $this->file->getClientOriginalName(); //Permet de recuperer le nom original du fichier envoyé par l'utilisateur
        $ext = $this->file->guessExtension();
        $this->alt = str_replace('.'.$ext, '', $alt);
    }

    /**
     * @ORM\PostPersist
     */
    public function upload()
    {
        $this->file->move($this->getUploadDir(), $this->src);
    }

    private function getUploadDir()
    {
        return __DIR__ . '/../../../web/uploads/images/';
    }

    /**
     * @ORM\PreRemove
     */
    public function preRemove()
    {
        $this->tempName = $this->src;
    }

    /**
     * @ORM\PostRemove
     */
    public function remove()
    {
        unlink($this->getUploadDir() . $this->src);
    }


    //////////////////////
    /// GENERATED CODE ///
    //////////////////////
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $src;

    /**
     * @var string
     */
    private $alt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set src
     *
     * @param string $src
     *
     * @return Picture
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Picture
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }
}
