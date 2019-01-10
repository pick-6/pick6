@include('partials.dropdown.item', [
    'forModal' => true,
    'modalLink' => '#addCreditModal',
    'icon' => 'dollar-sign',
    'label' => 'Add Credit',
    'color' => 'green'
])

@include('partials.dropdown.item', [
    'icon' => 'edit',
    'label' => 'Edit Info',
    'url' => action('AccountController@edit'),
    'color' => 'blue'
])

@include('partials.dropdown.item', [
    'icon' => 'key',
    'label' => 'Change Password',
    'url' => action('AccountController@editPassword'),
    'color' => 'yellow'
])

@include('partials.dropdown.item', [
    'forModal' => true,
    'modalLink' => '#deleteAccountModal',
    'icon' => 'trash-alt',
    'label' => 'Delete Account',
    'color' => 'red'
])
