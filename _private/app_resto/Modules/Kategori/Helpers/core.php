<?php
    use Modules\Kategori\Models\Kategori;

    /*
    |--------------------------------------------------------------------------
    | GET CATEGORIES
    |-------------------------------------------------------------------------
    */
    function categoryArray()
    {
        $cacheKey = 'getCategory';
        
        if(!\Cache::has($cacheKey)) 
        {
            $category = getRowArray(Kategori::where('status', 1)->get(), 'id', '*');
            
            \Cache::put($cacheKey, $category, 10);
        }
        else
        {
            $category = \Cache::get($cacheKey);
        }

        return [
            'id_name'   => getRowArray($category, 'id', 'nama'),
            'id_url'    => getRowArray($category, 'id', 'url'),
            'url_id'    => getRowArray($category, 'url', 'id'),
            'url_name'  => getRowArray($category, 'url', 'nama'),
            'id_all'    => getRowArray($category, 'url', '*'),
        ];
    }
