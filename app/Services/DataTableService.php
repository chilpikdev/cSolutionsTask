<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\JsonResponse;

class DataTableService
{
    /**
     * Get Data for Table
     */
    public function getData($request, $model, $searchParams = [], $resource, $modelWithSort = null): JsonResponse
    {
        ## Read value
        $draw = $request->draw;
        $row = $request->start;
        $rowperpage = $request->length; // Rows display per page
        $columnIndex = $request->order[0]['column']; // Column index
        $columnName = $request->columns[$columnIndex]['data']; // Column name
        $columnSortOrder = $request->order[0]['dir']; // asc or desc
        $searchValue = $request->search['value']; // Search value

        $items = $model->query();

        // $items->where('name', 'LIKE', '%"' . $searchValue . '%","locale":"' . app()->getLocale() . '"%');

        if ($searchValue && count($searchParams) > 0) {
            foreach ($searchParams as $key => $param)
            {
                if ($key == 0)
                    $items->where($param['field'], 'LIKE', ($param['isJson']) ? ['value' => '%' . $searchValue . '%'] : '%' . $searchValue . '%');
                else if ($key > 0)
                    $items->orWhere($param['field'], 'LIKE', ($param['isJson']) ? ['value' => '%' . $searchValue . '%'] : '%' . $searchValue . '%');
            }
        }

        $items->orderBy($columnName, $columnSortOrder);

        if ($modelWithSort)
            $items->{$modelWithSort}();

        ## Total number of record with filtering
        $totalRecordwithFilter = $items->count();

        ## Total number of records without filtering
        if ($modelWithSort)
            $totalRecords = $items->{$modelWithSort}()->count();
        else
            $totalRecords = $model->count();

        $page = ($row / $rowperpage) + 1;

//        dd($items->get());

        $items = $items->paginate(perPage: $rowperpage, pageName: 'page', page: $page ?: 1);

        ## Data
        $data = [
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecordwithFilter,
            "data" => $resource::collection($items),
        ];

        return response()->json($data);
    }
}
