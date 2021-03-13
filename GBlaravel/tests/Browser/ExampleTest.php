<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                ->select('category_id', '123')
                ->type('title', '123')
                ->type('text', '')
                ->check('isPrivate')
                ->press('Добавить новость')
                ->screenshot('addNewsTest');
        }); 
    }

    public function testBasicExample2(){
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/1/edit')
                ->select('category_id', '123')
                ->type('title', '123')
                ->type('text', '')
                ->check('isPrivate')
                ->press('Изменить новость')
                ->screenshot('editNewsTest');
        });
    }

    public function testBasicExample3(){
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories')
                ->type('title', 'Спорт')
                ->press('Добавить категорию')
                ->screenshot('addCategoryTest');
        });
    }

    public function testBasicExample4(){
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories/1/edit')
                ->type('title', '')
                ->press('Сохранить')
                ->screenshot('editCategoryTest');
        });
    }
}