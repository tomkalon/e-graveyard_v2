<?php

namespace App\Core\Infrastructure\Utility\Pagination;

use App\Core\Domain\Utility\Pagination\PaginatorInterface as BasePaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\FormInterface;

class Paginator implements BasePaginatorInterface
{
    public function __construct(
        private readonly PaginatorInterface $paginator,
    )
    {
    }

    public function paginate($target, int $page = 1, int $limit = null, array $options = []):PaginationInterface
    {
        $pagination = $this->paginator->paginate($target, $page, $limit, $options);

        // form
        $limitForm = $options['limit_form'] ?? null;
        if ($limitForm instanceof FormInterface) {
            $limitForm = $limitForm->createView();
        }

        // get item per page
        $limit = $pagination->getItemNumberPerPage();

        // get total items
        $total = $pagination->getTotalItemCount();

        // get current page
        $page = $pagination->getCurrentPageNumber();

        // set index values
        $startIndex = max($limit * ($page - 1), min($total, 1));
        $endIndex = min($total, ($startIndex - 1) + $limit);

        $pageParameterName = $pagination->getPaginatorOption('pageParameterName');
        $sortDirectionParameterName = $pagination->getPaginatorOption('sortDirectionParameterName');
        $sortFieldParameterField = $pagination->getPaginatorOption('sortFieldParameterName');
        $filterFieldParameterName = $pagination->getPaginatorOption('filterFieldParameterName');
        $filterValueParameterName = $pagination->getPaginatorOption('filterValueParameterName');
        $distinct = $pagination->getPaginatorOption('distinct');
        $pageOutOfRange = $pagination->getPaginatorOption('pageOutOfRange');
        $defaultLimit = $pagination->getPaginatorOption('defaultLimit');

        // transfer options to paginator
        $pagination->setPaginatorOptions(array(
            'startIndex' => $startIndex,
            'endIndex' => $endIndex,
            'pageParameterName' => $pageParameterName,
            'sortDirectionParameterName' => $sortDirectionParameterName,
            'sortFieldParameterName' => $sortFieldParameterField,
            'filterFieldParameterName' => $filterFieldParameterName,
            'filterValueParameterName' => $filterValueParameterName,
            'distinct' => $distinct,
            'pageOutOfRange' => $pageOutOfRange,
            'defaultLimit' => $defaultLimit,
            'limitForm' => $limitForm
        ));

        return $pagination;
    }
}
