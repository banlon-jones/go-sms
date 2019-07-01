<?php

Auth::routes();
// middleware auth
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/draftmessages', 'MessageController@draftmessages')->name('messages.save');
    Route::post('/addcontact', 'GroupController@addcontact');
    Route::post('/removecontact', 'GroupController@removeContact');
    Route::get('/addcontacts/{group_id}', 'GroupController@addContacts')->name('groups.addcontacts');
    Route::resource('contacts', 'ContactController');
    Route::post('/contact/edit','ContactController@update');
    Route::resource('messages', 'MessageController');
    Route::post('/update_message', 'MessageController@update_ajax');
    Route::get('/sentmessages','MessageController@sentMessage')->name('messages.sentbox');
    //teansaction routes
    Route::get('/receipt/{id}','TransactionController@receipt')->name('receipt');
    Route::get('/transactions','TransactionController@transactions')->name('transactions');
    Route::get('/download_receipt/{id}','TransactionController@downloadReceipt');

    Route::post('/message','MessageController@store');
    Route::post('/draft_message', 'MessageController@saveDraft');
    Route::post('/send', 'MessageController@send');
    Route::post('/invoice', 'MessageController@invoiceSms')->name('invoice');
    Route::post('/invoiceEmail', 'MessageController@invoiceEmail')->name('invoice.email');
    //input
    Route::get('/inbox', 'UsersController@inbox')->name('inbox');
    //groups
    Route::get('groups', 'GroupController@index')->name("groups");
    Route::post('/addgroup', 'GroupController@addGroup');
    Route::post("upload_to_group","GroupController@uploadToGroup");
    Route::post("editgroup", "GroupController@editGroup");
    Route::post("deletegroup", "GroupController@destroy");

//backend users
    Route::post('create_role', 'RoleController@addRole')->middleware('privilege:5');
    Route::get('roles', 'RoleController@index')->name("roles")->middleware('privilege:5');
    Route::post('edit_role', 'RoleController@editRole')->middleware('privilege:5');
    Route::get('privileges', 'RoleController@index')->middleware('privilege:7');
    Route::resource('users', 'UsersController')->middleware('privilege:1');
    Route::resource('notifications', 'NotificationController')->middleware('privilege:3');
    Route::get('/sendnote/{id}/send', 'NotificationController@sendnote')->name('notifications.send')->middleware('privilege:3');
    Route::post('/sendnote','NotificationController@sendToUser')->middleware('privilege:3');
    Route::post('/removenote','NotificationController@removeNotification');
    Route::post('/sendmessage','NotificationController@sendmessage')->middleware('privilege:3');
    //
    Route::post('/users/{id}/verify', 'UsersController@verify')->name('users.verify')->middleware('privilege:4');
    Route::post('/users/{id}/suspend', 'UsersController@suspend')->name('users.suspend')->middleware('privilege:4');
    Route::get('/permissions', 'UsersController@users')->name('permissions')->middleware('privilege:6');
    Route::post('/users/{id}/permissions', 'UsersController@user_role')->name('users.roles')->middleware('privilege:6');
    Route::post('/importcontacts','ContactController@importContacts');
    Route::get('/download_contact_template','ContactController@contactTemplate');
    Route::get('/manageTarif','TarifController@show')->middleware('privilege:2');
    Route::post('/createTarif','TarifController@create')->middleware('privilege:2');
    Route::post('/checkTarif','TarifController@checkRange')->middleware('privilege:2');
    Route::post('/editTarif','TarifController@update')->middleware('privilege:2');
    Route::post('/deleteTarif','TarifController@deleteTarif')->middleware('privilege:2');
});
//public routes
Route::get('/', 'PageController@index');
Route::get('statistics', 'StatisticsController@statistics')->name('statistics');
Route::get('download_receipt', 'TransactionController@downloadReceipt');

