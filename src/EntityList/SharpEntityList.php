<?php

namespace Code16\Sharp\EntityList;

use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\Layout\EntityListLayoutColumn;
use Code16\Sharp\EntityList\Traits\HandleCommands;
use Code16\Sharp\EntityList\Traits\HandleEntityState;
use Code16\Sharp\EntityList\Traits\HandleFilters;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class SharpEntityList
{
    use HandleFilters, HandleEntityState, HandleCommands;

    /**
     * @var array
     */
    protected $containers = [];

    /**
     * @var array
     */
    protected $columns = [];

    /**
     * @var bool
     */
    protected $listBuilt = false;

    /**
     * @var bool
     */
    protected $layoutBuilt = false;

    /**
     * @var string
     */
    protected $instanceIdAttribute = "id";

    /**
     * @var string
     */
    protected $displayMode = "list";

    /**
     * @var bool
     */
    protected $searchable = false;

    /**
     * @var bool
     */
    protected $paginated = false;

    /**
     * @var string
     */
    protected $defaultSort;

    /**
     * @var string
     */
    protected $defaultSortDir;

    /**
     * Get the SharpListDataContainer array representation.
     *
     * @return array
     */
    function dataContainers(): array
    {
        $this->checkListIsBuilt();

        return collect($this->containers)->map(function(EntityListDataContainer $container) {
            return $container->toArray();
        })->keyBy("key")->all();
    }

    /**
     * Return the list fields layout.
     *
     * @return array
     */
    function listLayout(): array
    {
        if(!$this->layoutBuilt) {
            $this->buildListLayout();
            $this->layoutBuilt = true;
        }

        return collect($this->columns)->map(function(EntityListLayoutColumn $column) {
            return $column->toArray();
        })->all();
    }

    /**
     * Return data, as an array.
     *
     * @return array
     */
    function data(): array
    {
        $keys = $this->getDataContainersKeys();
        $config = $this->listConfig();
        $items = $this->getListData(
            EntityListQueryParams::createFromRequest($config["defaultSort"], $config["defaultSortDir"])
        );

        if($items instanceof LengthAwarePaginator) {
            $page = $items->currentPage();
            $totalCount = $items->total();
            $pageSize = $items->perPage();
            $items = $items->items();
        }

        return [
            "items" =>
                collect($items)
                    ->map(function($row) use($keys) {
                        // Filter model attributes on actual form fields
                        return collect($row)->only(
                            array_merge(
                                $this->entityStateAttribute ? [$this->entityStateAttribute] : [],
                                [$this->instanceIdAttribute],
                                $keys
                            )
                        )->all();
                    })->all()
        ] + (isset($page) ? compact('page', 'totalCount', 'pageSize') : []);
    }

    /**
     * Return the data config values.
     *
     * @return array
     */
    function listConfig(): array
    {
        $this->buildListConfig();

        $config = [
            "instanceIdAttribute" => $this->instanceIdAttribute,
            "displayMode" => $this->displayMode,
            "searchable" => $this->searchable,
            "paginated" => $this->paginated,
            "defaultSort" => $this->defaultSort,
            "defaultSortDir" => $this->defaultSortDir,
        ];

        $this->appendFiltersToConfig($config);

        $this->appendEntityStateToConfig($config);

        $this->appendCommandsToConfig($config);

        return $config;
    }

    /**
     * @param string $instanceIdAttribute
     * @return $this
     */
    public function setInstanceIdAttribute(string $instanceIdAttribute)
    {
        $this->instanceIdAttribute = $instanceIdAttribute;

        return $this;
    }

    /**
     * @param string $displayMode
     * @return $this
     */
    public function setDisplayMode(string $displayMode)
    {
        $this->displayMode = $displayMode;

        return $this;
    }

    /**
     * @param bool $searchable
     * @return $this
     */
    public function setSearchable(bool $searchable = true)
    {
        $this->searchable = $searchable;

        return $this;
    }

    /**
     * @param string $sortBy
     * @param string $sortDir
     * @return $this
     */
    public function setDefaultSort(string $sortBy, string $sortDir = "asc")
    {
        $this->defaultSort = $sortBy;
        $this->defaultSortDir = $sortDir;

        return $this;
    }

    /**
     * @param bool $paginated
     * @return $this
     */
    public function setPaginated(bool $paginated = true)
    {
        $this->paginated = $paginated;

        return $this;
    }

    /**
     * Add a data container.
     *
     * @param EntityListDataContainer $container
     * @return $this
     */
    protected function addDataContainer(EntityListDataContainer $container)
    {
        $this->containers[] = $container;
        $this->listBuilt = false;

        return $this;
    }

    /**
     * @param string $label
     * @param int $size
     * @param null $sizeXS
     * @return $this
     */
    protected function addColumn(string $label, int $size, $sizeXS = null)
    {
        $this->layoutBuilt = false;

        $this->columns[] = new EntityListLayoutColumn($label, $size, $sizeXS);

        return $this;
    }

    /**
     * @param string $label
     * @param int $size
     * @return $this
     */
    protected function addColumnLarge(string $label, int $size)
    {
        $this->layoutBuilt = false;

        $column = new EntityListLayoutColumn($label, $size);
        $column->setLargeOnly(true);
        $this->columns[] = $column;

        return $this;
    }

    private function checkListIsBuilt()
    {
        if (!$this->listBuilt) {
            $this->buildListDataContainers();
            $this->listBuilt = true;
        }
    }

    protected function getDataContainersKeys()
    {
        return collect($this->dataContainers())
            ->pluck("key")
            ->all();
    }

    /**
     * Retrieve all rows data as array.
     *
     * @param EntityListQueryParams $params
     * @return array
     */
    abstract function getListData(EntityListQueryParams $params);

    /**
     * Build list containers using ->addDataContainer()
     *
     * @return void
     */
    abstract function buildListDataContainers();

    /**
     * Build list layout using ->addColumn()
     *
     * @return void
     */
    abstract function buildListLayout();

    /**
     * Build list config
     *
     * @return void
     */
    abstract function buildListConfig();
}