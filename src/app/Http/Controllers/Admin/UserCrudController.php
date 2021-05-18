<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn('email');
        $this->crud->addColumn('username');
        $this->crud->addColumn('name');
        $this->crud->addColumn('created_at');
        $this->crud->addColumn('updated_at');

        $this->crud->addBulkDeleteButton();

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserRequest::class);

        $this->crud->addField([
            'name' => 'given_name',
            'attributes' => [
                'autocomplete' => 'off'
            ]
        ]);
        $this->crud->addField([
            'name' => 'nickname',
            'attributes' => [
                'autocomplete' => 'off'
            ]
        ]);
        $this->crud->addField(['name' => 'middle_name']);
        $this->crud->addField(['name' => 'family_name']);
        $this->crud->addField([
            'name' => 'gender',
            'label' => 'Gender',
            'type' => 'radio',
            'options' => [
                'male' => 'Male',
                'female' => 'Female'
            ]
        ]);
        $this->crud->addField([
            'name' => 'birthdate',
            'label' => 'birthdate',
            'type' => 'date',
            'attributes' => [
                'autocomplete' => 'off'
            ]
        ]);
        $this->crud->addField([
            'name' => 'phone_number',
            'attributes' => [
                'autocomplete' => 'off'
            ]
        ]);
        $this->crud->addField([
            'name' => 'username',
            'attributes' => [
                'autocomplete' => 'off'
            ]
        ]);
        $this->crud->addField([
            'name' => 'email',
            'label' => 'Email',
            'type' => 'email',
            'attributes' => [
                'autocomplete' => 'off'
            ]
        ]);
        $this->crud->addField([
            'name' => 'password',
            'attributes' => [
                'autocomplete' => 'off'
            ]
        ]);
        $this->crud->addField([
            'name' => 'applications',
            'type' => 'relationship',
            'attribute' => 'name',
            'ajax' => true,
            'inline_create' => ['entity' => 'application']
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
