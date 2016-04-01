<?php

namespace TheGame\MapsBundle\Entity;

/**
 * Maps
 */
class Maps
{
    /**
     * @var string
     */
    private $mapName;

    /**
     * @var boolean
     */
    private $mapPlayable = false;

    /**
     * @var string
     */
    private $mapImageUrl = 'MISSING';

    /**
     * @var string
     */
    private $mapTileData = 'MISSING';

    /**
     * @var integer
     */
    private $id;


    /**
     * Set mapName
     *
     * @param string $mapName
     *
     * @return Maps
     */
    public function setMapName($mapName)
    {
        $this->mapName = $mapName;

        return $this;
    }

    /**
     * Get mapName
     *
     * @return string
     */
    public function getMapName()
    {
        return $this->mapName;
    }

    /**
     * Set mapPlayable
     *
     * @param boolean $mapPlayable
     *
     * @return Maps
     */
    public function setMapPlayable($mapPlayable)
    {
        $this->mapPlayable = $mapPlayable;

        return $this;
    }

    /**
     * Get mapPlayable
     *
     * @return boolean
     */
    public function getMapPlayable()
    {
        return $this->mapPlayable;
    }

    /**
     * Set mapImageUrl
     *
     * @param string $mapImageUrl
     *
     * @return Maps
     */
    public function setMapImageUrl($mapImageUrl)
    {
        $this->mapImageUrl = $mapImageUrl;

        return $this;
    }

    /**
     * Get mapImageUrl
     *
     * @return string
     */
    public function getMapImageUrl()
    {
        return $this->mapImageUrl;
    }

    /**
     * Set mapTileData
     *
     * @param string $mapTileData
     *
     * @return Maps
     */
    public function setMapTileData($mapTileData)
    {
        $this->mapTileData = $mapTileData;

        return $this;
    }

    /**
     * Get mapTileData
     *
     * @return string
     */
    public function getMapTileData()
    {
        return $this->mapTileData;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

