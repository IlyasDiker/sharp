<?php

namespace Code16\Sharp\Http\Api;

use Code16\Sharp\Exceptions\SharpInvalidEntityKeyException;
use Code16\Sharp\Exceptions\SharpMethodNotImplementedException;

class EntityListController extends ApiController
{
    public function show(string $entityKey)
    {
        sharp_check_ability('entity', $entityKey);

        $list = $this->getListInstance($entityKey);
        $list->buildListConfig();
        $list->initQueryParams();

        return response()->json([
            'containers' => $list->fields(),
            'layout' => $list->listLayout(),
            'data' => $list->data(),
            'fields' => $list->listMetaFields(),
            'config' => $list->listConfig(
                $this->entityManager->entityFor($entityKey)->hasShow(),
            ),
        ]);
    }

    /**
     * Reorder instances.
     */
    public function update(string $entityKey)
    {
        sharp_check_ability('entity', $entityKey);

        $list = $this->getListInstance($entityKey);
        $list->buildListConfig();
        $list->initQueryParams();

        $list->reorderHandler()
            ->reorder(request('instances'));

        return response()->json([
            'ok' => true,
        ]);
    }

    public function delete(string $entityKey, string $instanceId = null)
    {
        sharp_check_ability('delete', $entityKey, $instanceId);

        $impl = $this->getListInstance($entityKey);
        if (! is_method_implemented_in_concrete_class($impl, 'delete')) {
            // Try to delete from Show Page
            try {
                $impl = $this->getShowInstance($entityKey);
            } catch (SharpInvalidEntityKeyException $ex) {
                // No Show Page implementation was defined for this entity
                throw new SharpMethodNotImplementedException('The delete() method is not implemented, neither in the Entity List nor in the Show Page');
            }
        }

        $impl->delete($instanceId);

        return response()->json([
            'ok' => true,
        ]);
    }
}
