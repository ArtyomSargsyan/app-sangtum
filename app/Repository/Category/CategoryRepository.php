<?php

namespace App\Repository\Category;

use App\Models\Category;

class CategoryRepository
{
    /**
     * Show all category function
     *
     * @return mixed
     */
    public function getAllCategory()
    {
        return Category::all();
    }

    /**
     * Add category functiFon
     *
     * @param string $name
     * @return Category
     */
    public function store(string $name): Category
    {
        return Category::create([
            "name" => $name,
        ]);
    }

    /**
     * Update category function
     *
     * @param $id
     * @param string $name
     * @return Category
     */
    public function update($id, string $name): Category
    {
        return Category::find($id)->update([
            "name" => $name,
        ]);
    }

    /**
     * Delete category function
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return Category::find($id)->delete();
    }

    /**
     * Show categories function
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return Category::find($id);
    }
}
