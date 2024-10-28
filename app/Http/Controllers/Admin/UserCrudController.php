<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\UserType;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Client\Request;

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

    protected $method;
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
        CRUD::addField([
            'name' => 'user_type_id',
            'label' => 'User Type',
            'type' => 'select',
            'entity' => 'userType',
            'model' => UserType::class,
            'attribute' => 'name',
        ]);
    
        CRUD::addColumn([
            'name' => 'user_type_id',
            'label' => 'User Type',
            'type' => 'select',
            'entity' => 'userType',
            'model' => UserType::class,
            'attribute' => 'name',
        ]);
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('email')->label('Email');

        CRUD::addColumn([
            'name' => 'full_name', // a unique identifier for this column
            'label' => 'Full Name',
            'type' => 'text',
            'value' => function ($entry) {
                return $entry->full_name;
            },
        ]);

        CRUD::addColumn([
            'name'      => 'user_type_id',
            'label'     => 'User Type',
            'type'      => 'select',
            'entity'    => 'userType', // relation name in the User model
            'model'     => UserType::class, // related model
            'attribute' => 'name', // field to display from the related model
        ]);
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

        CRUD::addField(['name' => 'first_name', 'type' => 'text', 'label' => 'First Name']);
        CRUD::addField(['name' => 'last_name', 'type' => 'text', 'label' => 'Last Name']);
        CRUD::addField(['name' => 'email', 'type' => 'email', 'label' => 'Email']);
        CRUD::addField(['name' => 'password', 'type' => 'password', 'label' => 'Password']);

        CRUD::addField([
            'name'      => 'user_type_id',
            'label'     => 'User Type',
            'type'      => 'select',
            'entity'    => 'userType',
            'model'     => UserType::class,
            'attribute' => 'name',
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::addField(['id' => 'id', 'type' => 'hidden', 'name' => 'Id']);

        $this->setupCreateOperation();
        $request = $this->crud->getRequest();

        if (!$request->filled('password')) {
            $request->request->remove('password');
        }
    }
}
