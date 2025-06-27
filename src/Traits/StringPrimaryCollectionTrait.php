<?php
/**
 * @package App Utils
 * @subpackage Collections
 * @see \AppUtils\Traits\StringPrimaryCollectionTrait
 */

declare(strict_types=1);

namespace AppUtils\Traits;

use AppUtils\Collections\CollectionException;
use AppUtils\Collections\Events\ItemsInitializedEvent;
use AppUtils\Collections\RecordNotExistsException;
use AppUtils\Interfaces\StringPrimaryCollectionInterface;
use AppUtils\Interfaces\StringPrimaryRecordInterface;

/**
 * Trait that can be used to implement a string-based item collection
 * without extending the {@see BaseStringPrimaryCollection} class - for
 * example, if the class already extends another class.
 *
 * @package App Utils
 * @subpackage Collections
 * @author Sebastian Mordziol <s.mordziol@mistralys.eu>
 *
 * @see StringPrimaryCollectionInterface
 */
trait StringPrimaryCollectionTrait
{
    /**
     * @var array<string,StringPrimaryRecordInterface>
     */
    protected array $items;

    /**
     * @return array<string,StringPrimaryRecordInterface>
     */
    protected function initItems() : array
    {
        if(isset($this->items)) {
            return $this->items;
        }

        $this->items = array();

        $this->registerItems();

        uasort($this->items, array($this, 'sortItems'));

        $this->triggerEvent(new ItemsInitializedEvent($this));

        return $this->items;
    }

    protected function sortItems(StringPrimaryRecordInterface $a, StringPrimaryRecordInterface $b) : int
    {
        return strnatcasecmp($a->getID(), $b->getID());
    }

    abstract protected function registerItems() : void;

    protected function registerItem(StringPrimaryRecordInterface $item) : self
    {
        $this->items[$item->getID()] = $item;
        return $this;
    }

    /**
     * @return StringPrimaryRecordInterface[]
     */
    public function getAll() : array
    {
        return array_values($this->initItems());
    }

    /**
     * @return StringPrimaryRecordInterface
     * @throws CollectionException
     */
    public function getDefault(): StringPrimaryRecordInterface
    {
        return $this->getByID($this->getDefaultID());
    }

    /**
     * @param string $id
     * @return StringPrimaryRecordInterface
     * @throws CollectionException
     */
    public function getByID(string $id) : StringPrimaryRecordInterface
    {
        $items = $this->initItems();

        if(isset($items[$id]))
        {
            return $items[$id];
        }

        throw new RecordNotExistsException($this, $id, StringPrimaryCollectionInterface::ERROR_CODE_RECORD_NOT_FOUND);
    }

    public function idExists(string $id) : bool
    {
        $items = $this->initItems();

        return isset($items[$id]);
    }

    public function getIDs(): array
    {
        return array_keys($this->initItems());
    }

    /**
     * Utility method that can be used in the {@see self::getDefaultID()}
     * method if no specific default ID is available. Will automatically
     * use the first item in the collection as the default ID if the
     * list is not empty.
     *
     * @return string
     */
    protected function getAutoDefault() : string
    {
        // Important: Init the items here to ensure that the
        // collection is loaded and sorted before we try to
        // access the first item.
        $items = $this->initItems();

        if(!empty($items)) {
            return array_key_first($items);
        }

        return StringPrimaryCollectionInterface::ID_NO_DEFAULT_AVAILABLE;
    }
}
