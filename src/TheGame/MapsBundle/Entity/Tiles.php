<?php

namespace TheGame\MapsBundle\Entity;

/**
 * Tiles
 */
class Tiles
{
    /**
     * @var integer
     */
    private $mapId;

    /**
     * @var string
     */
    private $tileColRow;

    /**
     * @var string
     */
    private $tileSectorName;

    /**
     * @var boolean
     */
    private $tilePlayable = false;

    /**
     * @var string
     */
    private $tileData;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set mapId
     *
     * @param integer $mapId
     *
     * @return Tiles
     */
    public function setMapId($mapId)
    {
        $this->mapId = $mapId;

        return $this;
    }

    /**
     * Get mapId
     *
     * @return integer
     */
    public function getMapId()
    {
        return $this->mapId;
    }

    /**
     * Set tileColRow
     *
     * @param string $tileColRow
     *
     * @return Tiles
     */
    public function setTileColRow($tileColRow)
    {
        $this->tileColRow = $tileColRow;

        return $this;
    }

    /**
     * Get tileColRow
     *
     * @return string
     */
    public function getTileColRow()
    {
        return $this->tileColRow;
    }

    /**
     * Set tileSectorName
     *
     * @param string $tileSectorName
     *
     * @return Tiles
     */
    public function setTileSectorName($tileSectorName)
    {
        $this->tileSectorName = $tileSectorName;

        return $this;
    }

    /**
     * Get tileSectorName
     *
     * @return string
     */
    public function getTileSectorName()
    {
        return $this->tileSectorName;
    }

    /**
     * Set tilePlayable
     *
     * @param boolean $tilePlayable
     *
     * @return Tiles
     */
    public function setTilePlayable($tilePlayable)
    {
        $this->tilePlayable = $tilePlayable;

        return $this;
    }

    /**
     * Get tilePlayable
     *
     * @return boolean
     */
    public function getTilePlayable()
    {
        return $this->tilePlayable;
    }

    /**
     * Set tileData
     *
     * @param string $tileData
     *
     * @return Tiles
     */
    public function setTileData($tileData)
    {
        $this->tileData = $tileData;

        return $this;
    }

    /**
     * Get tileData
     *
     * @return string
     */
    public function getTileData()
    {
        return $this->tileData;
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

