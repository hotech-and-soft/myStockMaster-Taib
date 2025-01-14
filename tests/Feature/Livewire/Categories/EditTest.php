<?php

declare(strict_types=1);

use App\Http\Livewire\Categories\Edit;
use App\Models\Category;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;

it('test the category edit component if working', function () {
    $this->loginAsAdmin();

    Livewire::test(Edit::class)
        ->assertOk()
        ->assertViewIs('livewire.categories.edit');
});

it('tests the update category component', function () {
    $this->withoutExceptionHandling();
    $this->loginAsAdmin();

    $category = Category::factory()->create();

    Livewire::test(Edit::class, ['id' => $category->id])
        ->set('name', 'Electronics')
        ->set('code', '123456')
        ->call('update')
        ->assertHasNoErrors();

    assertDatabaseHas('categories', [
        'name' => 'Electronics',
        'code' => '123456',
    ]);
});


it('tests the category update component validation', function () {
    $this->withoutExceptionHandling();
    $this->loginAsAdmin();

    $category = Category::factory()->create();

    Livewire::test(Edit::class, ['id' => $category->id])
        ->set('name', '')
        ->set('code', '')
        ->call('update')
        ->assertHasErrors(
            ['name' => 'required'],
            ['code'    => 'required']
        );
});
