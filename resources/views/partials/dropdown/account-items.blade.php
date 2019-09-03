<?php
    $showAddCredit = $showAddCredit ?? true;
    $showEditInfo = $showEditInfo ?? true;
    $showChangePassword = $showChangePassword ?? true;
    $showDeleteAccount = $showDeleteAccount ?? true;
?>

@if($showAddCredit)
    @include('partials.dropdown.item', [
        'forModal' => true,
        'modalLink' => '#addCreditModal',
        'icon' => 'dollar-sign',
        'label' => 'Add Credit',
        'color' => 'green'
    ])
@endif

@if($showEditInfo)
    @include('partials.dropdown.item', [
        'icon' => 'edit',
        'label' => 'Edit Info',
        'url' => action('AccountController@edit'),
        'color' => 'blue'
    ])
@endif

@if($showChangePassword)
    @include('partials.dropdown.item', [
        'icon' => 'key',
        'label' => 'Change Password',
        'url' => action('AccountController@editPassword'),
        'color' => 'yellow'
    ])
@endif

@if($showDeleteAccount)
    @include('partials.dropdown.item', [
        'forModal' => true,
        'modalLink' => '#deleteAccountModal',
        'icon' => 'trash-alt',
        'label' => 'Delete Account',
        'color' => 'red'
    ])
@endif
